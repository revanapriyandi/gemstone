<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MetodePembayaran;
use App\Http\Controllers\Controller;

class MetodePembayaranController extends Controller
{
    public function index()
    {
        return view('admin.metode-pembayaran.index', [
            'title' => 'Metode Pembayaran',
            'subtitle' => 'Daftar Metode Pembayaran',
            'data' => MetodePembayaran::orderBy('name', 'asc')->get()
        ]);
    }

    public function create()
    {
        return view('admin.metode-pembayaran.create', [
            'title' => 'Metode Pembayaran',
            'subtitle' => 'Tambah Metode Pembayaran',
            'paymentMethods' => $this->PaymentMethods()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:metode_pembayarans,name'],
            'kode' => ['required', 'unique:metode_pembayarans,kode'],
            'status' => ['required'],
            'logo' => ['required', 'image', 'mimes:png,jpg,jpeg,gif,svg', 'max:2048'],
            'type' => ['required', 'string'],
            'keterangan' => ['required', 'string', 'in:manual,otomatis'],
            'category' => ['required', 'string'],
            'min_charge' => ['required', 'numeric', 'min:0', 'max:1000000000'],
        ]);

        $logo = $request->file('logo');
        $data = new MetodePembayaran();
        $data->name = $request->name;
        $data->kode = $request->kode;
        $data->is_active = $request->status == 'on' ? 1 : 0;
        $data->type = $request->type;
        $data->keterangan = $request->keterangan;
        $data->category = $request->category;
        $data->min_value = $request->min_charge;
        $data->save();

        $data->updateLogo($logo, 'metode-pembayaran');

        return redirect()->route('metode-pembayaran.index')->with('success', 'Berhasil menambahkan metode pembayaran baru');
    }

    private function PaymentMethods()
    {
        $paymentMethods = [
            'credit_card' => 'Credit Card',
            'bank_transfer' => 'Bank Transfer',
            'cstore' => 'CStore',
            'qris' => 'QRIS',
            'gopay' => 'Gopay',
            'shopeepay' => 'ShopeePay',
            'virtual_account' => 'Virtual Account',
            'bca_klikpay' => 'BCA KlikPay',
            'bca_klikbca' => 'BCA KlikBca',
            'bri_epay' => 'BRI Epay',
            'cimb_clicks' => 'CIMB Clicks',
            'danamon_online' => 'Danamon Online',
            'uob_ezpay' => 'UOB Ezpay',
            'akulaku' => 'Akulaku',
            'kredivo' => 'Kredivo'
        ];
        return $paymentMethods;
    }

    public function edit($id)
    {
        $data = MetodePembayaran::findOrFail($id);
        return view('admin.metode-pembayaran.edit', [
            'title' => 'Metode Pembayaran',
            'subtitle' => 'Edit Metode Pembayaran',
            'data' => $data,
            'paymentMethods' => $this->PaymentMethods()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:metode_pembayarans,name,' . $id],
            'kode' => ['required', 'unique:metode_pembayarans,kode,' . $id],
            'status' => ['required'],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,svg', 'max:2048'],
            'type' => ['required', 'string'],
            'keterangan' => ['required', 'string', 'in:manual,otomatis'],
            'category' => ['required', 'string'],
            'min_charge' => ['required', 'numeric', 'min:0', 'max:1000000000'],
        ]);

        $data = MetodePembayaran::findOrFail($id);
        $data->name = $request->name;
        $data->kode = $request->kode;
        $data->is_active = $request->status == 'on' ? 1 : 0;
        $data->type = $request->type;
        $data->keterangan = $request->keterangan;
        $data->category = $request->category;
        $data->min_value = $request->min_charge;
        $data->save();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $data->updateLogo($logo, 'metode-pembayaran');
        }

        return redirect()->route('metode-pembayaran.index')->with('success', 'Berhasil mengubah metode pembayaran');
    }

    public function updateStatus(Request $request, $id)
    {
        $data = MetodePembayaran::findOrFail($id);
        $data->is_active = $data->status ? 0 : 1;
        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengubah status metode pembayaran'
        ]);
    }

    public function fetchMetodePembayaran()
    {
        $data = MetodePembayaran::orderBy('name', 'asc')->get();

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($data) {
                $button = '<a href="' . route('metode-pembayaran.edit', $data->id) . '" class="btn btn-link text-warning"><i class="fas fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="' . $data->id . '" class="btn btn-link text-danger delete"><i class="fas fa-trash"></i></button>';
                return $button;
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    $status = '<span class="badge bg-gradient-success status" style="cursor: pointer " data-id="' . $data->id . '">Aktif</span>';
                } else {
                    $status = '<span class="badge bg-gradient-danger status" style="cursor: pointer " data-id="' . $data->id . '">Tidak Aktif</span>';
                }
                return $status;
            })
            ->addColumn('min_charge', function ($data) {
                return 'Rp. ' . number_format($data->min_value, 0, ',', '.');
            })
            ->addColumn('name', function ($data) {
                $name = '<a href="' . route('metode-pembayaran.edit', $data->id) . '" class="text-dark">' . $data->name . '</a>';
                return $name;
            })
            ->editColumn('type', function ($data) {
                return ucwords(str_replace('_', ' ', $data->type));
            })
            ->editColumn('category', function ($data) {
                return ucwords(str_replace('_', ' ', $data->category));
            })
            ->addColumn('keterangan', function ($data) {
                if ($data->keterangan == 'manual') {
                    $keterangan = '<span class="badge bg-warning" >Manual</span>';
                } else {
                    $keterangan = '<span class="badge bg-success" >Otomatis</span>';
                }
                return $keterangan;
            })
            ->addColumn('logo', function ($data) {
                $logo = '<img src="' . $data->logo_url . '" alt="' . $data->name . '" class="img-fluid" width="100">';
                return $logo;
            })
            ->rawColumns(['actions', 'status', 'logo', 'keterangan', 'name', 'min_charge'])
            ->make(true);
    }
}
