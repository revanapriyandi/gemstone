<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use App\Helpers\Helper;
use App\Models\TypeProduk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProviderProduk;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{
    public $type;

    public function index(Request $request)
    {
        $produkPerBulan = Produk::selectRaw('YEAR(created_at) AS year, MONTH(created_at) AS month,
                          SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS active_count,
                          SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) AS inactive_count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->get();

        $produk = Produk::with('transaksi')->get();

        $totalProduk = $this->calculateTotalProduk($produkPerBulan);
        $activeProdukCount = Produk::where('status', 1)->count();
        $inactiveProdukCount = Produk::where('status', 0)->count();
        $soldProdukCount = Transaksi::where('status', 'success')->count();

        $percentageActive = $this->calculatePercentage($activeProdukCount, $totalProduk);
        $percentageInactive = $this->calculatePercentage($inactiveProdukCount, $totalProduk);
        $percentageSold = $this->calculatePercentage($soldProdukCount, $totalProduk);

        $chartData = $this->prepareChartData($produkPerBulan);

        return view('admin.produk.index', [
            'title' => 'Produk',
            'subtitle' => 'List Produk',
            'totalProduk' => $totalProduk,
            'activeProdukCount' => $activeProdukCount,
            'inactiveProdukCount' => $inactiveProdukCount,
            'soldProdukCount' => $soldProdukCount,
            'percentageActive' => $percentageActive,
            'percentageInactive' => $percentageInactive,
            'percentageSold' => $percentageSold,
            'chartData' => $chartData,
            'typeProduk' => TypeProduk::orderBy('name', 'asc')->get(),
        ]);
    }

    public function updateMarkupHarga(Request $request)
    {
        $request->validate([
            'markup_harga' => 'required|numeric|min:0|max:100',
        ]);

        $markupHarga = $request->markup_harga;
        $setting = Settings::where('id', 1)->first();
        $setting->update([
            'markup_harga' => $markupHarga,
        ]);

        DB::table('produks')->update(['markup_harga' => $markupHarga]);

        Artisan::call('update:harga-jual');

        return response()->json([
            'message' => 'Berhasil mengupdate markup harga jual',
        ]);
    }

    private function calculateTotalProduk($produkPerBulan)
    {
        return $produkPerBulan->sum(function ($item) {
            return $item->active_count + $item->inactive_count;
        });
    }

    private function calculatePercentage($count, $total)
    {
        return ($count / $total) * 100;
    }

    private function prepareChartData($produkPerBulan)
    {
        $labels = [];
        $activeData = [];
        $inactiveData = [];

        foreach ($produkPerBulan as $item) {
            $monthName = date('F', mktime(0, 0, 0, $item->month, 1));
            $labels[] = $monthName;
            $activeData[] = $item->active_count;
            $inactiveData[] = $item->inactive_count;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                $this->createDataset('Aktif', $activeData, 'rgba(75, 192, 192, 0.2)', 'rgb(75, 192, 192)'),
                $this->createDataset('Tidak Aktif', $inactiveData, 'rgba(255, 99, 132, 0.2)', 'rgb(255, 99, 132)'),
            ],
        ];
    }

    private function createDataset($label, $data, $backgroundColor, $borderColor)
    {
        return [
            'label' => $label,
            'data' => $data,
            'backgroundColor' => $backgroundColor,
            'borderColor' => $borderColor,
            'borderWidth' => 1,
        ];
    }

    public function fetchProduk(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $this->resolveType($request->type);
        $produk = $this->getFilteredProduk();

        return datatables()->of($produk)
            ->addColumn('actions', function ($row) {
                return $this->getActionButtons($row->id);
            })
            ->addColumn('status', function ($row) {
                return $this->getStatusButton($row->status);
            })
            ->addColumn('brand', function ($row) {
                return $row->brand->name ?? '-';
            })
            ->addColumn('type', function ($row) {
                return $row->type->name ?? '-';
            })
            ->addColumn('kategori', function ($row) {
                return $row->kategori->name ?? '-';
            })
            ->addColumn('maintenance', function ($row) {
                return $row->maintenance_start . ' - ' . $row->maintenance_end;
            })
            ->addColumn('harga', function ($row) {
                return $this->getFormattedHarga($row->harga);
            })
            ->editColumn('harga_jual', function ($row) {
                return Helper::formatRupiah($row->harga_jual);
            })
            ->editColumn('markup_harga', function ($row) {
                return Helper::formatPersen($row->markup_harga);
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at->diffForHumans();
            })
            ->addColumn('multi_trx', function ($row) {
                return $this->getMultiTrxBadge($row->multi_trx);
            })
            ->editColumn('note', function ($row) {
                return Str::limit($row->note, 50, '...') ?? '-';
            })
            ->rawColumns(['actions', 'status', 'brand', 'type', 'kategori', 'maintenance', 'harga', 'multi_trx'])
            ->addIndexColumn()
            ->toJson();
    }

    private function resolveType($requestType)
    {
        $slug = str_replace('-', ' ', $requestType);
        $type = TypeProduk::where('name', $slug)->first();
        $this->type = $type->id ?? 1;
    }

    private function getTypeProduk()
    {
        return TypeProduk::select('name')->get()->map(function ($item) {
            $slug = Str::slug($item->name);
            $item['slug'] = $slug;
            $item['name'] = ucwords($item->name);
            return $item;
        });
    }

    private function getFilteredProduk()
    {
        $query = Produk::with('brand', 'type', 'kategori')
            ->orderBy('name', 'asc');

        if ($this->type !== null) {
            $query->where('type_produk_id', $this->type);
        }

        return $query->get();
    }


    private function getActionButtons($id)
    {
        return ' <button id="deleteBtn" class="btn btn-link text-danger" data-id="' . $id . '"><span class="fa fa-trash"></span></button>';
    }

    private function getStatusButton($status)
    {
        $class = $status == 1 ? 'success' : 'danger';
        return '<button type="button" class="btn btn-sm btn-' . $class . '"><i class="fas fa-power-off"></i></button>';
    }

    private function getFormattedHarga($harga)
    {
        $level = ProviderProduk::where('name', 'Vip Reseller')->first();
        $harga = json_decode($harga);
        $basic = Helper::formatRupiah($harga->basic);
        $premium = Helper::formatRupiah($harga->premium);
        $special = Helper::formatRupiah($harga->special);

        $format = "<div class='font-weight-bold %s' data-bs-toggle='tooltip' title='Harga yang Digunakan: %s'><span>%s:</span> %s</div><br>";

        return sprintf($format, $level->level === 'basic' ? 'text-primary' : '', ucfirst($level->level), 'Basic', $basic) .
            sprintf($format, $level->level === 'premium' ? 'text-primary' : '', ucfirst($level->level), 'Premium', $premium) .
            sprintf($format, $level->level === 'special' ? 'text-primary' : '', ucfirst($level->level), 'Special', $special);
    }

    private function getMultiTrxBadge($multiTrx)
    {
        $class = $multiTrx == 1 ? 'success' : 'danger';
        return '<a href="#" class="badge badge-' . $class . '">' . ($multiTrx == 1 ? 'Ya' : 'Tidak') . '</a>';
    }
}
