<?php

namespace App\Http\Controllers;

use App\Http\Controllers\POController;
use App\Models\Penjualan;
use App\Models\Vendor;
use App\Models\Pembelian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    private $POController;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->POController = new POController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Carbon::setLocale('id');

        // $penjualan = Penjualan::orderByDesc('tgl_penjualan')->take(10)->get();
        $yearNow = Carbon::now()->year;
        $monthNow = Carbon::now()->month;

        $dataPerjam = $this->getPenjualan();
        $dataPenjualan = $this->getDataPenjualan();
        $dataPenjualanLastYear = $this->getDataPenjualanLastYear();
        $dataPerminggu = $this->getPerminggu();
        $dataPerbulan = $this->getPerbulan();
        $dataPerbulanLastYear = $this->getPerbulanLastYear();
        $totalPerminggu = $this->getTotalPerMinggu();
        $totalPerbulan = $this->getTotalPerBulan();
        $totalPertahun = $this->getTotalPerTahun();
        
        // ✅ 1. PANGGIL FUNGSI TOTAL PER TAHUN LALU
        $totalPertahunLalu = $this->getTotalPerTahunLalu();
        
        $vendor = $this->vendor();
        
        $hourArray = $dataPerjam['jamPenjualan'];
        $dateArray = $dataPenjualan['tanggalPenjualan'];
        $dateArrayLastYear = $dataPenjualanLastYear['tanggalPenjualanLastYear'];
        $weekArray = $dataPerminggu['tanggalPenjualan'];
        $monthArray = $dataPerbulan['bulanPenjualan'];
        $monthArrayLastYear = $dataPerbulanLastYear['bulanPenjualanLastYear'];
        $totalJamArray = $dataPerjam['totalPerjam'];
        $totalHarianArray = $dataPenjualan['totalHarian'];
        $totalHarianArrayLastYear = $dataPenjualanLastYear['totalHarianLastYear'];
        $totalMingguanArray = $dataPerminggu['totalHarian'];
        $totalBulananArray = $dataPerbulan['totalBulanan'];
        $totalBulananArrayLastYear = $dataPerbulanLastYear['totalBulananLastYear'];
        $jumlahPerHari = number_format(array_sum($dataPerjam['totalPerjam']), 0, ',', ',');
        $jumlahPerMinggu = number_format(array_sum($dataPerminggu['totalHarian']), 0, ',', ',');

        // Week For Donut Chart
        $datasInWeek = $totalPerminggu['weekDatas'];
        $percentageInWeek = $totalPerminggu['weekIn'];
        $percentageNotPaidWeek = $totalPerminggu['weekNotPaid'];
        $percentageCanceledWeek = $totalPerminggu['weekCanceled'];
        // Month For Donut Chart
        $datasInMonth = $totalPerbulan['monthDatas'];
        $percentageInMonth = $totalPerbulan['monthIn'];
        $percentageNotPaidMonth = $totalPerbulan['monthNotPaid'];
        $percentageCanceledMonth = $totalPerbulan['monthCanceled'];
        // Year For Donut Chart
        $datasInYear = $totalPertahun['yearDatas'];
        $percentageInYear = $totalPertahun['yearIn'];
        $percentageNotPaidYear = $totalPertahun['yearNotPaid'];
        $percentageCanceledYear = $totalPertahun['yearCanceled'];

        // ✅ 2. AMBIL VARIABEL UNTUK DONUT CHART (LAST YEAR)
        $datasInLastYear = $totalPertahunLalu['lastYearDatas'];
        $percentageInLastYear = $totalPertahunLalu['lastYearIn'];
        $percentageNotPaidLastYear = $totalPertahunLalu['lastYearNotPaid'];
        $percentageCanceledLastYear = $totalPertahunLalu['lastYearCanceled'];

        //data for vendorchart
        $datavendor = $vendor['vendor'];
        $datasisa = $vendor['sisa'];
        
        // dd($datasInYear, $percentageInYear, $percentageNotPaidYear, $percentageCanceledYear);
        $jumlahPerBulan = number_format(Penjualan::where('jenis_pembayaran', '<>', 'PO')->whereMonth('tgl_penjualan', $monthNow)->whereYear('tgl_penjualan', $yearNow)->sum('total_pembayaran'), 0, ',', '.');
        $jumlahPerTahun = number_format(Penjualan::where('jenis_pembayaran', '<>', 'PO')->whereYear('tgl_penjualan', $yearNow)->sum('total_pembayaran'), 0, ',', '.');

        $jumlahBBPerTahun = number_format(Penjualan::where('jenis_pembayaran', '<>', 'PO')->whereYear('tgl_penjualan', $yearNow)->where('status', 'Belum Lunas')->sum('sisa_pembayaran'), 0, ',', '.');
        $jumlahBBPerBulan = number_format(Penjualan::where('jenis_pembayaran', '<>', 'PO')->whereMonth('tgl_penjualan', $monthNow)->whereYear('tgl_penjualan', $yearNow)->where('status', 'Belum Lunas')->sum('sisa_pembayaran'), 0, ',', '.');

        // Data PO
        $dataPerjamPO = $this->POController->getPenjualanPO();
        $dataPenjualanPO = $this->POController->getDataPenjualanPO();
        $dataPermingguPO = $this->POController->getPermingguPO();
        $dataPerbulanPO = $this->POController->getPerbulanPO();
        $hourArrayPO = $dataPerjamPO['jamPenjualan'];
        $dateArrayPO = $dataPenjualanPO['tanggalPenjualan'];
        $weekArrayPO = $dataPermingguPO['tanggalPenjualan'];
        $monthArrayPO = $dataPerbulanPO['bulanPenjualan'];
        $totalJamArrayPO = $dataPerjamPO['totalPerjam'];
        $totalHarianArrayPO = $dataPenjualanPO['totalHarian'];
        $totalMingguanArrayPO = $dataPermingguPO['totalHarian'];
        $totalBulananArrayPO = $dataPerbulanPO['totalBulanan'];
        $jumlahPerHariPO = number_format(array_sum($dataPerjamPO['totalPerjam']), 0, ',', '.');
        $jumlahPerMingguPO = number_format(array_sum($dataPermingguPO['totalHarian']), 0, ',', '.');

        //Total PO
        $jumlahPO = number_format(Penjualan::where('jenis_pembayaran', '=', 'PO')->sum('total_pembayaran'), 0, ',', '.');
        $jumlahPOLunas = number_format(Penjualan::where('jenis_pembayaran', '=', 'PO')->where('status', '=', 'Lunas')->sum('total_pembayaran'), 0, ',', '.');
        $jumlahPOBlmLunas = number_format(Penjualan::where('jenis_pembayaran', '=', 'PO')->where('status', '=', 'Belum Lunas')->sum('total_pembayaran'), 0, ',', '.');

        // PO Day
        $today = now()->format('Y-m-d');
        $jumlahPOLunasToday = number_format(Penjualan::where('jenis_pembayaran', 'PO')->where('status', 'Lunas')->whereDate('tgl_penjualan', $today)->sum('total_pembayaran'), 0, ',', '.');
        $jumlahPOBlmLunasToday = number_format(Penjualan::where('jenis_pembayaran', 'PO')->where('status', 'Belum Lunas')->whereDate('tgl_penjualan', $today)->sum('total_pembayaran'), 0, ',', '.');

        // PO Week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $jumlahPOLunasWeek = number_format(Penjualan::where('jenis_pembayaran', 'PO')->where('status', 'Lunas')->whereBetween('tgl_penjualan', [$startOfWeek, $endOfWeek])->sum('total_pembayaran'), 0, ',', '.');
        $jumlahPOBlmLunasWeek = number_format(Penjualan::where('jenis_pembayaran', 'PO')->where('status', 'Belum Lunas')->whereBetween('tgl_penjualan', [$startOfWeek, $endOfWeek])->sum('total_pembayaran'), 0, ',', '.');

        // PO Month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $jumlahPOLunasMonth = number_format(Penjualan::where('jenis_pembayaran', 'PO')->where('status', 'Lunas')->whereBetween('tgl_penjualan', [$startOfMonth, $endOfMonth])->sum('total_pembayaran'), 0, ',', '.');
        $jumlahPOBlmLunasMonth = number_format(Penjualan::where('jenis_pembayaran', 'PO')->where('status', 'Belum Lunas')->whereBetween('tgl_penjualan', [$startOfMonth, $endOfMonth])->sum('total_pembayaran'), 0, ',', '.');

        // PO Year
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        $jumlahPOLunasYear = number_format(Penjualan::where('jenis_pembayaran', 'PO')->where('status', 'Lunas')->whereBetween('tgl_penjualan', [$startOfYear, $endOfYear])->sum('total_pembayaran'), 0, ',', '.');
        $jumlahPOBlmLunasYear = number_format(Penjualan::where('jenis_pembayaran', 'PO')->where('status', 'Belum Lunas')->whereBetween('tgl_penjualan', [$startOfYear, $endOfYear])->sum('total_pembayaran'), 0, ',', '.');
        
        
        $jumlahPerBulanPO = number_format(Penjualan::where('jenis_pembayaran', 'PO')->whereMonth('tgl_penjualan', $monthNow)->whereYear('tgl_penjualan', $yearNow)->sum('total_pembayaran'), 0, ',', '.');
        $jumlahPerTahunPO = number_format(Penjualan::where('jenis_pembayaran', 'PO')->whereYear('tgl_penjualan', $yearNow)->sum('total_pembayaran'), 0, ',', '.');

        $jumlahBBPerTahunPO = number_format(Penjualan::where('jenis_pembayaran', 'PO')->whereYear('tgl_penjualan', $yearNow)->where('status', 'Belum Lunas')->sum('sisa_pembayaran'), 0, ',', '.');
        $jumlahBBPerBulanPO = number_format(Penjualan::where('jenis_pembayaran', 'PO')->whereMonth('tgl_penjualan', $monthNow)->whereYear('tgl_penjualan', $yearNow)->where('status', 'Belum Lunas')->sum('sisa_pembayaran'), 0, ',', '.');


        $invoicePO = DB::select("SELECT customer, tgl_penjualan, status
        FROM penjualan
        WHERE jenis_pembayaran = 'PO'
            AND deleted_at IS NULL
        ORDER BY tgl_penjualan DESC
        LIMIT 7");
        foreach ($invoicePO as $inv) {
            $inv->formatted_tgl = Carbon::parse($inv->tgl_penjualan)->format('d M Y');
        }
        
        $vendorList = DB::select("SELECT nama_vendor, total_pembelian, pembelian_sisa, pembelian_terbayar
        FROM vendor
        ORDER BY pembelian_sisa DESC
        ");
        foreach ($vendorList as $vendor) {
            $vendor->formattedTotal = number_format($vendor->total_pembelian, 0, ',', '.');
            $vendor->formattedBayar = number_format($vendor->pembelian_terbayar, 0, ',', '.');
            $vendor->formattedSisa = number_format($vendor->pembelian_sisa, 0, ',', '.');
        }

        $dataPembelianInvoice = collect();
        if (Schema::hasTable('pembelian') && Schema::hasTable('vendor')) {
            $dataPembelianInvoice = Pembelian::query()
                ->join('vendor', 'pembelian.id_vendor', '=', 'vendor.id')
                ->where('pembelian.sisa', '>', 0)
                ->where('pembelian.status', '<>', 'Batal')
                ->selectRaw('COALESCE(jenis_invoice, "Tanpa Pajak") as label, vendor.nama_vendor as vendor, tanggal, COUNT(*) as total_transaksi, SUM(pembelian.sisa) as total_nominal, COALESCE(SUM(pembelian.jumlah_harga), 0) as total_pembelian, COALESCE(SUM(pembelian.terbayar), 0) as terbayar, COALESCE(SUM(ppn_nominal), 0) as total_ppn, COALESCE(SUM(pph_nominal), 0) as total_pph')
                ->groupBy('jenis_invoice', 'vendor.nama_vendor', 'tanggal')
                ->orderBy('jenis_invoice')
                ->get()
                ->map(fn ($row) => [
                    'label' => $row->label ?: 'Tanpa Pajak',
                    'vendor' => $row->vendor,
                    'tanggal' => \Carbon\Carbon::parse($row->tanggal)->format('Y-m-d'),
                    'total_transaksi' => (int) $row->total_transaksi,
                    'total_nominal' => (float) $row->total_nominal,
                    'total_pembelian' => (float) $row->total_pembelian,
                    'terbayar' => (float) $row->terbayar,
                    'total_ppn' => (float) $row->total_ppn,
                    'total_pph' => (float) $row->total_pph,
                ])->values();
        }

        $daftarTagihanVendor = collect();
        if (Schema::hasTable('pembelian') && Schema::hasTable('vendor')) {
            $daftarTagihanVendor = Pembelian::query()
                ->join('vendor', 'pembelian.id_vendor', '=', 'vendor.id')
                ->where('pembelian.status', '<>', 'Batal')
                ->selectRaw('vendor.nama_vendor, sum(pembelian.jumlah_harga) as total_pembelian, sum(pembelian.terbayar) as terbayar, sum(pembelian.sisa) as sisa_tagihan')
                ->groupBy('vendor.id', 'vendor.nama_vendor')
                ->orderByDesc('sisa_tagihan')
                ->orderByDesc('total_pembelian')
                ->get()
                ->map(fn ($item) => [
                    'nama_vendor' => $item->nama_vendor,
                    'total_pembelian' => (float) $item->total_pembelian,
                    'terbayar' => (float) ($item->terbayar ?? ($item->total_pembelian - $item->sisa_tagihan)),
                    'sisa_tagihan' => (float) $item->sisa_tagihan,
                ])->values();
        }

        $existingVendorNames = $daftarTagihanVendor->pluck('nama_vendor')->toArray();
        foreach ($vendorList as $vRow) {
            $sisaVal = (float) $vRow->pembelian_sisa;
            if ($sisaVal > 0 && !in_array($vRow->nama_vendor, $existingVendorNames)) {
                $totVal = (float) $vRow->total_pembelian;
                $byrVal = (float) $vRow->pembelian_terbayar;
                $daftarTagihanVendor->push([
                    'nama_vendor' => $vRow->nama_vendor,
                    'total_pembelian' => $totVal,
                    'terbayar' => $byrVal,
                    'sisa_tagihan' => $sisaVal,
                ]);
                $dataPembelianInvoice->push([
                    'label' => 'Tanpa Pajak',
                    'vendor' => $vRow->nama_vendor,
                    'tanggal' => now()->format('Y-m-d'),
                    'total_transaksi' => 1,
                    'total_nominal' => $sisaVal,
                    'total_pembelian' => $totVal,
                    'terbayar' => $byrVal,
                    'total_ppn' => 0.0,
                    'total_pph' => 0.0,
                ]);
            }
        }
        
        // ✅ 3. TAMBAHKAN VARIABEL LAST YEAR KE DALAM COMPACT()
        return view('pages.welcome', compact(
            'jumlahPerBulan', 'jumlahPerTahun', 
            'dateArray','dateArrayLastYear', 
            'monthArray','monthArrayLastYear', 
            'totalHarianArray','totalHarianArrayLastYear', 
            'totalBulananArray','totalBulananArrayLastYear', 
            'hourArray', 'totalJamArray', 
            'weekArray', 'totalMingguanArray', 
            'jumlahPerHari', 'jumlahPerMinggu', 
            'datasInWeek', 'percentageInWeek', 'percentageNotPaidWeek', 'percentageCanceledWeek', 
            'datasInMonth', 'percentageInMonth', 'percentageNotPaidMonth', 'percentageCanceledMonth', 
            'datasInYear', 'percentageInYear', 'percentageNotPaidYear', 'percentageCanceledYear', 
            'datasInLastYear', 'percentageInLastYear', 'percentageNotPaidLastYear', 'percentageCanceledLastYear', // << VARIABEL BARU
            'jumlahBBPerBulan', 'jumlahBBPerTahun', 
            'jumlahPerBulanPO', 'jumlahPerTahunPO', 
            'dateArrayPO', 'monthArrayPO', 'totalHarianArrayPO', 'totalBulananArrayPO', 
            'hourArrayPO', 'totalJamArrayPO', 'weekArrayPO', 'totalMingguanArrayPO', 
            'jumlahPerHariPO', 'jumlahPerMingguPO', 'jumlahBBPerBulanPO', 'jumlahBBPerTahunPO', 
            'invoicePO','jumlahPO', 'jumlahPOLunas', 'jumlahPOBlmLunas', 
            'jumlahPOLunasToday', 'jumlahPOBlmLunasToday', 'jumlahPOLunasWeek', 'jumlahPOBlmLunasWeek', 
            'jumlahPOLunasMonth', 'jumlahPOBlmLunasMonth', 'jumlahPOLunasYear', 'jumlahPOBlmLunasYear',
            'datavendor', 'datasisa', 'vendorList', 'dataPembelianInvoice', 'daftarTagihanVendor'
        ));
    }



    public function getPenjualan()
    {
        try {
            $sql = "SELECT
            DATE_FORMAT(tgl_penjualan, '%Y-%m-%d%H:%i') AS jam_penjualan,
            -- DATE_FORMAT(tgl_penjualan, '%Y-%m-%d %H') AS jam_penjualan,
            SUM(total_pembayaran) AS total_perjam

            FROM penjualan
            WHERE jenis_pembayaran <> 'PO'
            AND status NOT IN ('Batal', 'Belum Lunas')
            AND deleted_at IS NULL
            AND DATE(tgl_penjualan) = CURDATE()
            GROUP BY jam_penjualan
            ORDER BY jam_penjualan DESC";

            $results = DB::select($sql);

            if (!empty($results)) {
                $jam_penjualan = [];
                $total_perjam = [];
                foreach ($results as $row) {
                    $datetime = date('H:i', strtotime($row->jam_penjualan));
                    $datetime_with_offset = date('Y-m-d H:i', strtotime($datetime . ' +7 hours'));
                    $jam_penjualan[] = $datetime_with_offset;
                    $total_perjam[] = $row->total_perjam;
                }
                return [
                    'jamPenjualan' => $jam_penjualan,
                    'totalPerjam' => $total_perjam,
                ];
            } else {
                return [
                    'jamPenjualan' => [],
                    'totalPerjam' => [],
                ];
            }
        } catch (\PDOException $e) {
            dd($e->getMessage());
            return 'Error';
        }
    }

    public function getDataPenjualan()
    {
        try {
            $sql = "SELECT
            tanggal_penjualan,
            bulan_penjualan,
            SUM(total_harian) AS total_harian,
            SUM(total_bulanan) AS total_bulanan
            FROM (
                SELECT
                    DATE_FORMAT(tgl_penjualan, '%Y-%m-%d') AS tanggal_penjualan,
                    DATE_FORMAT(tgl_penjualan, '%Y-%m-%d') AS bulan_penjualan,
                    total_pembayaran AS total_harian,
                    CASE WHEN MONTH(tgl_penjualan) AND YEAR(tgl_penjualan) = YEAR(NOW()) THEN total_pembayaran ELSE 0 END AS total_bulanan
                FROM penjualan
                WHERE jenis_pembayaran <> 'PO'
                AND status NOT IN ('Batal', 'Belum Lunas')
                AND deleted_at IS NULL
                AND MONTH(tgl_penjualan) = MONTH(NOW())
            ) AS subquery
            GROUP BY tanggal_penjualan, bulan_penjualan
            ORDER BY tanggal_penjualan DESC";


            $results = DB::select($sql);

            if (!empty($results)) {
                $bulan_penjualan = [];
                $tanggal_penjualan = [];
                $total_harian = [];
                $total_bulanan = [];

                foreach ($results as $row) {

                    $tanggal_penjualan[] = $row->bulan_penjualan;
                    $total_harian[] = $row->total_harian;
                    $total_bulanan[] = $row->total_bulanan;
                }

                return [
                    'bulanPenjualan' => $bulan_penjualan,
                    'tanggalPenjualan' => $tanggal_penjualan,
                    'totalHarian' => $total_harian,
                    'totalBulanan' => $total_bulanan,
                ];
            } else {
                return [
                    'bulanPenjualan' => [],
                    'tanggalPenjualan' => [],
                    'totalHarian' => [],
                    'totalBulanan' => [],
                ];
            }
            // dd($sql);
        } catch (\PDOException $e) {
            // dd($e->getMessage());
            return 'Error';
        }
    }
        public function getDataPenjualanLastYear()
{
    try {
        $sql = "SELECT
            tanggal_penjualan,
            bulan_penjualan,
            SUM(total_harian) AS total_harian,
            SUM(total_bulanan) AS total_bulanan
        FROM (
            SELECT
                DATE_FORMAT(tgl_penjualan, '%Y-%m-%d') AS tanggal_penjualan,
                DATE_FORMAT(tgl_penjualan, '%Y-%m-%d') AS bulan_penjualan,
                total_pembayaran AS total_harian,
                CASE WHEN MONTH(tgl_penjualan) AND YEAR(tgl_penjualan) = YEAR(NOW()) - 1 THEN total_pembayaran ELSE 0 END AS total_bulanan
            FROM penjualan
            WHERE jenis_pembayaran <> 'PO'
            AND status NOT IN ('Batal', 'Belum Lunas')
            AND deleted_at IS NULL
            AND MONTH(tgl_penjualan) <= MONTH(NOW())
            AND YEAR(tgl_penjualan) = YEAR(NOW()) - 1
        ) AS subquery
        GROUP BY tanggal_penjualan, bulan_penjualan
        ORDER BY tanggal_penjualan DESC";

        $results = DB::select($sql);

        if (!empty($results)) {
            $tanggal_penjualan = [];
            $total_harian = [];
            $total_bulanan = [];

            foreach ($results as $row) {
                $tanggal_penjualan[] = $row->bulan_penjualan;
                $total_harian[] = $row->total_harian;
                $total_bulanan[] = $row->total_bulanan;
            }

            return [
                'tanggalPenjualanLastYear' => $tanggal_penjualan,
                'totalHarianLastYear' => $total_harian,
                'totalBulananLastYear' => $total_bulanan,
            ];
        } else {
            return [
                'tanggalPenjualanLastYear' => [],
                'totalHarianLastYear' => [],
                'totalBulananLastYear' => [],
            ];
        }
    } catch (\PDOException $e) {
        return 'Error';
    }
}

    public function getPerminggu()
    {
        try {
            $sql = "SELECT
                tanggal_penjualan,
                SUM(total_harian) AS total_harian
                FROM (
                    SELECT
                        DATE_FORMAT(tgl_penjualan, '%Y-%m-%d') AS tanggal_penjualan,
                        total_pembayaran AS total_harian
                    FROM penjualan
                    WHERE jenis_pembayaran <> 'PO'
                    AND status NOT IN ('Batal', 'Belum Lunas')
                    AND deleted_at IS NULL
                    AND tgl_penjualan >= DATE(NOW() - INTERVAL (DAYOFWEEK(NOW()) - 2) DAY) -- Start of current week (Monday)
                    AND tgl_penjualan <= DATE(NOW() - INTERVAL (DAYOFWEEK(NOW()) - 8) DAY) -- End of current week (Saturday)
                ) AS subquery
                GROUP BY tanggal_penjualan
                ORDER BY tanggal_penjualan DESC";

            $results = DB::select($sql);

            if (!empty($results)) {
                $tanggal_penjualan = [];
                $total_harian = [];

                foreach ($results as $row) {
                    $tanggal_penjualan[] = $row->tanggal_penjualan;
                    $total_harian[] = $row->total_harian;
                }

                return [
                    'tanggalPenjualan' => $tanggal_penjualan,
                    'totalHarian' => $total_harian,
                ];
            } else {
                return [
                    'tanggalPenjualan' => [],
                    'totalHarian' => [],

                ];
            }
        } catch (\PDOException $e) {
            // dd($e->getMessage());
            return 'Error';
        }
    }



    function getPerbulan()
    {
        try {
            $sql = "SELECT
            DATE_FORMAT(tgl_penjualan, '%Y-%m') AS bulan_penjualan,
            SUM(total_pembayaran) AS total_bulanan
        FROM (
            SELECT DISTINCT nomor_invoice, tgl_penjualan, total_pembayaran
            FROM penjualan
            WHERE jenis_pembayaran <> 'PO'
            AND status NOT IN ('Batal', 'Belum Lunas')
            AND deleted_at IS NULL
                AND YEAR(tgl_penjualan) = YEAR(NOW())
        ) AS subquery
        GROUP BY DATE_FORMAT(tgl_penjualan, '%Y-%m')
        ORDER BY bulan_penjualan DESC";

            $results = DB::select($sql);

            if (!empty($results)) {
                $bulan_penjualan = [];
                $total_bulanan = [];

                foreach ($results as $row) {
                    $bulan_penjualan[] = $row->bulan_penjualan;
                    $total_bulanan[] = $row->total_bulanan;
                }

                return [
                    'bulanPenjualan' => $bulan_penjualan,
                    'totalBulanan' => $total_bulanan,
                ];
            } else {
                return [
                    'bulanPenjualan' => [],
                    'totalBulanan' => [],
                ];
            }
        } catch (\PDOException $e) {
            dd($e->getMessage());
            return 'Error';
        }
    }
     function getPerbulanLastYear()
{
    try {
        $sql = "SELECT
            DATE_FORMAT(tgl_penjualan, '%Y-%m') AS bulan_penjualan,
            SUM(total_pembayaran) AS total_bulanan
        FROM (
            SELECT DISTINCT nomor_invoice, tgl_penjualan, total_pembayaran
            FROM penjualan
            WHERE status NOT IN ('Batal', 'Belum Lunas')
            AND deleted_at IS NULL
                AND YEAR(tgl_penjualan) = YEAR(NOW()) - 1
        ) AS subquery
        GROUP BY DATE_FORMAT(tgl_penjualan, '%Y-%m')
        ORDER BY bulan_penjualan ASC";

        $results = DB::select($sql);

        if (!empty($results)) {
            $bulan_penjualan_last_year = [];
            $total_bulanan_last_year = [];

            foreach ($results as $row) {
                $bulan_penjualan_last_year[] = $row->bulan_penjualan;
                $total_bulanan_last_year[] = $row->total_bulanan;
            }

            return [
                'bulanPenjualanLastYear' => $bulan_penjualan_last_year,
                'totalBulananLastYear' => $total_bulanan_last_year,
            ];
        } else {
            return [
                'bulanPenjualanLastYear' => [],
                'totalBulananLastYear' => [],
            ];
        }
    } catch (\PDOException $e) {
        dd($e->getMessage());
        return 'Error';
    }
}


    function getTotalPerMinggu()
    {
        Carbon::setLocale('id');
        $today = Carbon::now();
        $startDate = $today->startOfWeek()->isoFormat('YYYY-MM-DD');
        $endDate = $today->endOfWeek()->isoFormat('YYYY-MM-DD');
        $previousWeekStart = $today->subWeek()->startOfWeek()->isoFormat('YYYY-MM-DD');
        $previousWeekEnd = $today->endOfWeek()->isoFormat('YYYY-MM-DD');

        $invoice = Penjualan::whereBetween('tgl_penjualan', [$startDate, $endDate])->get();
        $previousInv = Penjualan::whereBetween('tgl_penjualan', [$previousWeekStart, $previousWeekEnd])->get();
        $penjualanInvoice = $invoice->sum('total_pembayaran');
        $bayar = [];
        $blmBayar = [];
        $btlBayar = [];
        $preBayar = [];
        $preBlmBayar = [];
        $preBtlBayar = [];
        foreach ($invoice as $inv) {

            if ($inv->status == 'Belum Lunas') {
                $bayar[] = $inv->dp;
                $blmBayar[] = $inv->total_pembayaran - $inv->dp;
            } elseif ($inv->status == 'Lunas') {
                $bayar[] = $inv->total_pembayaran;
            } else {
                $btlBayar[] = $inv->total_pembayaran;
            }
        }
        foreach ($previousInv as $preinv) {
            if ($preinv->status == 'Belum Lunas') {
                $preBayar[] = $preinv->dp;
                $preBlmBayar[] = $preinv->total_pembayaran - $preinv->dp;
            } elseif ($preinv->status == 'Lunas') {
                $preBayar[] = $preinv->total_pembayaran;
            } else {
                $preBtlBayar[] = $preinv->total_pembayaran;
            }
        }
        $moneyIn = array_sum($bayar);
        $remainNotPaid = array_sum($blmBayar);
        $canceledPaid = array_sum($btlBayar);
        $preMoneyIn = array_sum($preBayar);
        $preRemainNotPaid = array_sum($preBlmBayar);
        $preCanceledPaid = array_sum($preBtlBayar);

        $datas = [$moneyIn, $remainNotPaid, $canceledPaid];

        $moneyInIncreasePercentage = number_format((($preMoneyIn != 0) ? (($moneyIn - $preMoneyIn) / $preMoneyIn) * 100 : 0), 2);
        $remainNotPaidDecreasePercentage = number_format((($preRemainNotPaid != 0) ? (($preRemainNotPaid - $remainNotPaid) / $preRemainNotPaid) * 100 : 0), 2);
        $canceledPaidIncreasePercentage = ($preCanceledPaid != 0) ? (($canceledPaid - $preCanceledPaid) / $preCanceledPaid) * 100 : 0;
        // return [$canceledPaid, $preCanceledPaid, $moneyInIncreasePercentage, $canceledPaidIncreasePercentage, $remainNotPaidDecreasePercentage];
        // return [$moneyIn, $remainNotPaid, $canceledPaid];
        return [
            'weekDatas' => $datas,
            'weekIn' => $moneyInIncreasePercentage,
            'weekNotPaid' => $remainNotPaidDecreasePercentage,
            'weekCanceled' => $canceledPaidIncreasePercentage,
        ];
    }

    function getTotalPerBulan()
    {
        Carbon::setLocale('id');
        $today = Carbon::now();
        $startDate = $today->startOfMonth()->isoFormat('YYYY-MM-DD');
        $endDate = $today->endOfMonth()->isoFormat('YYYY-MM-DD');
        $previousMonthStart = $today->subMonth()->startOfMonth()->isoFormat('YYYY-MM-DD');
        $previousMonthEnd = $today->endOfMonth()->isoFormat('YYYY-MM-DD');

        $invoice = Penjualan::whereBetween('tgl_penjualan', [$startDate, $endDate])->get();
        $previousInv = Penjualan::whereBetween('tgl_penjualan', [$previousMonthStart, $previousMonthEnd])->get();
        // $penjualanInvoice = $invoice->sum('total_pembayaran');
        $bayar = [];
        $blmBayar = [];
        $btlBayar = [];
        $preBayar = [];
        $preBlmBayar = [];
        $preBtlBayar = [];

        foreach ($invoice as $inv) {
            if ($inv->status == 'Belum Lunas') {
                $bayar[] = $inv->dp;
                $blmBayar[] = $inv->total_pembayaran - $inv->dp;
            } elseif ($inv->status == 'Lunas') {
                $bayar[] = $inv->total_pembayaran;
            } else {
                $btlBayar[] = $inv->total_pembayaran;
            }
        }

        foreach ($previousInv as $preinv) {
            if ($preinv->status == 'Belum Lunas') {
                $preBayar[] = $preinv->dp;
                $preBlmBayar[] = $preinv->total_pembayaran - $preinv->dp;
            } elseif ($preinv->status == 'Lunas') {
                $preBayar[] = $preinv->total_pembayaran;
            } else {
                $preBtlBayar[] = $preinv->total_pembayaran;
            }
        }

        // dd($previousInv);
        $moneyIn = array_sum($bayar);
        $remainNotPaid = array_sum($blmBayar);
        $canceledPaid = array_sum($btlBayar);
        $preMoneyIn = array_sum($preBayar);
        $preRemainNotPaid = array_sum($preBlmBayar);
        $preCanceledPaid = array_sum($preBtlBayar);

        $datas = [$moneyIn, $remainNotPaid, $canceledPaid];

        $moneyInIncreasePercentage = number_format((($preMoneyIn != 0) ? (($moneyIn - $preMoneyIn) / $preMoneyIn) * 100 : 0), 2);
        $remainNotPaidDecreasePercentage = number_format((($preRemainNotPaid != 0) ? (($preRemainNotPaid - $remainNotPaid) / $preRemainNotPaid) * 100 : 0), 2);
        $canceledPaidIncreasePercentage = number_format((($preCanceledPaid != 0) ? (($canceledPaid - $preCanceledPaid) / $preCanceledPaid) * 100 : 0), 2);

        return [
            'monthDatas' => $datas,
            'monthIn' => $moneyInIncreasePercentage,
            'monthNotPaid' => $remainNotPaidDecreasePercentage,
            'monthCanceled' => $canceledPaidIncreasePercentage,
        ];
    }

    function getTotalPerTahun()
    {
        Carbon::setLocale('id');
        $today = Carbon::now();
        $startDate = $today->startOfYear()->isoFormat('YYYY-MM-DD');
        $endDate = $today->endOfYear()->isoFormat('YYYY-MM-DD');
        $previousYearStart = $today->subYear()->startOfYear()->isoFormat('YYYY-MM-DD');
        $previousYearEnd = $today->endOfYear()->isoFormat('YYYY-MM-DD');

        $invoice = Penjualan::whereBetween('tgl_penjualan', [$startDate, $endDate])->get();
        $previousInv = Penjualan::whereBetween('tgl_penjualan', [$previousYearStart, $previousYearEnd])->get();
        $penjualanInvoice = $invoice->sum('total_pembayaran');
        $bayar = [];
        $blmBayar = [];
        $btlBayar = [];
        $preBayar = [];
        $preBlmBayar = [];
        $preBtlBayar = [];

        foreach ($invoice as $inv) {
            if ($inv->status == 'Belum Lunas') {
                $bayar[] = $inv->dp;
                $blmBayar[] = $inv->total_pembayaran - $inv->dp;
            } elseif ($inv->status == 'Lunas') {
                $bayar[] = $inv->total_pembayaran;
            } else {
                $btlBayar[] = $inv->total_pembayaran;
            }
        }

        foreach ($previousInv as $preinv) {
            if ($preinv->status == 'Belum Lunas') {
                $preBayar[] = $preinv->dp;
                $preBlmBayar[] = $preinv->total_pembayaran - $preinv->dp;
            } elseif ($preinv->status == 'Lunas') {
                $preBayar[] = $preinv->total_pembayaran;
            } else {
                $preBtlBayar[] = $preinv->total_pembayaran;
            }
        }

        $moneyIn = array_sum($bayar);
        $remainNotPaid = array_sum($blmBayar);
        $canceledPaid = array_sum($btlBayar);
        $preMoneyIn = array_sum($preBayar);
        $preRemainNotPaid = array_sum($preBlmBayar);
        $preCanceledPaid = array_sum($preBtlBayar);

        $datas = [$moneyIn, $remainNotPaid, $canceledPaid];

        $moneyInIncreasePercentage = number_format((($preMoneyIn != 0) ? (($moneyIn - $preMoneyIn) / $preMoneyIn) * 100 : 0), 2);
        $remainNotPaidDecreasePercentage = number_format((($preRemainNotPaid != 0) ? (($preRemainNotPaid - $remainNotPaid) / $preRemainNotPaid) * 100 : 0), 2);
        $canceledPaidIncreasePercentage = number_format((($preCanceledPaid != 0) ? (($canceledPaid - $preCanceledPaid) / $preCanceledPaid) * 100 : 0), 2);
        // dd($canceledPaid, $preBtlBayar);
        return [
            'yearDatas' => $datas,
            'yearIn' => $moneyInIncreasePercentage,
            'yearNotPaid' => $remainNotPaidDecreasePercentage,
            'yearCanceled' => $canceledPaidIncreasePercentage,
        ];
    }
    
    // ✅ 4. FUNGSI BARU: Total Per Tahun Lalu (Dengan Persentase vs 2 Tahun Lalu)
    function getTotalPerTahunLalu()
    {
        Carbon::setLocale('id');
        
        // 1. Ambil Periode TAHUN LALU (Data Utama)
        // Jika sekarang 2025, maka ini 2024
        $startDate = Carbon::now()->subYear()->startOfYear()->isoFormat('YYYY-MM-DD');
        $endDate = Carbon::now()->subYear()->endOfYear()->isoFormat('YYYY-MM-DD');
        
        // 2. Ambil Periode 2 TAHUN LALU (Data Pembanding)
        // Jika sekarang 2025, maka ini 2023.
        // Kita WAJIB mengambil ini hanya untuk menghitung rumus persentase, 
        // meskipun data 2023 ini tidak ditampilkan ke user.
        $previousYearStart = Carbon::now()->subYears(2)->startOfYear()->isoFormat('YYYY-MM-DD');
        $previousYearEnd = Carbon::now()->subYears(2)->endOfYear()->isoFormat('YYYY-MM-DD');

        // Ambil Data dari Database
        $invoice = Penjualan::whereBetween('tgl_penjualan', [$startDate, $endDate])->get();
        $previousInv = Penjualan::whereBetween('tgl_penjualan', [$previousYearStart, $previousYearEnd])->get();
        
        $bayar = []; $blmBayar = []; $btlBayar = [];
        $preBayar = []; $preBlmBayar = []; $preBtlBayar = [];

        // Loop Data Tahun Lalu (Utama)
        foreach ($invoice as $inv) {
            if ($inv->status == 'Belum Lunas') {
                $bayar[] = $inv->dp;
                $blmBayar[] = $inv->total_pembayaran - $inv->dp;
            } elseif ($inv->status == 'Lunas') {
                $bayar[] = $inv->total_pembayaran;
            } else {
                $btlBayar[] = $inv->total_pembayaran;
            }
        }

        // Loop Data 2 Tahun Lalu (Pembanding)
        foreach ($previousInv as $preinv) {
            if ($preinv->status == 'Belum Lunas') {
                $preBayar[] = $preinv->dp;
                $preBlmBayar[] = $preinv->total_pembayaran - $preinv->dp;
            } elseif ($preinv->status == 'Lunas') {
                $preBayar[] = $preinv->total_pembayaran;
            } else {
                $preBtlBayar[] = $preinv->total_pembayaran;
            }
        }

        // Hitung Total Uang
        $moneyIn = array_sum($bayar);
        $remainNotPaid = array_sum($blmBayar);
        $canceledPaid = array_sum($btlBayar);
        
        // Hitung Total Uang Pembanding
        $preMoneyIn = array_sum($preBayar);
        $preRemainNotPaid = array_sum($preBlmBayar);
        $preCanceledPaid = array_sum($preBtlBayar);

        $datas = [$moneyIn, $remainNotPaid, $canceledPaid];

        // Rumus Persentase (Sekarang bekerja karena ada pembanding)
        $moneyInIncreasePercentage = number_format((($preMoneyIn != 0) ? (($moneyIn - $preMoneyIn) / $preMoneyIn) * 100 : 0), 2);
        $remainNotPaidDecreasePercentage = number_format((($preRemainNotPaid != 0) ? (($preRemainNotPaid - $remainNotPaid) / $preRemainNotPaid) * 100 : 0), 2);
        $canceledPaidIncreasePercentage = number_format((($preCanceledPaid != 0) ? (($canceledPaid - $preCanceledPaid) / $preCanceledPaid) * 100 : 0), 2);

        return [
            'lastYearDatas' => $datas,
            'lastYearIn' => $moneyInIncreasePercentage,
            'lastYearNotPaid' => $remainNotPaidDecreasePercentage,
            'lastYearCanceled' => $canceledPaidIncreasePercentage,
        ];
    }
    
    public function vendor()
    {
        $vendors = Vendor::orderByDesc('nama_vendor')->get();
        $nama_vendor = [];
        $total_sisa = [];

        foreach ($vendors as $vendor) {
            $vendor->formattedTotal = $vendor->total_pembelian;
            $vendor->formattedTerbayar = $vendor->pembelian_terbayar;
            $vendor->formattedSisa = $vendor->pembelian_sisa;
            $nama_vendor[] = $vendor->nama_vendor;
            $total_sisa[] = $vendor->pembelian_sisa;
        }


        return [
            'vendor' => $nama_vendor,
            'sisa' => $total_sisa,

        ];
    }

    /**
     * Mengambil data agregasi jenis barang dan kategori barang yang dibeli untuk grafik dashboard
     */
    public function getDataBarangDibeli(Request $request)
    {
        Carbon::setLocale('id');
        $filter = $request->input('filter', 'month');
        $now = Carbon::now();
        $periodLabel = '';

        $query = DB::table('penjualan_barang')
            ->join('penjualan', 'penjualan_barang.penjualan_id', '=', 'penjualan.id')
            ->join('barang', 'penjualan_barang.barang_id', '=', 'barang.id')
            ->leftJoin('kategori_barang', 'barang.kategori_id', '=', 'kategori_barang.id')
            ->whereNull('penjualan_barang.deleted_at')
            ->whereNull('penjualan.deleted_at')
            ->where('penjualan.status', '<>', 'Batal');

        switch ($filter) {
            case 'today':
                $query->whereDate('penjualan.tgl_penjualan', $now->toDateString());
                $periodLabel = 'Hari Ini (' . $now->translatedFormat('d F Y') . ')';
                break;

            case 'week':
                $startOfWeek = $now->copy()->startOfWeek()->toDateString();
                $endOfWeek = $now->copy()->endOfWeek()->toDateString();
                $query->whereBetween(DB::raw('DATE(penjualan.tgl_penjualan)'), [$startOfWeek, $endOfWeek]);
                $periodLabel = 'Minggu Ini (' . Carbon::parse($startOfWeek)->translatedFormat('d M') . ' - ' . Carbon::parse($endOfWeek)->translatedFormat('d M Y') . ')';
                break;

            case 'month':
                $query->whereYear('penjualan.tgl_penjualan', $now->year)
                      ->whereMonth('penjualan.tgl_penjualan', $now->month);
                $periodLabel = 'Bulan Ini (' . $now->translatedFormat('F Y') . ')';
                break;

            case 'year':
                $query->whereYear('penjualan.tgl_penjualan', $now->year);
                $periodLabel = 'Tahun Ini (' . $now->year . ')';
                break;

            case 'last_year':
                $lastYear = $now->copy()->subYear()->year;
                $query->whereYear('penjualan.tgl_penjualan', $lastYear);
                $periodLabel = 'Tahun Lalu (' . $lastYear . ')';
                break;

            case 'custom':
                $customType = $request->input('custom_type', 'date');
                if ($customType === 'date') {
                    $startDate = $request->input('start_date');
                    $endDate = $request->input('end_date');
                    if ($startDate && $endDate) {
                        if ($startDate === $endDate) {
                            $query->whereDate('penjualan.tgl_penjualan', $startDate);
                            $periodLabel = Carbon::parse($startDate)->translatedFormat('d F Y');
                        } else {
                            $query->whereBetween(DB::raw('DATE(penjualan.tgl_penjualan)'), [$startDate, $endDate]);
                            $periodLabel = Carbon::parse($startDate)->translatedFormat('d M Y') . ' s/d ' . Carbon::parse($endDate)->translatedFormat('d M Y');
                        }
                    } elseif ($startDate) {
                        $query->whereDate('penjualan.tgl_penjualan', $startDate);
                        $periodLabel = Carbon::parse($startDate)->translatedFormat('d F Y');
                    } elseif ($endDate) {
                        $query->whereDate('penjualan.tgl_penjualan', $endDate);
                        $periodLabel = Carbon::parse($endDate)->translatedFormat('d F Y');
                    } else {
                        $periodLabel = 'Semua Tanggal';
                    }
                } elseif ($customType === 'month_year') {
                    $bulan = (int)$request->input('bulan', $now->month);
                    $tahun = (int)$request->input('tahun', $now->year);
                    $query->whereYear('penjualan.tgl_penjualan', $tahun)
                          ->whereMonth('penjualan.tgl_penjualan', $bulan);
                    $periodLabel = Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F Y');
                } elseif ($customType === 'year') {
                    $tahun = (int)$request->input('tahun', $now->year);
                    $query->whereYear('penjualan.tgl_penjualan', $tahun);
                    $periodLabel = 'Tahun ' . $tahun;
                }
                break;

            default:
                $query->whereYear('penjualan.tgl_penjualan', $now->year)
                      ->whereMonth('penjualan.tgl_penjualan', $now->month);
                $periodLabel = 'Bulan Ini (' . $now->translatedFormat('F Y') . ')';
                break;
        }

        // Query jenis barang (Top 10)
        $jenisQuery = (clone $query)
            ->select(
                'barang.jenis_barang',
                DB::raw('SUM(penjualan_barang.qty) as total_qty'),
                DB::raw('SUM(penjualan_barang.jumlah_harga) as total_nominal')
            )
            ->groupBy('barang.jenis_barang')
            ->orderByDesc('total_qty')
            ->take(10)
            ->get();

        // Query kategori barang
        $kategoriQuery = (clone $query)
            ->select(
                DB::raw("COALESCE(NULLIF(kategori_barang.nama_kategori, ''), 'Lainnya') as nama_kategori"),
                DB::raw('SUM(penjualan_barang.qty) as total_qty'),
                DB::raw('SUM(penjualan_barang.jumlah_harga) as total_nominal')
            )
            ->groupBy('kategori_barang.nama_kategori')
            ->orderByDesc('total_qty')
            ->get();

        // Summary calculations
        $totalQtyAll = (clone $query)->sum('penjualan_barang.qty') ?: 0;
        $totalNominalAll = (clone $query)->sum('penjualan_barang.jumlah_harga') ?: 0;
        $totalInvoiceCount = (clone $query)->distinct('penjualan.id')->count('penjualan.id') ?: 0;

        $topJenis = $jenisQuery->first() ? $jenisQuery->first()->jenis_barang . ' (' . number_format($jenisQuery->first()->total_qty, 0, ',', '.') . ' Pcs)' : '-';
        $topKategori = $kategoriQuery->first() ? $kategoriQuery->first()->nama_kategori . ' (' . number_format($kategoriQuery->first()->total_qty, 0, ',', '.') . ' Pcs)' : '-';

        // Prepare data for ApexCharts
        $jenisLabels = [];
        $jenisQty = [];
        $jenisNominal = [];
        foreach ($jenisQuery as $j) {
            $jenisLabels[] = $j->jenis_barang;
            $jenisQty[] = (int)$j->total_qty;
            $jenisNominal[] = (int)$j->total_nominal;
        }

        $kategoriLabels = [];
        $kategoriQty = [];
        $kategoriNominal = [];
        $kategoriList = [];
        foreach ($kategoriQuery as $k) {
            $qty = (int)$k->total_qty;
            $nominal = (int)$k->total_nominal;
            $percentage = $totalQtyAll > 0 ? round(($qty / $totalQtyAll) * 100, 1) : 0;

            $kategoriLabels[] = $k->nama_kategori;
            $kategoriQty[] = $qty;
            $kategoriNominal[] = $nominal;

            $kategoriList[] = [
                'nama' => $k->nama_kategori,
                'qty' => $qty,
                'qty_formatted' => number_format($qty, 0, ',', '.') . ' Pcs',
                'nominal' => $nominal,
                'nominal_formatted' => 'Rp ' . number_format($nominal, 0, ',', '.'),
                'percentage' => $percentage
            ];
        }

        return response()->json([
            'status' => 'success',
            'period_label' => $periodLabel ?: 'Periode Terpilih',
            'summary' => [
                'total_qty' => (int)$totalQtyAll,
                'total_qty_formatted' => number_format($totalQtyAll, 0, ',', '.') . ' Pcs',
                'total_nominal' => (int)$totalNominalAll,
                'total_nominal_formatted' => 'Rp ' . number_format($totalNominalAll, 0, ',', '.'),
                'total_invoices' => $totalInvoiceCount,
                'total_jenis_count' => $jenisQuery->count(),
                'total_kategori_count' => $kategoriQuery->count(),
                'top_jenis' => $topJenis,
                'top_kategori' => $topKategori,
            ],
            'jenis_barang' => [
                'labels' => $jenisLabels,
                'qty' => $jenisQty,
                'nominal' => $jenisNominal,
            ],
            'kategori_barang' => [
                'labels' => $kategoriLabels,
                'qty' => $kategoriQty,
                'nominal' => $kategoriNominal,
                'list' => $kategoriList,
            ]
        ]);
    }

    /**
     * Mengambil data Payment Activity dan Structure untuk grafik dashboard
     */
    public function getDataPaymentActivity(Request $request)
    {
        Carbon::setLocale('id');
        $filter = $request->input('filter', 'month');
        $customType = $request->input('custom_type', 'date');
        $now = Carbon::now();

        $viewType = 'range';
        $periodLabel = '';
        $startDate = null;
        $endDate = null;
        $tahun = $now->year;

        if ($filter === 'today' || $filter === 'day') {
            $viewType = 'day';
            $startDate = $now->toDateString();
            $endDate = $now->toDateString();
            $periodLabel = 'Hari Ini (' . $now->translatedFormat('d F Y') . ')';
        } elseif ($filter === 'week') {
            $viewType = 'range';
            $startDate = $now->copy()->startOfWeek()->toDateString();
            $endDate = $now->copy()->endOfWeek()->toDateString();
            $periodLabel = 'Minggu Ini (' . Carbon::parse($startDate)->translatedFormat('d M') . ' - ' . Carbon::parse($endDate)->translatedFormat('d M Y') . ')';
        } elseif ($filter === 'month') {
            $viewType = 'range';
            $startDate = $now->copy()->startOfMonth()->toDateString();
            $endDate = $now->toDateString();
            $periodLabel = 'Bulan Ini (' . $now->translatedFormat('F Y') . ')';
        } elseif ($filter === 'year') {
            $viewType = 'year';
            $tahun = $now->year;
            $periodLabel = 'Tahun Ini (' . $tahun . ')';
        } elseif ($filter === 'lastYear' || $filter === 'last_year') {
            $viewType = 'year';
            $tahun = $now->copy()->subYear()->year;
            $periodLabel = 'Tahun Lalu (' . $tahun . ')';
        } elseif ($filter === 'custom') {
            if ($customType === 'date') {
                $start = $request->input('start_date');
                $end = $request->input('end_date') ?: $start;
                if ($start === $end) {
                    $viewType = 'day';
                    $startDate = $start;
                    $endDate = $end;
                    $periodLabel = Carbon::parse($start)->translatedFormat('d F Y');
                } else {
                    $viewType = 'range';
                    $startDate = min($start, $end);
                    $endDate = max($start, $end);
                    $periodLabel = Carbon::parse($startDate)->translatedFormat('d M Y') . ' s/d ' . Carbon::parse($endDate)->translatedFormat('d M Y');
                }
            } elseif ($customType === 'month_year') {
                $bulan = (int)$request->input('bulan', $now->month);
                $tahun = (int)$request->input('tahun', $now->year);
                $dateObj = Carbon::createFromDate($tahun, $bulan, 1);
                $viewType = 'range';
                $startDate = $dateObj->copy()->startOfMonth()->toDateString();
                if ($tahun === $now->year && $bulan === $now->month) {
                    $endDate = $now->toDateString();
                } else {
                    $endDate = $dateObj->copy()->endOfMonth()->toDateString();
                }
                $periodLabel = $dateObj->translatedFormat('F Y');
            } elseif ($customType === 'year') {
                $viewType = 'year';
                $tahun = (int)$request->input('tahun', $now->year);
                $periodLabel = 'Tahun ' . $tahun;
            }
        }

        $chartData = [];
        $incomeTextHtml = '';

        if ($viewType === 'day') {
            $salesHourly = DB::table('penjualan')
                ->where('jenis_pembayaran', '<>', 'PO')
                ->whereNotIn('status', ['Batal', 'Belum Lunas'])
                ->whereNull('deleted_at')
                ->whereDate('tgl_penjualan', $startDate)
                ->selectRaw("DATE_FORMAT(tgl_penjualan, '%H:00') as jam, SUM(total_pembayaran) as total")
                ->groupBy('jam')
                ->pluck('total', 'jam');

            $categories = [];
            $seriesData = [];
            $totalFaktual = 0;

            for ($h = 8; $h <= 18; $h++) {
                $jamStr = sprintf("%02d:00", $h);
                $categories[] = $jamStr;
                $tot = isset($salesHourly[$jamStr]) ? (int)$salesHourly[$jamStr] : 0;
                $seriesData[] = $tot;
                $totalFaktual += $tot;
            }

            $chartData = [
                'type' => 'day',
                'categories' => $categories,
                'series' => [
                    [
                        'name' => 'Pendapatan',
                        'data' => $seriesData,
                        'color' => '#2DD4BF'
                    ]
                ]
            ];

            $incomeTextHtml = '
                <div class="d-flex flex-column gap-1.5">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="text-muted fs-12">Total Transaksi Hari Ini</span>
                        <span class="fw-bold text-light fs-13 tabular-nums">Rp ' . number_format($totalFaktual, 0, ',', '.') . '</span>
                    </div>
                </div>';

        } elseif ($viewType === 'range') {
            $salesDaily = DB::table('penjualan')
                ->where('jenis_pembayaran', '<>', 'PO')
                ->whereNotIn('status', ['Batal', 'Belum Lunas'])
                ->whereNull('deleted_at')
                ->whereBetween(DB::raw('DATE(tgl_penjualan)'), [$startDate, $endDate])
                ->selectRaw('DATE(tgl_penjualan) as tgl, SUM(total_pembayaran) as total')
                ->groupBy('tgl')
                ->pluck('total', 'tgl');

            $startC = Carbon::parse($startDate);
            $endC = Carbon::parse($endDate);

            $categories = [];
            $filteredData = [];
            $totalTransaksiAsli = 0;
            $totalPositif = 0;
            $totalNegatif = 0;

            $isSingleMonth = ($startC->format('Y-m') === $endC->format('Y-m'));

            while ($startC->lte($endC)) {
                $tglStr = $startC->toDateString();
                $categories[] = $isSingleMonth ? $startC->format('d') : $startC->format('d M');

                $transaksi = isset($salesDaily[$tglStr]) ? (int)$salesDaily[$tglStr] : 0;
                $totalTransaksiAsli += $transaksi;

                $net = $transaksi - 500000;
                $filteredData[] = $net;

                if ($net > 0) {
                    $totalPositif += $net;
                } else {
                    $totalNegatif += $net;
                }

                $startC->addDay();
            }

            $netIncome = $totalPositif + $totalNegatif;

            $chartData = [
                'type' => 'range',
                'categories' => $categories,
                'series' => [
                    [
                        'name' => 'Pendapatan',
                        'data' => $filteredData
                    ]
                ]
            ];

            $periodName = $periodLabel ?: 'Periode Ini';
            $incomeTextHtml = '
                <div class="d-flex flex-column gap-1.5">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="text-muted fs-12">Total Transaksi Faktual Lunas</span>
                        <span class="fw-bold text-light fs-13 tabular-nums">Rp ' . number_format($totalTransaksiAsli, 0, ',', '.') . '</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="text-muted fs-12">Total Beban Operasional</span>
                        <span class="fw-bold text-light fs-13 tabular-nums">Rp ' . number_format(abs($totalNegatif), 0, ',', '.') . '</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pt-1" style="border-top: 1px solid rgba(255,255,255,0.06);">
                        <span class="fs-12" style="color: #818CF8;">Pendapatan Bersih</span>
                        <span class="fw-bold fs-13 tabular-nums" style="color: #818CF8;">Rp ' . number_format($netIncome, 0, ',', '.') . '</span>
                    </div>
                </div>';

        } elseif ($viewType === 'year') {
            $salesMonthly = DB::table('penjualan')
                ->where('jenis_pembayaran', '<>', 'PO')
                ->whereNotIn('status', ['Batal', 'Belum Lunas'])
                ->whereNull('deleted_at')
                ->whereYear('tgl_penjualan', $tahun)
                ->selectRaw('MONTH(tgl_penjualan) as bln, SUM(total_pembayaran) as total')
                ->groupBy('bln')
                ->pluck('total', 'bln');

            $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            $maxMonth = ($tahun === $now->year) ? $now->month : 12;

            $categories = [];
            $originalArray = [];
            $withFormulaArray = [];
            $totalOriginal = 0;
            $totalBeban = 0;

            for ($m = 1; $m <= $maxMonth; $m++) {
                $categories[] = $monthNames[$m - 1];
                $transaksi = isset($salesMonthly[$m]) ? (int)$salesMonthly[$m] : 0;
                $totalOriginal += $transaksi;
                $originalArray[] = $transaksi;

                if ($tahun === $now->year && $m === $now->month) {
                    $daysInMonth = $now->day;
                } else {
                    $daysInMonth = Carbon::createFromDate($tahun, $m, 1)->daysInMonth;
                }

                $beban = $daysInMonth * -500000;
                $totalBeban += $beban;
                $withFormulaArray[] = $transaksi + $beban;
            }

            $totalWithFormula = $totalOriginal + $totalBeban;

            $chartData = [
                'type' => 'year',
                'categories' => $categories,
                'series' => [
                    [
                        'name' => 'Pendapatan Bersih',
                        'data' => $withFormulaArray,
                        'color' => '#6366F1'
                    ],
                    [
                        'name' => 'Pendapatan Asli',
                        'data' => $originalArray,
                        'color' => '#2DD4BF'
                    ]
                ]
            ];

            $incomeTextHtml = '
                <div class="d-flex flex-column gap-1.5">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="text-muted fs-12">Total Pendapatan (' . $tahun . ')</span>
                        <span class="fw-bold text-light fs-13 tabular-nums">Rp ' . number_format($totalOriginal, 0, ',', '.') . '</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="text-muted fs-12">Total Beban (' . $tahun . ')</span>
                        <span class="fw-bold text-light fs-13 tabular-nums">Rp ' . number_format(abs($totalBeban), 0, ',', '.') . '</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pt-1" style="border-top: 1px solid rgba(255,255,255,0.06);">
                        <span class="fs-12" style="color: #818CF8;">Pendapatan Bersih (' . $tahun . ')</span>
                        <span class="fw-bold fs-13 tabular-nums" style="color: #818CF8;">Rp ' . number_format($totalWithFormula, 0, ',', '.') . '</span>
                    </div>
                </div>';
        }

        // Query data Structure (Donut Chart)
        $structureQuery = DB::table('penjualan')
            ->whereNull('deleted_at');

        if ($viewType === 'year') {
            $structureQuery->whereYear('tgl_penjualan', $tahun);
        } elseif ($viewType === 'day') {
            $structureQuery->whereDate('tgl_penjualan', $startDate);
        } else {
            $structureQuery->whereBetween(DB::raw('DATE(tgl_penjualan)'), [$startDate, $endDate]);
        }

        $invoices = $structureQuery->get(['status', 'dp', 'total_pembayaran']);
        $bayar = 0;
        $belumBayar = 0;
        $batal = 0;

        foreach ($invoices as $inv) {
            if ($inv->status === 'Belum Lunas') {
                $bayar += $inv->dp;
                $belumBayar += ($inv->total_pembayaran - $inv->dp);
            } elseif ($inv->status === 'Lunas') {
                $bayar += $inv->total_pembayaran;
            } else {
                $batal += $inv->total_pembayaran;
            }
        }

        $totalAll = $bayar + $belumBayar + $batal;
        $persenBayar = $totalAll > 0 ? round(($bayar / $totalAll) * 100, 1) : 0;
        $persenBelumBayar = $totalAll > 0 ? round(($belumBayar / $totalAll) * 100, 1) : 0;
        $persenBatal = $totalAll > 0 ? round(($batal / $totalAll) * 100, 1) : 0;

        return response()->json([
            'status' => 'success',
            'period_label' => $periodLabel,
            'view_type' => $viewType,
            'chart_data' => $chartData,
            'income_html' => $incomeTextHtml,
            'structure' => [
                'terbayar' => $bayar,
                'terbayar_formatted' => 'Rp ' . number_format($bayar, 0, ',', '.'),
                'belum_terbayar' => $belumBayar,
                'belum_terbayar_formatted' => 'Rp ' . number_format($belumBayar, 0, ',', '.'),
                'batal' => $batal,
                'batal_formatted' => 'Rp ' . number_format($batal, 0, ',', '.'),
                'persen_terbayar' => $persenBayar,
                'persen_belum_terbayar' => $persenBelumBayar,
                'persen_batal' => $persenBatal,
                'series' => [$bayar, $belumBayar, $batal]
            ]
        ]);
    }
}