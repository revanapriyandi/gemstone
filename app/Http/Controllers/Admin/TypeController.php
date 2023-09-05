<?php

namespace App\Http\Controllers\Admin;

use App\Models\TypeProduk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TypeController extends Controller
{
    public function index()
    {
        return view('admin.produk.type.index', [
            'title' => 'Type Produk',
            'subtitle' => 'List Type Produk',
        ]);
    }

    public function updateStatus(Request $request)
    {
        if ($request->ajax()) {
            $type = TypeProduk::findOrFail($request->id);
            $type->status = $type->status == 1 ? 0 : 1;
            $type->update();

            return response()->json([
                'message' => 'Status berhasil diubah',
                'status' => 'success'
            ]);
        }

        return abort(404);
    }

    public function updateFeatured(Request $request)
    {
        if ($request->ajax()) {
            $brand = TypeProduk::findOrFail($request->id);
            $brand->is_featured = $brand->is_featured == 1 ? 0 : 1;
            $brand->update();

            return response()->json([
                'message' => 'Featured berhasil diubah',
                'status' => 'success'
            ]);
        }

        return abort(404);
    }

    public function uploadLogoType(Request $request, $id)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $type = TypeProduk::findOrFail($id);

        $logo = $request->file('logo');
        $type->deleteLogo();
        $type->updateLogo($logo, 'type');
        $type->update();

        return response()->json([
            'message' => 'Logo berhasil diupload',
            'status' => 'success'
        ], 200);
    }

    public function destroy($id)
    {
        $brand = TypeProduk::findOrFail($id);
        $brand->deleteLogo();
        $brand->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus',
            'status' => 'success'
        ], 200);
    }


    public function fetchType(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->getTypeDataForDataTable();

            return $data;
        }

        return abort(404);
    }

    private function getTypeDataForDataTable()
    {
        $type = TypeProduk::query();
        return DataTables::of($type)
            ->addColumn('actions', function ($type) {
                return '<button class="btn btn-link text-primary" data-id="' . $type->id . '" data-name="' . $type->name . '" id="uploadLogo" data-bs-toggle="tooltip" title="Upload logo brand"><span class="fa fa-upload"></span></button>
            <button id="deleteBtn" class="btn btn-link text-danger" data-bs-toggle="tooltip" title="Hapus brand" data-id="' . $type->id . '"><span class="fa fa-trash"></span></button>';
            })
            ->addColumn('status', function ($data) {
                $status = $data->status ? 'Aktif' : 'Tidak Aktif';
                $class = $data->status ? 'success' : 'danger';
                return '<a href="javascript:" data-id="' . $data->id . '" id="updateStatus" class="badge bg-gradient-' . $class . '">' . $status . '</a>';
            })
            ->addColumn('featured', function ($data) {
                $status = $data->is_featured ? 'Featured' : 'Tidak';
                $class = $data->is_featured ? 'success' : 'danger';
                return '<a href="javascript:" data-id="' . $data->id . '" id="updateFeatured" class="badge bg-gradient-' . $class . '">' . $status . '</a>';
            })
            ->addColumn('name', function ($type) {
                return '<a href="javascript:;"  id="gotoEdit"  data-id="' . $type->id . '"><div class="d-flex"><div class="form-check my-auto"></div><img class="w-20 ms-3" src="' . $type->logo_url . '" alt="' . $type->name . ' Logo"><h6 class="ms-3 my-auto">' . ucwords($type->name) . '</h6></div></a>';
            })
            ->addColumn('itemCount', function ($type) {
                return $type->brands->count();
            })
            ->addColumn('desc', function ($type) {
                return Str::limit($type->deskripsi, 50, '...') ?: '-';
            })
            ->editColumn('updated_at', function ($type) {
                return $type->updated_at->format('d M Y H:i');
            })
            ->rawColumns(['actions',  'desc', 'featured', 'status', 'name', 'itemCount'])
            ->toJson();
    }
}
