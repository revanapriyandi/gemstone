<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\TypeProduk;
use App\Models\BrandProduk;
use Illuminate\Http\Request;
use App\Models\KategoriProduk;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Settings::findOrFail(1);
        $type = $this->getFeaturedTypes();
        $kategori = $this->getPinnedCategories();
        $brand = $this->getFeaturedBrands();

        return view('home', [
            'title' => $settings->app_name,
            'type' => $type,
            'kategori' => $kategori,
            'brand' => $brand,
        ]);
    }

    public function getBrandsByCategory($id, Request $request)
    {
        $limit = $request->limit ?? 12;
        $kategori = KategoriProduk::with('brands')->findOrFail($id);
        $brands = $this->getActiveBrandsInCategory($kategori, $limit);

        return response()->json([
            'data' => $brands,
        ]);
    }

    public function searchHome(Request $request)
    {
        $search = $request->term;
        $data = $this->searchBrands($search);

        return response()->json($data);
    }

    private function getFeaturedTypes()
    {
        return TypeProduk::with(['brands' => function ($query) {
            $query->where('status', 1)
                ->whereHas('produk', function ($subQuery) {
                    $subQuery->where('status', 1);
                });
        }])
            ->whereHas('brands', function ($query) {
                $query->where('status', 1);
            })
            ->where('status', 1)
            ->where('is_featured', 1)
            ->get()
            ->shuffle()
            ->map(function ($item) {
                $item->name = ucwords($item->name);
                return $item;
            });
    }

    private function getPinnedCategories()
    {
        return KategoriProduk::with('brands')
            ->whereHas('brands', function ($query) {
                $query->where('status', 1)
                    ->whereHas('produk', function ($subQuery) {
                        $subQuery->where('status', 1);
                    });
            })
            ->where('status', 1)
            ->where('pin', 1)
            ->get()
            ->map(function ($item) {
                $item->name = ucwords($item->name);
                return $item;
            });
    }

    private function getFeaturedBrands()
    {
        return BrandProduk::with(['produk'])
            ->whereHas('produk', function ($query) {
                $query->where('status', 1);
            })
            ->where('status', 1)
            ->where('is_featured', 1)
            ->get();
    }

    private function getActiveBrandsInCategory($kategori, $limit)
    {
        return $kategori->brands()
            ->whereHas('produk', function ($subQuery) {
                $subQuery->where('status', 1);
            })
            ->where('status', 1)
            ->limit($limit)
            ->get()
            ->map(function ($item) {
                $item->name = ucwords($item->name);
                return $item;
            });
    }

    private function searchBrands($search)
    {
        return BrandProduk::with('produk')
            ->select("name as value", "id", 'slug')
            ->whereHas('produk', function ($subQuery) {
                $subQuery->where('status', 1);
            })
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('company', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%");
            })
            ->get();
    }
}
