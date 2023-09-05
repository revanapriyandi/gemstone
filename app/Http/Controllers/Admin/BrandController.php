<?php

namespace App\Http\Controllers\Admin;

use App\Models\BrandProduk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Models\TypeProduk;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin.produk.brand.index', [
            'title' => 'Brand Produk',
            'subtitle' => 'List Brand Produk',
        ]);
    }

    public function edit($id)
    {
        $brand = BrandProduk::with('gameServer')->findOrFail($id);

        return view('admin.produk.brand.edit', [
            'title' => 'Edit Brand Produk',
            'subtitle' => 'Edit Brand Produk',
            'data' => $brand,
            'type' => TypeProduk::orderBy('name')->get(),
            'kategori' => KategoriProduk::orderBy('name')->get(),
            'custom_field' => $brand->custom_field ? json_decode($brand->custom_field) : null,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand' => ['required', 'min:3', 'unique:brand_produks,name,' . $id],
            'slug' => ['required', 'min:3', 'unique:brand_produks,slug,' . $id],
            'company' => ['required', 'min:3'],
            'brand_type' => ['required', 'exists:type_produks,id'],
            'kategori' => ['required', 'exists:kategori_produks,id'],
            'description' =>  ['string', 'nullable'],
            'deskripsi_field' =>  ['string', 'nullable'],
            'cara_topup' => ['string', 'nullable'],
            'banner' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg,webp|max:2048'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg,webp|max:2048'],
            'meta_title' => 'min:3',
            'meta_description' => 'min:3',
            'meta_keyword' => 'min:3',
        ]);

        $brand = BrandProduk::findOrFail($id);
        $brand->name = $request->brand;
        $brand->slug = $request->slug;
        $brand->company = $request->company;
        $brand->type_id = $request->brand_type;
        $brand->kategori_id = $request->kategori;
        $brand->description = $request->description;
        $brand->deskripsi_field = $request->deskripsi_field;
        $brand->cara_topup = $request->cara_topup;
        $brand->is_featured = $brand->is_featured ? 0 : 1;
        $brand->status = $brand->status ? 0 : 1;
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_description;
        $brand->meta_keywords = $request->meta_keyword;

        if ($request->hasFile('banner')) {
            $brand->deleteBanner();
            $brand->updateBanner($request->file('banner'), 'banner');
        }

        if ($request->hasFile('logo')) {
            $brand->deleteLogo();
            $brand->updateLogo($request->file('logo'), 'brand');
        }

        $brand->update();

        return redirect()->route('brand.edit', $id)->with('success', 'Brand berhasil diupdate');
    }

    public function updateStatus(Request $request)
    {
        if ($request->ajax()) {
            $brand = BrandProduk::findOrFail($request->id);
            $brand->status = $brand->status == 1 ? 0 : 1;
            $brand->update();

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
            $brand = BrandProduk::findOrFail($request->id);
            $brand->is_featured = $brand->is_featured == 1 ? 0 : 1;
            $brand->update();

            return response()->json([
                'message' => 'Featured berhasil diubah',
                'status' => 'success'
            ]);
        }

        return abort(404);
    }

    public function updateMeta(Request $request, $id)
    {
        $request->validate([
            'meta_title' => 'min:3',
            'meta_description' => 'min:3',
            'meta_keywords' => 'min:3',
        ]);

        $brand = BrandProduk::findOrFail($id);
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_description;
        $brand->meta_keywords = $request->meta_keywords;
        $brand->update();

        return response()->json([
            'message' => 'Meta berhasil diupdate',
            'status' => 'success'
        ]);
    }

    public function uploadLogoBrand(Request $request, $id)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $brand = BrandProduk::findOrFail($id);

        $logo = $request->file('logo');
        $brand->deleteLogo();
        $brand->updateLogo($logo, 'brand');
        $brand->update();

        return response()->json([
            'message' => 'Logo berhasil diupload',
            'status' => 'success'
        ], 200);
    }

    public function destroy($id)
    {
        $brand = BrandProduk::findOrFail($id);
        $brand->deleteLogo();
        $brand->delete();

        return response()->json([
            'message' => 'Brand berhasil dihapus',
            'status' => 'success'
        ], 200);
    }


    public function fetchBrand(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->getBrandDataForDataTable();

            return $data;
        }

        return abort(404);
    }

    private function getBrandDataForDataTable()
    {
        $datas = BrandProduk::query();
        return DataTables::eloquent($datas)
            ->addIndexColumn('id')
            ->addColumn('name', function ($data) {
                return '<a href="' . route('brand.edit', $data->id) . '">' . $data->name . '</a>';
            })
            ->addColumn('logo', function ($data) {
                return '<img class="img-fluid w-60" src="' . $data->logo_url . '" alt="' . $data->name . ' Logo">';
            })
            ->addColumn('status', function ($data) {
                $status = $data->status ? 'Aktif' : 'Tidak Aktif';
                $class = $data->status ? 'success' : 'danger';
                return '<a href="javascript:" data-id="' . $data->id . '" id="updateStatus" class="badge bg-gradient-' . $class . '">' . $status . '</a>';
            })
            ->addColumn('featured', function ($data) {
                $status = $data->is_featured ? 'Featured' : '-';
                $class = $data->is_featured ? 'success' : 'secondary';
                return '<a href="javascript:" data-id="' . $data->id . '" id="updateFeatured" class="badge bg-gradient-' . $class . '">' . $status . '</a>';
            })
            ->addColumn('banner', function ($data) {
                return '<img class="img-fluid w-80" src="' . $data->banner_url . '" alt="' . $data->name . ' Banner">';
            })
            ->addColumn('updated_at', function ($data) {
                return $data->updated_at->diffForHumans();
            })
            ->addColumn('description', function ($row) {
                return Str::limit($row->description, 50, '...') ?? '-';
            })
            ->addColumn('actions', function ($data) {
                return '<button class="btn btn-link text-primary" data-id="' . $data->id . '" data-name="' . $data->name . '" id="uploadLogo" data-bs-toggle="tooltip" title="Upload logo brand"><span class="fa fa-upload"></span></button>
                <a href="' . route('brand.edit', $data->id) . '" class="btn btn-link text-warning" data-bs-toggle="tooltip" title="Edit brand"><span class="fa fa-edit"></span></a>
            <button id="deleteBtn" class="btn btn-link text-danger" data-bs-toggle="tooltip" title="Hapus brand" data-id="' . $data->id . '"><span class="fa fa-trash"></span></button>';
            })
            ->rawColumns(['id', 'name', 'featured', 'actions', 'status', 'updated_at', 'description', 'banner', 'logo'])
            ->toJson();
    }

    public function formOrder(Request $request, $id)
    {
        $request->validate([
            'form_order' => 'required|numeric',
            'custom_field' => ['string', 'nullable', 'max:255'],
            'custom_field2' => ['string', 'nullable', 'max:255'],
        ]);

        $brand = BrandProduk::findOrFail($id);
        $brand->form_order = $request->form_order;
        // $brand->custom_field = $request->custom_field;
        // $brand->custom_field2 = $request->form_order == 2 ? $request->custom_field2 : null;
        $brand->update();

        return redirect()->back()->with('success', 'Form order berhasil diupdate')->withFragment('#form-order');
    }
}
