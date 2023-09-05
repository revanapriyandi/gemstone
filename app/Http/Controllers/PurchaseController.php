<?php

namespace App\Http\Controllers;

use Midtrans\CoreApi;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\BrandProduk;
use Illuminate\Http\Request;
use App\Models\MetodePembayaran;
use App\Models\Payment;
use Stevebauman\Location\Facades\Location;

class PurchaseController extends Controller
{
    public function purchase(Request $request, $slug)
    {
        $payment = MetodePembayaran::all()->groupBy('category');
        if ($request->ajax()) {
            return response()->json($payment);
        }
        $brand = BrandProduk::with(['produk' => function ($query) {
            $query->where('status', 1);
        }, 'type', 'gameServer'])
            ->where('slug', $slug)
            ->firstOrFail();
        return view('purchase.index', [
            'brand' => $brand,
            'payment' => $payment
        ]);
    }

    public function checkout(Request $request, $brand, $produk, $payment)
    {
        $brand = BrandProduk::with(['produk', 'type', 'gameServer'])->find($brand);
        $payment = MetodePembayaran::find($payment);
        $produk = $brand->produk->find($produk);
        return view('purchase.checkout', [
            'brand' => $brand,
            'produk' => $produk,
            'payment' => $payment,
            'mail' => $request->mail,
            'data_pengguna' => $request->data_pengguna ?? null,
            'id_pengguna' => $request->id_pengguna ?? null,
            'id_zona' => $request->id_zona ?? null,
        ]);
    }

    public function order(Request $request)
    {
        $request->validate([
            'produk_id' => ['required', 'exists:produks,id', 'numeric'],
            'email' => ['required', 'email', 'max:50', 'min:5'],
            'type_transaksi' => ['required', 'string', 'in:deposit,withdraw,transfer,order,refund'],
            'total_harga' => ['required', 'numeric'],
            'security_key' => ['string', 'max:6', 'min:6'],
            'brand_id' => ['required', 'exists:brand_produks,id', 'numeric'],
            'payment_id' => ['required', 'exists:metode_pembayarans,id', 'numeric'],
        ]);

        $order_id = $this->generateOrderID();

        $transaksi = new Transaksi;
        $transaksi->order_id = $order_id;
        $transaksi->user_id = auth()->user()->id ?? null;
        $transaksi->produk_id = $request->produk_id;
        $transaksi->zona = $request->id_zona ?? null;
        $transaksi->nickname = $request->id_pengguna ?? null;
        $transaksi->etc = $request->data_pengguna ?? null;
        $transaksi->type = $request->type_transaksi;
        $transaksi->no_hp = $request->phone ?? null;
        $transaksi->email = $request->email;
        $transaksi->total_harga = $request->total_harga;
        $transaksi->status = 'pending';
        $transaksi->ip = $this->getIP();
        $transaksi->user_agent = $request->header('User-Agent');
        // $transaksi->location = $this->getLocationByIp($this->getIP());
        $transaksi->save();

        $prepareTransaction = $this->prepareTransactionData($request, $order_id);
        $charge = CoreApi::charge($prepareTransaction);

        $payment = new Payment();
        $payment->payment_code = time();
        $payment->transaksi_id = $transaksi->id;
        $payment->metode_pembayaran_id = $request->payment_id;
        $payment->order_id = $order_id;
        $payment->payment_status_code = $charge->status_code;
        $payment->payment_status_message = $charge->status_message;
        $payment->payment_transaction_id = $charge->transaction_id;
        $payment->payment_type = $charge->payment_type;
        $payment->payment_transaction_time = $charge->transaction_time;
        $payment->status = $charge->transaction_status;
        $payment->payment_amount = $charge->gross_amount;
        $payment->payment_currency = $charge->currency;
        $payment->fraud_status = $charge->fraud_status;
        $payment->payment_bank = $charge->va_numbers[0]->bank;
        $payment->payment_va_number = $charge->va_numbers[0]->va_number;
        $payment->save();

        if (!$payment) {
            $transaksi->delete();
        }

        return redirect()->route('payment.charge', ['id' => $transaksi->id]);
    }

    public function generateOrderID()
    {
        $orderID =  date('Ymd') . '-' . time() . '-' . rand(100, 999) . '-' . time();
        return $orderID;
    }

    private function prepareTransactionData($request, $order_id)
    {
        $payment = MetodePembayaran::findOrFail($request->payment_id);
        $produk = Produk::with('brand')->findOrFail($request->produk_id);
        return [
            "payment_type" => $payment->category,
            "transaction_details" => [
                "order_id" => $order_id,
                "gross_amount" => intval($request->total_harga),
            ],
            "customer_details" => [
                "first_name" => auth()->user()->name ?? "Guest",
                "email" => $request->email,
            ],
            "item_details" => [
                [
                    "id" => $produk->kode,
                    "name" =>  $produk->name,
                    "price" =>  $produk->harga_jual,
                    "quantity" => 1,
                    'brand' => $produk->brand->name,
                    'category' => $produk->kategori->name,
                    'merchant_name' => config('app.name'),
                    'url' => route('purchase', ['slug' => $produk->brand->slug]),
                ], [
                    "id" => 'admin-fee',
                    "name" =>  'Admin Fee',
                    "price" =>  env('ADMIN_FEE'),
                    "quantity" => 1,
                    'brand' => config('app.name'),
                    'category' => 'Admin Fee',
                    'merchant_name' => config('app.name')
                ]
            ],
            "bank_transfer" => [
                "bank" => $payment->kode,
                "va_number" => time(),
            ]
        ];
    }

    private function getIP()
    {
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            return $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            return $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        } else {
            return 'UNKNOWN';
        }
    }

    private function getLocationByIp($ip)
    {
        $position = Location::get($ip);
        $location = $position->regionName ?? '' . ', ' . $position->cityName ?? '' . ', ' . $position->countryName ?? '';
        return $location;
    }
}
