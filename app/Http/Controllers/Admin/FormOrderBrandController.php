<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandProduk;
use App\Models\GameServer;
use Exception;
use Illuminate\Http\Request;

class FormOrderBrandController extends Controller
{
    public function gameServer(Request $request, $id)
    {
        $data = BrandProduk::find($id);
        $data->game_server = $data->game_server ? 0 : 1;
        $data->update();

        return response()->json([
            'success' => true,
            'message' => $data->game_server  ? 'Game server berhasil diaktifkan' : 'Game server berhasil dinonaktifkan',
        ]);
    }

    public function cekId(Request $request, $id)
    {
        $data = BrandProduk::find($id);
        $data->cek_id = $data->cek_id ? 0 : 1;
        $data->update();

        return response()->json([
            'success' => true,
            'message' => $data->cek_id  ? 'Cek ID berhasil diaktifkan' : 'Cek ID berhasil dinonaktifkan',
        ]);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'kode' =>  ['required', 'string', 'max:10', 'unique:game_servers,kode,' . $request->id],
            'name' => ['required', 'string', 'max:50', 'unique:game_servers,name,' . $request->id],
        ]);


        GameServer::updateOrCreate(
            ['kode' => $request->kode],
            [
                'brand_id' => $id,
                'name' => $request->name,
                'kode' => $request->kode,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan data',
        ]);
    }

    public function edit($id)
    {
        $data = GameServer::find($id);

        return response()->json($data);
    }

    public function destroy($id)
    {
        try {
            $data = GameServer::find($id);
            $data->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus')->withFragment('#form-order');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
