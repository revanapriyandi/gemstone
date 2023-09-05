<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Produk;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriProduk;
use App\Models\ProviderProduk;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.produk.kategori.index', [
            'title' => 'Kategori Produk',
            'subtitle' => 'Daftar Kategori Produk'
        ]);
    }

    public function edit($id)
    {
        $kategori = KategoriProduk::find($id);

        return response()->json($kategori);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'deskripsi' => ['nullable', 'string', 'max:255'],
        ]);

        $kategori = KategoriProduk::find($id);

        $kategori->name = $request->name;
        $kategori->deskripsi = $request->deskripsi;
        $kategori->update();

        return response()->json([
            'message' => $request->status,
        ]);
    }

    public function destroy($id)
    {
        try {
            KategoriProduk::destroy($id);

            return response()->json([
                'message' => 'Kategori berhasil dihapus'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        $kategori = KategoriProduk::find($request->id);
        $kategori->status = $kategori->status == 1 ? 0 : 1;
        $kategori->update();

        return response()->json([
            'message' => 'Status kategori berhasil diubah'
        ]);
    }

    public function fetchKategori(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->getKategoriDataForDataTable();

            return $data;
        }

        return abort(404);
    }

    public function updatePin($id)
    {
        $pin = KategoriProduk::where('pin', 1)->count();

        $kategori = KategoriProduk::findOrFail($id);
        $kategori->pin = $kategori->pin ? 0 : 1;
        $kategori->update();

        return response()->json([
            'message' => 'Kategori berhasil diubah'
        ]);

        return response()->json([
            'message' => 'Kategori tidak dapat diubah'
        ]);
    }

    private function getKategoriDataForDataTable()
    {
        $kategoris = KategoriProduk::query();
        $kategoris->orderBy('name', 'asc');
        return DataTables::eloquent($kategoris)
            ->addIndexColumn()
            ->addColumn('kode', function ($kategori) {
                return $kategori->kode;
            })
            ->addColumn('deskripsi', function ($kategori) {
                return $kategori->deskripsi;
            })
            ->addColumn('pin', function ($kategori) {
                return $this->getPinButton($kategori->pin, $kategori->id);
            })
            ->addColumn('status', function ($kategori) {
                return $this->getStatusButton($kategori->status, $kategori->id);
            })
            ->addColumn('updated_at', function ($kategori) {
                return $kategori->updated_at->diffForHumans();
            })
            ->addColumn('item', function ($kategori) {
                return $kategori->brands->count();
            })
            ->addColumn('actions', function ($kategori) {
                return ' <button class="btn btn-link text-warning" data-id="' . $kategori->id . '" id="editBtn"><span class="fa fa-edit"></span></button>
            <button id="deleteBtn" class="btn btn-link text-danger" data-id="' . $kategori->id . '"><span class="fa fa-trash"></span></button>';
            })
            ->rawColumns(['actions', 'status', 'updated_at', 'pin', 'id', 'deskripsi', 'item'])
            ->toJson();
    }

    private function getStatusButton($status, $id = null)
    {
        $class = $status == 1 ? 'success' : 'danger';
        return '<button type="button" id="statusChanger" data-id="' . $id . '"  class="btn btn-sm btn-' . $class . '"><i class="fas fa-power-off"></i></button>';
    }

    private function getPinButton($pin, $id)
    {
        $class = $pin == 1 ? 'success' : 'danger';
        $icon = $pin == 1 ? 'fas fa-check' : 'fas fa-times';
        return '<button type="button" id="pinChanger" data-id="' . $id . '"  class="btn btn-sm btn-' . $class . '"><i class="' . $icon . '"></i></button>';
    }
}
