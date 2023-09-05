<?php

namespace App\Http\Controllers;

use Exception;
use Midtrans\CoreApi;
use App\Models\Produk;
use App\Helpers\Helper;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\MetodePembayaran;

class PaymentsController extends Controller
{
    public function Charge($id)
    {
        $transaksi = Transaksi::with(['payment', 'produk'])->findOrFail($id);

        return view('purchase.charge', [
            'data' => $transaksi
        ]);
    }
}
