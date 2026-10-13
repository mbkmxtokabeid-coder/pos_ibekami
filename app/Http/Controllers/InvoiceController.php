<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Material;
use Carbon\Carbon;
// use DateTimeZone;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
// use App\Models\KategoriBarang;
// use App\Models\Perusahaan;
use App\Models\Order;
use App\Models\Penjualan;
use App\Models\InvoiceUpdateLog;
use App\Models\PenjualanBarang;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class InvoiceController extends Controller
{
    public function loadListInvoice()
    {
        Carbon::setLocale('id');
        
         DB::table('penjualan')
        ->where('approval', 'Unlock')
        ->whereNotNull('approved_at')
        ->where('approved_at', '<', now()->subHours(6))
        ->update([
            'approval' => 'Lock', // status lock
            'approved_at' => null
        ]);
        
        $yearNow = Carbon::now()->year;
        $monthNow = Carbon::now()->month;

        // =========================================================================
        // 1. KONSOLIDASI CARD STATUS PEMBAYARAN (semua jenis transaksi)
        // =========================================================================
        $stats = DB::table('penjualan')
            ->whereNull('deleted_at')
            ->selectRaw("
                COUNT(CASE WHEN YEAR(tgl_penjualan) = ? THEN 1 END) as jlh_invoice,
                COALESCE(SUM(CASE WHEN YEAR(tgl_penjualan) = ? THEN total_pembayaran ELSE 0 END), 0) as total_per_tahun,
                COALESCE(SUM(CASE WHEN YEAR(tgl_penjualan) = ? AND status = 'Lunas' THEN total_pembayaran ELSE 0 END), 0) as total_lunas,
                COUNT(CASE WHEN YEAR(tgl_penjualan) = ? AND status = 'Lunas' THEN 1 END) as lunas,
                COALESCE(SUM(CASE WHEN YEAR(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN dp ELSE 0 END), 0) as tot_dp_tahun,
                COALESCE(SUM(CASE WHEN YEAR(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN sisa_pembayaran ELSE 0 END), 0) as jumlah_bb_per_tahun,
                COUNT(CASE WHEN YEAR(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN 1 END) as belum_lunas,
                COALESCE(SUM(CASE WHEN YEAR(tgl_penjualan) = ? AND MONTH(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN sisa_pembayaran ELSE 0 END), 0) as jumlah_bb_per_bulan,
                COUNT(CASE WHEN YEAR(tgl_penjualan) = ? AND MONTH(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN 1 END) as belum_lunas_month,
                COALESCE(SUM(CASE WHEN jenis_pembayaran = 'PO' AND status <> 'Batal' THEN total_pembayaran ELSE 0 END), 0) as jumlah_po,
                COUNT(CASE WHEN jenis_pembayaran = 'PO' AND status <> 'Batal' THEN 1 END) as count_all_inv_po,
                COALESCE(SUM(CASE WHEN jenis_pembayaran = 'PO' AND YEAR(tgl_penjualan) = ? AND status = 'Lunas' THEN total_pembayaran ELSE 0 END), 0) as jumlah_po_lunas,
                COUNT(CASE WHEN jenis_pembayaran = 'PO' AND YEAR(tgl_penjualan) = ? AND status = 'Lunas' THEN 1 END) as count_all_settled_po,
                COALESCE(SUM(CASE WHEN jenis_pembayaran = 'PO' AND YEAR(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN total_pembayaran ELSE 0 END), 0) as jumlah_po_blm_lunas,
                COUNT(CASE WHEN jenis_pembayaran = 'PO' AND YEAR(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN 1 END) as count_all_outstanding_po,
                COALESCE(SUM(CASE WHEN jenis_pembayaran = 'PO' AND YEAR(tgl_penjualan) = ? AND MONTH(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN sisa_pembayaran ELSE 0 END), 0) as jumlah_bb_per_bulan_po,
                COUNT(CASE WHEN jenis_pembayaran = 'PO' AND YEAR(tgl_penjualan) = ? AND MONTH(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN 1 END) as blm_lunas_po,
                COUNT(CASE WHEN status = 'Batal' AND YEAR(tgl_penjualan) = ? THEN 1 END) as batal,
                COALESCE(SUM(CASE WHEN status = 'Batal' AND YEAR(tgl_penjualan) = ? THEN total_pembayaran ELSE 0 END), 0) as jumlah_batal,
                COALESCE(SUM(CASE WHEN YEAR(tgl_penjualan) = ? AND MONTH(tgl_penjualan) = ? THEN total_pembayaran ELSE 0 END), 0) as total_per_bulan,
                COALESCE(SUM(total_pembayaran), 0) as jumlah_invoice
            ", [
                $yearNow, $yearNow, $yearNow, $yearNow, $yearNow, $yearNow, $yearNow,
                $yearNow, $monthNow, $yearNow, $monthNow,
                $yearNow, $yearNow, $yearNow, $yearNow, $yearNow, $monthNow, $yearNow, $monthNow,
                $yearNow, $yearNow, $yearNow, $monthNow
            ])
            ->first();

        $jlhInvoice = $stats->jlh_invoice ?? 0;
        $totalPerTahun = $stats->total_per_tahun ?? 0;
        $jumlahPerTahun = number_format($totalPerTahun, 0, ',', '.');
        $lunas = $stats->lunas ?? 0;
        $totalLunasThn = number_format(($stats->total_lunas ?? 0) + ($stats->tot_dp_tahun ?? 0), 0, ',', '.');
        $belumLunas = $stats->belum_lunas ?? 0;
        $jumlahBBPerTahun = number_format($stats->jumlah_bb_per_tahun ?? 0, 0, ',', '.');
        $belumLunasMonth = $stats->belum_lunas_month ?? 0;
        $jumlahBBPerBulan = number_format($stats->jumlah_bb_per_bulan ?? 0, 0, ',', '.');

        $jumlahPO = number_format($stats->jumlah_po ?? 0, 0, ',', '.');
        $countAllInvPO = $stats->count_all_inv_po ?? 0;
        $jumlahPOLunas = number_format($stats->jumlah_po_lunas ?? 0, 0, ',', '.');
        $countAllSettledPO = $stats->count_all_settled_po ?? 0;
        $jumlahPOBlmLunas = number_format($stats->jumlah_po_blm_lunas ?? 0, 0, ',', '.');
        $countAllOutstandingPO = $stats->count_all_outstanding_po ?? 0;
        $jumlahBBPerBulanPO = number_format($stats->jumlah_bb_per_bulan_po ?? 0, 0, ',', '.');
        $blmLunasPO = $stats->blm_lunas_po ?? 0;

        $batal = $stats->batal ?? 0;
        $jumlahBatal = number_format($stats->jumlah_batal ?? 0, 0, ',', '.');
        $totalPerBulan = $stats->total_per_bulan ?? 0;
        $jumlahPerBulan = number_format($totalPerBulan, 0, ',', '.');
        $jumlahInvoice = number_format($stats->jumlah_invoice ?? 0, 0, ',', '.');

        // Card Hapus (Invoice yang Dihapus / Soft Deleted)
        $statsHapus = DB::table('penjualan')
            ->whereNotNull('deleted_at')
            ->whereYear('tgl_penjualan', $yearNow)
            ->selectRaw('COUNT(*) as count_hapus, COALESCE(SUM(total_pembayaran), 0) as total_hapus')
            ->first();
        $hapusCount = $statsHapus->count_hapus ?? 0;
        $jumlahHapus = number_format($statsHapus->total_hapus ?? 0, 0, ',', '.');

        // =========================================================================
        // 4. DATA INVOICE (Eager load user & penjualanBarang)
        // =========================================================================
        $jenisInvoiceList = Invoice::orderBy('nama_invoice')->get();
        $invoiceMap = $jenisInvoiceList->keyBy('id');
        $materialsMap = Material::all()->keyBy('id');

        $penjualan = Penjualan::with(['user', 'penjualanBarang'])->orderByDesc('tgl_penjualan')->get();

        foreach ($penjualan as $inv) {
            $invType = $invoiceMap->get($inv->invoice);
            $inv->jenis_invoice_nama = $invType ? $invType->nama_invoice : '-';
            $inv->jenis_invoice_kode = $invType ? $invType->kode_invoice : '-';
            $inv->formatted_tgl_penjualan = Carbon::parse($inv->tgl_penjualan)->format('d M Y');
            $inv->formatted_tgl_update = Carbon::parse($inv->updated_at)->addHour(7)->format('d M Y H:i');
            $inv->formatted_total_pembayaran = number_format($inv->total_pembayaran, 0, ',', '.');
            $inv->formatted_dp = number_format($inv->dp ?? 0, 0, ',', '.');
            if ($inv->dp == null) {
                $inv->dp = 0;
            }
        }

        // =========================================================================
        // 5. PERHITUNGAN PPN & PPH TAHUN INI
        // =========================================================================
        $dataPajak = DB::table('penjualan')
            ->whereNull('deleted_at')
            ->whereYear('tgl_penjualan', $yearNow)
            ->where('status', '!=', 'Batal')
            ->select('ppn', 'diskon', 'potongan', 'total_pembayaran', 'total_harga')
            ->get();

        $ppnTotal = 0;
        $ppnTotalCount = 0;
        $ppn01 = 0;
        $ppn01Count = 0;
        $ppn02 = 0;
        $ppn02Count = 0;
        $ppn03 = 0;
        $ppn03Count = 0;
        $ppn04 = 0;
        $ppn04Count = 0;
        $pphTotal = 0;
        $pphTotalCount = 0;

        foreach ($dataPajak as $inv) {
            $hasPpn = !empty($inv->ppn) && (float)$inv->ppn > 0;
            $hasDiskon = !empty($inv->diskon) && (float)$inv->diskon > 0;
            $hasPotongan = !empty($inv->potongan) && (float)$inv->potongan > 0;
            $nominalPpn = 0;

            if ($hasPpn) {
                $nominalPpn = ($inv->ppn / 100) * ($inv->total_harga ?? 0);
            } elseif (!$hasDiskon && !$hasPotongan && $inv->total_pembayaran > $inv->total_harga && $inv->total_harga > 0) {
                $nominalPpn = $inv->total_pembayaran - $inv->total_harga;
                $hasPpn = true;
            }

            if ($hasPpn && $nominalPpn > 0) {
                $ppnTotal += $nominalPpn;
                $ppnTotalCount++;

                $kode = $inv->kode_ppn ?? '01';
                if ($kode == '01') {
                    $ppn01 += $nominalPpn;
                    $ppn01Count++;
                } elseif ($kode == '02') {
                    $ppn02 += $nominalPpn;
                    $ppn02Count++;
                } elseif ($kode == '03') {
                    $ppn03 += $nominalPpn;
                    $ppn03Count++;
                } elseif ($kode == '04') {
                    $ppn04 += $nominalPpn;
                    $ppn04Count++;
                }
            }
        }

        $availableYears = DB::table('penjualan')
            ->whereNull('deleted_at')
            ->selectRaw('DISTINCT YEAR(tgl_penjualan) as year')
            ->orderByDesc('year')
            ->pluck('year')
            ->toArray();
        if (empty($availableYears)) {
            $availableYears = [$yearNow, $yearNow - 1];
        } else {
            if (!in_array($yearNow, $availableYears)) {
                array_unshift($availableYears, $yearNow);
            }
            rsort($availableYears);
        }

        return view('pages.invoices.daftar-invoice', compact(
            'penjualan', 'jlhInvoice', 'lunas', 'belumLunas', 'batal', 'totalLunasThn',
            'jumlahBatal', 'jumlahInvoice', 'jumlahBBPerTahun', 'jumlahBBPerBulan',
            'jumlahPerBulan', 'jumlahPerTahun', 'belumLunasMonth', 'jumlahPO', 'jumlahPOLunas',
            'jumlahPOBlmLunas', 'countAllInvPO', 'blmLunasPO', 'countAllOutstandingPO',
            'countAllSettledPO', 'jumlahBBPerBulanPO',
            'ppnTotal', 'ppnTotalCount', 'ppn01', 'ppn01Count', 'ppn02', 'ppn02Count',
            'ppn03', 'ppn03Count', 'ppn04', 'ppn04Count', 'pphTotal', 'pphTotalCount', 'availableYears',
            'jenisInvoiceList', 'materialsMap', 'hapusCount', 'jumlahHapus'
        ));
    }

    public function getCardsData(Request $request)
    {
        $timeframe = $request->query('timeframe', 'year');
        $mode = $request->query('mode');
        $date = $request->query('date');
        $month = $request->query('month');
        $year = $request->query('year');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        Carbon::setLocale('id');
        $now = Carbon::now(new \DateTimeZone('Asia/Jakarta'));
        $yearNow = $now->year;
        $monthNow = $now->month;

        $query = Penjualan::query();
        $card4Query = Penjualan::query();
        $queryHapus = Penjualan::onlyTrashed();

        $periodLabel = '';
        $card4MonthName = '';

        if ($timeframe === 'today') {
            $today = $now->toDateString();
            $query->whereDate('tgl_penjualan', $today);
            $queryHapus->whereDate('tgl_penjualan', $today);
            $periodLabel = 'HARI INI';
            
            $card4Query->whereYear('tgl_penjualan', $yearNow)->whereMonth('tgl_penjualan', $monthNow);
            $card4MonthName = strtoupper($now->translatedFormat('F Y'));
        } elseif ($timeframe === 'week') {
            $startOfWeek = $now->copy()->startOfWeek()->format('Y-m-d 00:00:00');
            $endOfWeek = $now->copy()->endOfWeek()->format('Y-m-d 23:59:59');
            $query->whereBetween('tgl_penjualan', [$startOfWeek, $endOfWeek]);
            $queryHapus->whereBetween('tgl_penjualan', [$startOfWeek, $endOfWeek]);
            $periodLabel = 'MINGGU INI';

            $card4Query->whereYear('tgl_penjualan', $yearNow)->whereMonth('tgl_penjualan', $monthNow);
            $card4MonthName = strtoupper($now->translatedFormat('F Y'));
        } elseif ($timeframe === 'month') {
            $query->whereYear('tgl_penjualan', $yearNow)->whereMonth('tgl_penjualan', $monthNow);
            $queryHapus->whereYear('tgl_penjualan', $yearNow)->whereMonth('tgl_penjualan', $monthNow);
            $periodLabel = 'BULAN ' . strtoupper($now->translatedFormat('F Y'));

            $card4Query->whereYear('tgl_penjualan', $yearNow)->whereMonth('tgl_penjualan', $monthNow);
            $card4MonthName = strtoupper($now->translatedFormat('F Y'));
        } elseif ($timeframe === 'year') {
            $query->whereYear('tgl_penjualan', $yearNow);
            $queryHapus->whereYear('tgl_penjualan', $yearNow);
            $periodLabel = 'TAHUN ' . $yearNow;

            $card4Query->whereYear('tgl_penjualan', $yearNow)->whereMonth('tgl_penjualan', $monthNow);
            $card4MonthName = strtoupper($now->translatedFormat('F'));
        } elseif ($timeframe === 'last_year') {
            $lastYear = $yearNow - 1;
            $query->whereYear('tgl_penjualan', $lastYear);
            $queryHapus->whereYear('tgl_penjualan', $lastYear);
            $periodLabel = 'TAHUN ' . $lastYear;

            $card4Query->whereYear('tgl_penjualan', $lastYear)->whereMonth('tgl_penjualan', 12);
            $card4MonthName = 'DESEMBER ' . $lastYear;
        } elseif ($timeframe === 'custom') {
            if ($mode === 'date' && $date) {
                $parsedDate = Carbon::parse($date);
                $query->whereDate('tgl_penjualan', $parsedDate->toDateString());
                $queryHapus->whereDate('tgl_penjualan', $parsedDate->toDateString());
                $periodLabel = 'TANGGAL ' . $parsedDate->format('d/m/Y');

                $card4Query->whereYear('tgl_penjualan', $parsedDate->year)->whereMonth('tgl_penjualan', $parsedDate->month);
                $card4MonthName = strtoupper($parsedDate->translatedFormat('F Y'));
            } elseif ($mode === 'month' && $month && $year) {
                $query->whereYear('tgl_penjualan', $year)->whereMonth('tgl_penjualan', $month);
                $queryHapus->whereYear('tgl_penjualan', $year)->whereMonth('tgl_penjualan', $month);
                $parsedDate = Carbon::createFromDate($year, $month, 1);
                $periodLabel = 'BULAN ' . strtoupper($parsedDate->translatedFormat('F Y'));

                $card4Query->whereYear('tgl_penjualan', $year)->whereMonth('tgl_penjualan', $month);
                $card4MonthName = strtoupper($parsedDate->translatedFormat('F Y'));
            } elseif ($mode === 'year' && $year) {
                $query->whereYear('tgl_penjualan', $year);
                $queryHapus->whereYear('tgl_penjualan', $year);
                $periodLabel = 'TAHUN ' . $year;

                $card4Month = ($year == $yearNow) ? $monthNow : 12;
                $card4Query->whereYear('tgl_penjualan', $year)->whereMonth('tgl_penjualan', $card4Month);
                $parsedDate = Carbon::createFromDate($year, $card4Month, 1);
                $card4MonthName = strtoupper($parsedDate->translatedFormat('F') . ($year != $yearNow ? ' ' . $year : ''));
            } elseif ($mode === 'range' && $startDate && $endDate) {
                $start = Carbon::parse($startDate)->startOfDay();
                $end = Carbon::parse($endDate)->endOfDay();
                $query->whereBetween('tgl_penjualan', [$start->format('Y-m-d 00:00:00'), $end->format('Y-m-d 23:59:59')]);
                $queryHapus->whereBetween('tgl_penjualan', [$start->format('Y-m-d 00:00:00'), $end->format('Y-m-d 23:59:59')]);
                $periodLabel = $start->format('d/m/Y') . ' - ' . $end->format('d/m/Y');

                $card4Query->whereYear('tgl_penjualan', $end->year)->whereMonth('tgl_penjualan', $end->month);
                $card4MonthName = strtoupper($end->translatedFormat('F Y'));
            }
        }

        // =========================================================================
        // KARTU STATUS PEMBAYARAN SEMUA INVOICE
        // =========================================================================
        // Semua transaksi mengikuti status pembayaran yang sama, termasuk histori PO.
        $queryNonPo = clone $query;
        $card4QueryNonPo = clone $card4Query;

        // Kartu 1: Total invoice
        $totalNominalNonPo = (clone $queryNonPo)->sum('total_pembayaran');
        $jlhInvoiceNonPo = (clone $queryNonPo)->count();
        $valCard1 = number_format($totalNominalNonPo, 0, ',', '.');

        // Kartu 2: Invoice terbayar
        $dataLunasNonPo = (clone $queryNonPo)->where('status', 'Lunas');
        $dataBlmLunasNonPo = (clone $queryNonPo)->where('status', 'Belum Lunas');
        $totLunasNonPo = (clone $dataLunasNonPo)->sum('total_pembayaran');
        $totDpNonPo = (clone $dataBlmLunasNonPo)->sum('dp');
        $lunasNonPo = (clone $dataLunasNonPo)->count();
        $totalLunasThnVal = $totLunasNonPo + $totDpNonPo;
        $valCard2 = number_format($totalLunasThnVal, 0, ',', '.');

        // Non-PO Card 3: Belum Terbayar Non-PO Periode
        $belumLunasNonPo = (clone $dataBlmLunasNonPo)->count();
        $totalBBNonPo = (clone $dataBlmLunasNonPo)->sum('sisa_pembayaran');
        $valCard3 = number_format($totalBBNonPo, 0, ',', '.');

        // Non-PO Card 4: Belum Terbayar Non-PO Bulan
        $dataBlmLunasMonthNonPo = (clone $card4QueryNonPo)->where('status', 'Belum Lunas');
        $belumLunasMonthNonPo = (clone $dataBlmLunasMonthNonPo)->count();
        $totalBBMonthNonPo = (clone $dataBlmLunasMonthNonPo)->sum('sisa_pembayaran');
        $valCard4 = number_format($totalBBMonthNonPo, 0, ',', '.');

        // =========================================================================
        // CARD PO (Purchase Order - jenis_pembayaran == 'PO')
        // =========================================================================
        $queryPo = (clone $query)->where('jenis_pembayaran', 'PO');
        $card4QueryPo = (clone $card4Query)->where('jenis_pembayaran', 'PO');

        // PO Card 1: Jumlah Seluruh PO
        if ($timeframe === 'year' || empty($timeframe)) {
            $totalNominalPo = Penjualan::where('jenis_pembayaran', 'PO')->where('status', '<>', 'Batal')->sum('total_pembayaran');
            $countInvPo = Penjualan::where('jenis_pembayaran', 'PO')->where('status', '<>', 'Batal')->count();
        } else {
            $totalNominalPo = (clone $queryPo)->where('status', '<>', 'Batal')->sum('total_pembayaran');
            $countInvPo = (clone $queryPo)->where('status', '<>', 'Batal')->count();
        }
        $valPo1 = number_format($totalNominalPo, 0, ',', '.');

        // PO Card 2: PO Lunas Periode
        $dataLunasPo = (clone $queryPo)->where('status', 'Lunas');
        $valPo2 = number_format((clone $dataLunasPo)->sum('total_pembayaran'), 0, ',', '.');
        $countPo2 = (clone $dataLunasPo)->count();

        // PO Card 3: PO Belum Lunas Periode
        $dataBlmLunasPo = (clone $queryPo)->where('status', 'Belum Lunas');
        $valPo3 = number_format((clone $dataBlmLunasPo)->sum('total_pembayaran'), 0, ',', '.');
        $countPo3 = (clone $dataBlmLunasPo)->count();

        // PO Card 4: PO Belum Lunas Bulan
        $dataBlmLunasMonthPo = (clone $card4QueryPo)->where('status', 'Belum Lunas');
        $valPo4 = number_format((clone $dataBlmLunasMonthPo)->sum('sisa_pembayaran'), 0, ',', '.');
        $countPo4 = (clone $dataBlmLunasMonthPo)->count();

        // Card 5: Batal
        $dataBatal = (clone $query)->where('status', 'Batal');
        $batal = (clone $dataBatal)->count();
        $totalBatal = (clone $dataBatal)->sum('total_pembayaran');
        $valCard5 = number_format($totalBatal, 0, ',', '.');

        // Card Hapus: Invoice Dihapus (Soft Deleted)
        $hapusCount = (clone $queryHapus)->count();
        $totalHapus = (clone $queryHapus)->sum('total_pembayaran');
        $valCardHapus = number_format($totalHapus, 0, ',', '.');

        // Pajak PPN & PPh
        $dataPajak = (clone $query)->where('status', '!=', 'Batal')
            ->select('ppn', 'diskon', 'potongan', 'total_pembayaran', 'total_harga')
            ->get();
        $ppnTotal = 0;
        $ppnTotalCount = 0;
        $ppn01 = 0;
        $ppn01Count = 0;
        $ppn02 = 0;
        $ppn02Count = 0;
        $ppn03 = 0;
        $ppn03Count = 0;
        $ppn04 = 0;
        $ppn04Count = 0;
        $pphTotal = 0;
        $pphTotalCount = 0;

        foreach ($dataPajak as $inv) {
            $hasPpn = !empty($inv->ppn) && (float)$inv->ppn > 0;
            $hasDiskon = !empty($inv->diskon) && (float)$inv->diskon > 0;
            $hasPotongan = !empty($inv->potongan) && (float)$inv->potongan > 0;
            $nominalPpn = 0;

            if ($hasPpn) {
                $nominalPpn = ($inv->ppn / 100) * ($inv->total_harga ?? 0);
            } elseif (!$hasDiskon && !$hasPotongan && $inv->total_pembayaran > $inv->total_harga && $inv->total_harga > 0) {
                $nominalPpn = $inv->total_pembayaran - $inv->total_harga;
                $hasPpn = true;
            }

            if ($hasPpn && $nominalPpn > 0) {
                $ppnTotal += $nominalPpn;
                $ppnTotalCount++;

                $kode = $inv->kode_ppn ?? '01';
                if ($kode == '01') {
                    $ppn01 += $nominalPpn;
                    $ppn01Count++;
                } elseif ($kode == '02') {
                    $ppn02 += $nominalPpn;
                    $ppn02Count++;
                } elseif ($kode == '03') {
                    $ppn03 += $nominalPpn;
                    $ppn03Count++;
                } elseif ($kode == '04') {
                    $ppn04 += $nominalPpn;
                    $ppn04Count++;
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'periodLabel' => $periodLabel,
            'card4MonthName' => $card4MonthName,
            'card1' => ['nominal' => $valCard1, 'count' => $jlhInvoiceNonPo],
            'card2' => ['nominal' => $valCard2, 'count' => $lunasNonPo],
            'card3' => ['nominal' => $valCard3, 'count' => $belumLunasNonPo],
            'card4' => ['nominal' => $valCard4, 'count' => $belumLunasMonthNonPo],
            'cardPo1' => ['nominal' => $valPo1, 'count' => $countInvPo],
            'cardPo2' => ['nominal' => $valPo2, 'count' => $countPo2],
            'cardPo3' => ['nominal' => $valPo3, 'count' => $countPo3],
            'cardPo4' => ['nominal' => $valPo4, 'count' => $countPo4],
            'card5' => ['nominal' => $valCard5, 'count' => $batal],
            'cardHapus' => ['nominal' => $valCardHapus, 'count' => $hapusCount],
            'card6' => ['nominal' => number_format($ppnTotal, 0, ',', '.'), 'count' => $ppnTotalCount],
            'card7' => ['nominal' => number_format($pphTotal, 0, ',', '.'), 'count' => $pphTotalCount],
            'card8' => ['nominal' => number_format($ppn01, 0, ',', '.'), 'count' => $ppn01Count],
            'card9' => ['nominal' => number_format($ppn02, 0, ',', '.'), 'count' => $ppn02Count],
            'card10' => ['nominal' => number_format($ppn03, 0, ',', '.'), 'count' => $ppn03Count],
            'card11' => ['nominal' => number_format($ppn04, 0, ',', '.'), 'count' => $ppn04Count],
        ]);
    }

    // Selected Invoice Code
    public function getInvoiceByOption($selectedOption)
    {
        // Retrieve the invoice based on the selected option
        $invoice = Invoice::where('nama_invoice', $selectedOption)->first();

        // Return the invoice or appropriate response
        if ($invoice) {
            return response()->json([
                'kode_invoice' => $invoice->kode_invoice,
                'tipe_harga' => $invoice->tipe_harga ?? 'dengan_harga'
            ]);
        } else {
            return response()->json(['error' => 'Invoice not found'], 404);
        }
    }

    public function editInvoice($id)
    {
        $inv = Penjualan::find($id);
        $invoice = Invoice::find($inv->invoice);
        $admin_now = User::find($inv->admin);
        $admin = User::where('role', 'Admin')->get();
        $order = Order::all();
        $penjualan_barang = PenjualanBarang::where('penjualan_id', $id)->get();
        $jenisBarang = Barang::with('kategori_item')->where('is_active', 1)->get();
        $materials = Material::all();

        $jam = substr($inv->tgl_penjualan, 11, 5);
        $nomor_unik = preg_replace("/[^0-9]/", '', $inv->nomor_invoice);
        $kode = preg_replace("/[^A-Z]/", '', $inv->nomor_invoice);
        $perusahaan = $inv->perusahaan;
        $nama_adm = $admin_now->nama;
        $sales = $inv->nama_sales;
        if (!$perusahaan) {
            $perusahaan  = '-';
        }
        if (!$sales) {
            $sales = '-';
        }

        $barangIds = $penjualan_barang->pluck('barang_id')->unique();
        $barangMap = Barang::whereIn('id', $barangIds)->get()->keyBy('id');
        $barang = [];
        foreach ($penjualan_barang as $item) {
            $b = $barangMap->get($item->barang_id);
            $barang[] = $b ? collect([$b]) : collect([]);
        }

        return view('pages.invoices.edit-invoices', compact('inv', 'jam', 'nomor_unik', 'perusahaan', 'admin', 'order', 'sales', 'materials', 'jenisBarang', 'nama_adm', 'barang', 'invoice', 'kode', 'penjualan_barang'));
    }

    public function updateInvoice(Request $request, $id)
    {
        $penjualan = Penjualan::find($id);
        // $tot_barang = $request->input('count');
        $nmr_inv = $request->kode . $request->kodeUnik;

        $status = ($request->jns_pem == 'Cash Lunas' || $request->jns_pem == 'Transfer Lunas') ? 'Lunas' : 'Belum Lunas';
        $tanggalPenjualan = $request->tgl_jual . ":" . $request->jam;
        $item = (!empty($request->barang_id)) ? count($request->barang_id) : 0;

        $cleanNominal = function($val) {
            if ($val === null || $val === '') return 0;
            $digits = preg_replace('/[^0-9]/', '', (string)$val);
            return !empty($digits) ? intval($digits) : 0;
        };

        $tot_harga = $cleanNominal($request->tot_harga);
        $tot_pem = $cleanNominal($request->tot_pem);
        $dp = $cleanNominal($request->dp);
        
        if ($request->jns_pem == 'Cash Lunas' || $request->jns_pem == 'Transfer Lunas') {
            $sisa_pemb = 0;
        } else {
            $sisa_pemb = $cleanNominal($request->sisa_pem);
        }
       
        if(!$request->norek){
             $norek = 'BNI';
        } else {
            $norek = $request->norek;
        }
        
         // 1. KEMBALIKAN (RESTORE) STOK BARANG & MATERIAL SEBELUMNYA
         $stokSebelumnya = [];
        foreach ($penjualan->penjualanBarang as $items) {
            $stokSebelumnya[] = [
                'barang_id' => $items->barang_id,
                'stok' => $items->qty,
                'material_id' => $items->material_id, // Simpan ID Material sebelumnya
                'material_qty' => $items->material_qty // Simpan Qty Material sebelumnya
            ];
        }
        
        foreach ($stokSebelumnya as $barangSebelumnya) {
            // Restore Stok Barang
            $barang = Barang::find($barangSebelumnya['barang_id']);
            if($barang) {
                $barang->stok += $barangSebelumnya['stok'];
                $barang->save();
            }

            // Restore Stok Material (Support Multi-Material / JSON)
            if (!empty($barangSebelumnya['material_id']) && !empty($barangSebelumnya['material_qty'])) {
                $matIds = json_decode($barangSebelumnya['material_id'], true);
                $matQtys = json_decode($barangSebelumnya['material_qty'], true);

                if (is_array($matIds)) {
                    foreach ($matIds as $index => $matId) {
                        $materialObj = Material::find($matId);
                        if ($materialObj) {
                            $materialObj->stok += (float) ($matQtys[$index] ?? 0);
                            $materialObj->save();
                        }
                    }
                } else {
                    // Fallback jika datanya masih string ID lama (sebelum multi-material)
                    $materialObj = Material::find($barangSebelumnya['material_id']);
                    if ($materialObj) {
                        $materialObj->stok += (float) $barangSebelumnya['material_qty'];
                        $materialObj->save();
                    }
                }
            }
        }
       
        $penjualan->invoice = $request->inv;
        $penjualan->nomor_invoice = $nmr_inv;
        $penjualan->tgl_penjualan = $tanggalPenjualan;
        $penjualan->customer = $request->pelanggan;
        $penjualan->perusahaan = $request->perusahaan;
        $penjualan->no_telepon = $request->tlp;
        $penjualan->admin = $request->adm;
        $penjualan->order_by = $request->order;
        $penjualan->nama_sales = $request->sales;
        $penjualan->tgl_selesai = $request->tgl_selesai;
        $penjualan->jumlah_item = $item;
        $penjualan->dp = $dp;
        $penjualan->jenis_pembayaran = $request->jns_pem;
        $penjualan->no_rek = $norek;
        $penjualan->total_harga = $tot_harga;
        $penjualan->status = $status;
        
        $jenisPotongan = $request->select_potongan ?? $request->input('select-potongan');
        $rawPotongan = $request->biaya_lain ?? ($request->ptg ?? $request->input('biaya_lain'));
        $nilai_potongan = intval(preg_replace('/[^0-9]/', '', $rawPotongan ?? '0'));

        if ($jenisPotongan == 'PPN') {
            $penjualan->ppn = $nilai_potongan;
            $penjualan->diskon = null;
            $penjualan->potongan = null;
        } else if ($jenisPotongan == 'Diskon') {
            $penjualan->ppn = null;
            $penjualan->diskon = $nilai_potongan;
            $penjualan->potongan = null;
        } else if ($jenisPotongan == 'Potongan') {
            $penjualan->ppn = null;
            $penjualan->diskon = null;
            $penjualan->potongan = $nilai_potongan;
        } else {
            $penjualan->ppn = null;
            $penjualan->diskon = null;
            $penjualan->potongan = null;
        }

        // Server-side recalculation guard
        if ($jenisPotongan == 'PPN' && $nilai_potongan > 0) {
            $expectedPem = $tot_harga + round($tot_harga * ($nilai_potongan / 100));
            if ($tot_pem <= 0 || abs($tot_pem - $expectedPem) > 5) {
                $tot_pem = $expectedPem;
            }
        } elseif ($jenisPotongan == 'Diskon' && $nilai_potongan > 0) {
            $expectedPem = $tot_harga - round($tot_harga * ($nilai_potongan / 100));
            if ($tot_pem <= 0 || abs($tot_pem - $expectedPem) > 5) {
                $tot_pem = max(0, $expectedPem);
            }
        } elseif ($jenisPotongan == 'Potongan' && $nilai_potongan > 0) {
            $expectedPem = $tot_harga - $nilai_potongan;
            if ($tot_pem <= 0 || abs($tot_pem - $expectedPem) > 5) {
                $tot_pem = max(0, $expectedPem);
            }
        } elseif ($tot_pem <= 0) {
            $tot_pem = $tot_harga;
        }

        if ($status == 'Lunas') {
            $sisa_pemb = 0;
        } else {
            $sisa_pemb = max(0, $tot_pem - $dp);
        }

        $penjualan->total_pembayaran = $tot_pem;
        $penjualan->sisa_pembayaran = $sisa_pemb;
        $penjualan->save();
        
        InvoiceUpdateLog::create([
        'invoice_id' => $penjualan->id,
        
        ]);

        PenjualanBarang::where('penjualan_id', $id)->delete();

        // 2. SIMPAN ITEM BARU DAN POTONG STOK (BARANG & MATERIAL)
        foreach ($request->barang_id as $key => $value) {
            $hrg = $request->hrg[$key];
            if (empty($hrg)) {
                $hrg = 0;
            }
            if (empty($value) || empty($request->deskripsi_item[$key]) || empty($request->qty[$key]) || empty($request->satuan[$key])) {
                Alert::error('Error', 'Harap lengkapi semua kolom item.');
                return redirect()->back();
               
            }

            $barangObj = Barang::find($value);
            if ($barangObj && $barangObj->is_material_required == 1) {
                $matIds = [];
                $matQtys = [];
                $matPanjangs = [];
                $matLebars = [];
            } else {
                // Bersihkan array material dari elemen kosong untuk Mencegah Array to String Conversion
                $matIds = isset($request->material_id[$key]) && is_array($request->material_id[$key]) ? array_filter($request->material_id[$key]) : [];
                $matQtys = isset($request->material_qty[$key]) && is_array($request->material_qty[$key]) ? array_filter($request->material_qty[$key], 'strlen') : [];
                $matPanjangs = isset($request->material_panjang[$key]) && is_array($request->material_panjang[$key]) ? array_filter($request->material_panjang[$key], 'strlen') : [];
                $matLebars = isset($request->material_lebar[$key]) && is_array($request->material_lebar[$key]) ? array_filter($request->material_lebar[$key], 'strlen') : [];
            }

            $item = new PenjualanBarang();
            $item->barang_id = $value;
            $item->penjualan_id = $penjualan->id;
            $item->deskripsi_item = $request->deskripsi_item[$key];
            $item->qty = $request->qty[$key];
            $item->satuan = $request->satuan[$key];
            $item->hargaBarang = $cleanNominal($request->hrg[$key] ?? 0);
            $item->jumlah_harga = $cleanNominal($request->jlh_hrg[$key] ?? 0);
            
            // Simpan Material, Qty, P x L sebagai JSON String
            $item->material_id = !empty($matIds) ? json_encode(array_values($matIds)) : null;
            $item->material_qty = !empty($matQtys) ? json_encode(array_values($matQtys)) : null;
            $item->material_panjang = !empty($matPanjangs) ? json_encode(array_values($matPanjangs)) : null;
            $item->material_lebar = !empty($matLebars) ? json_encode(array_values($matLebars)) : null;

            $item->save();

            // Kurangi Stok Barang
            $barang = Barang::find($item->barang_id);
            if ($barang) {
                $barang->stok -= $item->qty;
                $barang->save();
            }

            // Kurangi Stok Material
            if (!empty($matIds)) {
                foreach (array_values($matIds) as $mIndex => $mId) {
                    $material = Material::find($mId);
                    $mQty = array_values($matQtys)[$mIndex] ?? 0;
                    if ($material) {
                        $material->stok -= $mQty;
                        $material->save();
                    }
                }
            }
        }
        Alert::success('Data Invoice Berhasil diUpdate');
        return redirect('list-invoice');
    }


    public function cetakInvoice(Request $request, $id)
    {
        $type = strtolower($request->query('type', 'asli'));
        if (!in_array($type, ['asli', 'copy'])) {
            $type = 'asli';
        }
        $penjualan = Penjualan::where('id', $id)->first();
        $invoice = Invoice::where('id', $penjualan->invoice)->first();
        $penjualan_barang = PenjualanBarang::where('penjualan_id', $id)->get();
        $admin_now = User::where('id', $penjualan->admin)->first();
        // $jenisBarang = Barang::all();
        $barang = [];
        $hargaMod = [];
        $jumlahHarga = [];
        $totHargaMod = number_format($penjualan->total_harga, 0, ',', '.');
        $sisaBayarMod = $penjualan->status === 'Lunas' ? '0' : number_format($penjualan->sisa_pembayaran, 0, ',', '.');
        $admin = $admin_now->nama;
        $tanggal =  $penjualan->tgl_penjualan;
        Carbon::setLocale('id');


        // Ubah format tanggal menjadi tanggal string
        $tanggalString = Carbon::parse($tanggal)->toDateString();

        // Format tanggal yang diinginkan dengan bulan dalam bahasa Indonesia
        $formatTanggal = Carbon::parse($tanggalString)->isoFormat('DD MMMM YYYY');


        $norek = $penjualan->norek_text;

        if ($penjualan->dp == null) {
            $dp = 0;
        } else {
            $dp = number_format($penjualan->dp, 0, ',', '.');
        }

        if ($penjualan->diskon != null || $penjualan->potongan != null || $penjualan->ppn != null) {
            if ($penjualan->diskon) {
                // $biayaLain = number_format($penjualan->diskon ? $penjualan->diskon : $penjualan->ppn, 0, ',', '.') . '%';
                $biayaLain = number_format($penjualan->diskon, 0, ',', '.') . '%';
            }else if( $penjualan->ppn){
                $biayaLain = number_format($penjualan->ppn / 100 * $penjualan->total_harga);
                
            }else {
                $biayaLain = 'Rp.' . number_format($penjualan->potongan, 0, ',', '.');
            }
        } else {
            $biayaLain = 0;
        }
        
        $toko = "Ibekami.id";
        

        foreach ($penjualan_barang as $item) {
            $barangItem = Barang::where('id', $item->barang_id)->get();
            $barang[] = $barangItem;
            $hargaMod[] = number_format($item->hargaBarang, 0, ',', '.');
            $jumlahHarga[] = number_format($item->jumlah_harga, 0, ',', '.');
        }

        return view('pages.invoices.cetak', compact('invoice', 'penjualan', 'barang', 'penjualan_barang', 'hargaMod', 'jumlahHarga', 'norek', 'totHargaMod', 'dp', 'biayaLain', 'sisaBayarMod', 'formatTanggal', 'admin','toko', 'type'));
    }



    public function viewDownloadInvoice($id)
    {
        $penjualan = Penjualan::where('id', $id)->first();
        $invoice = Invoice::where('id', $penjualan->invoice)->first();
        $namaInv = $penjualan->nomor_invoice;
        $penjualan_barang = PenjualanBarang::where('penjualan_id', $id)->get();
        $admin_now = User::where('id', $penjualan->admin)->first();
        // $jenisBarang = Barang::all();
        $barang = [];
        $hargaMod = [];
        $jumlahHarga = [];
        $totHargaMod = number_format($penjualan->total_harga, 0, ',', '.');
        $totalHarga = number_format($penjualan->total_harga, 0, ',', '.');
        $sisaBayarMod = $penjualan->status === 'Lunas' ? '0' : number_format($penjualan->sisa_pembayaran, 0, ',', '.');
        
        $admin = $admin_now ? $admin_now->nama : 'Admin';
        $tanggal =  $penjualan->tgl_penjualan;
        Carbon::setLocale('id');
        $persen = '';

        // Ubah format tanggal menjadi tanggal string
        $tanggalString = Carbon::parse($tanggal)->toDateString();

        // Format tanggal yang diinginkan dengan bulan dalam bahasa Indonesia
        $formatTanggal = Carbon::parse($tanggalString)->isoFormat('DD MMMM YYYY');

        $norek = $penjualan->norek_text;

        if ($penjualan->dp == null) {
            $dp = 0;
        } else {
            $dp = number_format($penjualan->dp, 0, ',', '.');
        }

        if ($penjualan->diskon != null || $penjualan->potongan != null || $penjualan->ppn != null) {
            if ($penjualan->diskon) {
                $biayaLain = number_format($penjualan->diskon, 0, ',', '.') . '%';
            }else if( $penjualan->ppn){
                $biayaLain = number_format($penjualan->ppn / 100 * $penjualan->total_harga);
            }else {
                $biayaLain = 'Rp.' . number_format($penjualan->potongan, 0, ',', '.');
            }
        } else {
            $biayaLain = 0;
        }

        if ($penjualan->diskon) {
            $persen = number_format($penjualan->diskon, 0, ',', '.') . '%';
        } else if ($penjualan->ppn) {
            $persen = number_format($penjualan->ppn, 0, ',', '.') . '%';
        }
        foreach ($penjualan_barang as $item) {
            $barangItem = Barang::where('id', $item->barang_id)->get();
            $barang[] = $barangItem;
            $hargaMod[] = number_format($item->hargaBarang, 0, ',', '.');
            $jumlahHarga[] = number_format($item->jumlah_harga, 0, ',', '.');
        }
        $toko = "Ibekami.id";
        return view('pages.invoices.download', compact('invoice', 'penjualan', 'barang', 'penjualan_barang', 'hargaMod', 'jumlahHarga', 'norek', 'totHargaMod','totalHarga', 'dp', 'biayaLain', 'sisaBayarMod', 'formatTanggal', 'admin', 'persen','namaInv','toko'));
    }
    
     public function publicDownload(Request $request, $id)
    {
        // 1. CEK KEAMANAN LINK (Signature)
        // Ini memastikan link valid dan belum expired (30 hari)
        if (! $request->hasValidSignature()) {
            abort(403, 'Maaf, Link download ini sudah kadaluarsa atau tidak valid.');
        }

        // 2. LOGIKA DATA (Sama persis dengan viewDownloadInvoice Anda)
        $penjualan = Penjualan::where('id', $id)->first();

        // Cek jika data tidak ditemukan agar tidak error
        if (!$penjualan) {
            abort(404);
        }

        $invoice = Invoice::where('id', $penjualan->invoice)->first();
        $namaInv = $penjualan->nomor_invoice;
        $penjualan_barang = PenjualanBarang::where('penjualan_id', $id)->get();
        $admin_now = User::where('id', $penjualan->admin)->first();
        
        $barang = [];
        $hargaMod = [];
        $jumlahHarga = [];
        $totHargaMod = number_format($penjualan->total_harga, 0, ',', '.');
        $totalHarga = number_format($penjualan->total_harga, 0, ',', '.');
        $sisaBayarMod = $penjualan->status === 'Lunas' ? '0' : number_format($penjualan->sisa_pembayaran, 0, ',', '.');
        
        $admin = $admin_now ? $admin_now->nama : 'Admin'; // Antisipasi jika user admin terhapus
        $tanggal =  $penjualan->tgl_penjualan;
        Carbon::setLocale('id');
        $persen = '';

        // Ubah format tanggal menjadi tanggal string
        $tanggalString = Carbon::parse($tanggal)->toDateString();

        // Format tanggal yang diinginkan dengan bulan dalam bahasa Indonesia
        $formatTanggal = Carbon::parse($tanggalString)->isoFormat('DD MMMM YYYY');

        $norek = $penjualan->norek_text;

        if ($penjualan->dp == null) {
            $dp = 0;
        } else {
            $dp = number_format($penjualan->dp, 0, ',', '.');
        }

        if ($penjualan->diskon != null || $penjualan->potongan != null || $penjualan->ppn != null) {
            if ($penjualan->diskon) {
                $biayaLain = number_format($penjualan->diskon, 0, ',', '.') . '%';
            }else if( $penjualan->ppn){
                $biayaLain = number_format($penjualan->ppn / 100 * $penjualan->total_harga);
            }else {
                $biayaLain = 'Rp.' . number_format($penjualan->potongan, 0, ',', '.');
            }
        } else {
            $biayaLain = 0;
        }

        if ($penjualan->diskon) {
            $persen = number_format($penjualan->diskon, 0, ',', '.') . '%';
        } else if ($penjualan->ppn) {
            $persen = number_format($penjualan->ppn, 0, ',', '.') . '%';
        }
        foreach ($penjualan_barang as $item) {
            $barangItem = Barang::where('id', $item->barang_id)->get();
            $barang[] = $barangItem;
            $hargaMod[] = number_format($item->hargaBarang, 0, ',', '.');
            $jumlahHarga[] = number_format($item->jumlah_harga, 0, ',', '.');
        }
        
        $toko = "Ibekami.id";
        return view('pages.invoices.public-download-view', compact('invoice', 'penjualan', 'barang', 'penjualan_barang', 'hargaMod', 'jumlahHarga', 'norek', 'totHargaMod','totalHarga', 'dp', 'biayaLain', 'sisaBayarMod', 'formatTanggal', 'admin', 'persen','namaInv','toko'));
    }
    
    
    public function cetakInvoiceBaru(Request $request, $id)
    {
        $type = strtolower($request->query('type', 'asli'));
        if (!in_array($type, ['asli', 'copy'])) {
            $type = 'asli';
        }
        $penjualan = Penjualan::where('id', $id)->first();
        $invoice = Invoice::where('id', $penjualan->invoice)->first();
        $namaInv = $penjualan->nomor_invoice;
        $penjualan_barang = PenjualanBarang::where('penjualan_id', $id)->get();
        $admin_now = User::where('id', $penjualan->admin)->first();
        // $jenisBarang = Barang::all();
        $barang = [];
        $hargaMod = [];
        $jumlahHarga = [];
        $totHargaMod = number_format($penjualan->total_pembayaran, 0, ',', '.');
        $totalHarga = number_format($penjualan->total_harga, 0, ',', '.');
        $sisaBayarMod = $penjualan->status === 'Lunas' ? '0' : number_format($penjualan->sisa_pembayaran, 0, ',', '.');
        
        $admin = $admin_now->nama;
        $tanggal =  $penjualan->tgl_penjualan;
        Carbon::setLocale('id');
        $persen = '';
        $dp = null;

        // Ubah format tanggal menjadi tanggal string
        $tanggalString = Carbon::parse($tanggal)->toDateString();

        // Format tanggal yang diinginkan dengan bulan dalam bahasa Indonesia
        $formatTanggal = Carbon::parse($tanggalString)->isoFormat('DD MMMM YYYY');


        $norek = $penjualan->norek_text;

        if ($penjualan->dp != null) {

            $dp = number_format($penjualan->dp, 0, ',', '.');
        }

        if ($penjualan->diskon != null || $penjualan->potongan != null || $penjualan->ppn != null) {
            if ($penjualan->diskon || $penjualan->ppn) {
                $potongan = ($penjualan->diskon ? $penjualan->diskon : $penjualan->ppn) / 100 * $penjualan->total_harga;
                $biayaLain = 'Rp.' . number_format($potongan, 0, ',', '.');
            } else {
                $biayaLain = 'Rp.' . number_format($penjualan->potongan, 0, ',', '.');
            }
        } else {
            $biayaLain = 0;
        }

        if ($penjualan->diskon) {
            $persen = number_format($penjualan->diskon, 0, ',', '.') . '%';
        } else if ($penjualan->ppn) {
            $persen = number_format($penjualan->ppn, 0, ',', '.') . '%';
        }
        foreach ($penjualan_barang as $item) {
            $barangItem = Barang::where('id', $item->barang_id)->get();
            $barang[] = $barangItem;
            $hargaMod[] = number_format($item->hargaBarang, 0, ',', '.');
            $jumlahHarga[] = number_format($item->jumlah_harga, 0, ',', '.');
        }
        $toko = "Ikhtiar Berkah";
        return view('pages.invoices.cetakTerbaru', compact('invoice', 'penjualan', 'barang', 'penjualan_barang', 'hargaMod', 'jumlahHarga', 'norek', 'totHargaMod','totalHarga', 'dp', 'biayaLain', 'sisaBayarMod', 'formatTanggal', 'admin', 'persen','namaInv','toko', 'type'));
    }

    public function downloadInvoice()
    {
        $pdf = PDF::loadview('pages.invoices.pdf');
        return $pdf->download('invoice-test.pdf');
        // return view('pages.invoices.pdf');
    }

    function statusBatal($id)
    {
        $inv = Penjualan::find($id);
        if (!$inv) {
            Alert::error('Data tidak ditemukan');
            return redirect()->route('daftar_invoice');
        }
        $inv->status = 'Batal';
        $inv->save();
        InvoiceUpdateLog::create([
            'invoice_id' => $inv->id,
        ]);
        Alert::warning('Invoice Dibatalkan', 'Invoice #' . $inv->nomor_invoice . ' berhasil dibatalkan.');
        return redirect()->route('daftar_invoice')->with('success', 'Invoice berhasil dibatalkan.');
    }
    function statusLunas($id)
    {
        $inv = Penjualan::find($id);
        if (!$inv) {
            Alert::error('Data tidak ditemukan');
            return redirect()->back();
        }
        $inv->status = 'Lunas';
        $inv->sisa_pembayaran =0;
        $inv->save();
         InvoiceUpdateLog::create([
        'invoice_id' => $inv->id,
        
        ]);
        Alert::success('Invoice Sudah Lunas');
        return redirect()->back();
    }
    
    function unlock($id)
    {
        $inv = Penjualan::find($id);
        if (!$inv) {
            Alert::error('Data tidak ditemukan');
            return redirect()->back();
        }
        $inv->approval = 'Unlock';
        $inv->approved_at = now();
        $inv->save();

        $inv->save();
        
        Alert::success('Invoice Sudah di-Unlock');
        return redirect()->route('daftar_invoice');
    }
    
     function lock($id)
    {
        $inv = Penjualan::find($id);
        if (!$inv) {
            Alert::error('Data tidak ditemukan');
            return redirect()->back();
        }
        $inv->approval = 'Lock';
        

        $inv->save();
        
        Alert::success('Invoice Sudah di-Lock');
        return redirect()->back();
    }
 
    public function approvalPage($id)
{
    $invoice = Penjualan::where('id', $id)->firstOrFail();
    $penjualan_barang = PenjualanBarang::where('penjualan_id', $id)->get();
    
    $invoice->formatted_total_pembayaran = number_format($invoice->total_pembayaran, 0, ',', ',');
    $barang = [];
    $hargaMod = [];
    $jumlahHarga = [];
     foreach ($penjualan_barang as $item) {
            $barangItem = Barang::where('id', $item->barang_id)->get();
            $barang[] = $barangItem;
            $hargaMod[] = number_format($item->hargaBarang, 0, ',', '.');
            $jumlahHarga[] = number_format($item->jumlah_harga, 0, ',', '.');
        }



    return view('pages.invoices.approval', compact('invoice','penjualan_barang','barang','hargaMod','jumlahHarga'));
}
    public function pelunasanPage($id)
{
    $invoice = Penjualan::where('id', $id)->firstOrFail();
    $penjualan_barang = PenjualanBarang::where('penjualan_id', $id)->get();
   $invoice->formatted_total_pembayaran = number_format($invoice->total_pembayaran, 0, ',', ',');
    $barang = [];
    $hargaMod = [];
    $jumlahHarga = [];
     foreach ($penjualan_barang as $item) {
            $barangItem = Barang::where('id', $item->barang_id)->get();
            $barang[] = $barangItem;
            $hargaMod[] = number_format($item->hargaBarang, 0, ',', '.');
            $jumlahHarga[] = number_format($item->jumlah_harga, 0, ',', '.');
        }


    return view('pages.invoices.pelunasan', compact('invoice','penjualan_barang','barang','hargaMod','jumlahHarga'));
}

        public function storeStatusBatal (Request $request, $id)
        {
            $invoice = Penjualan::find($id);
            if (!$invoice) {
                Alert::error('Data tidak ditemukan');
                return redirect()->route('daftar_invoice');
            }
            $invoice->status = 'Batal';
            if ($request->has('alasan_batal') && !empty($request->alasan_batal)) {
                $invoice->alasan_batal = $request->alasan_batal; // Simpan alasan dari SweetAlert
            }
            $invoice->save();
            
            InvoiceUpdateLog::create([
                'invoice_id' => $invoice->id,
            ]);

            Alert::warning('Invoice Dibatalkan', 'Invoice #' . $invoice->nomor_invoice . ' berhasil dibatalkan.');
            return redirect()->route('daftar_invoice')->with('success', 'Invoice berhasil dibatalkan.');
        }
    
     public function getUpdateLog($id)
{
    $penjualan = Penjualan::with('InvoiceUpdateLog')->findOrFail($id);

    return response()->json([
        'created_at' => $penjualan->created_at->format('d-m-Y H:i'), 
        'logs' => $penjualan->InvoiceUpdateLog->map(function($log) {
            return [
                'tanggal' => $log->created_at->format('d-m-Y H:i'),
                'keterangan' => $log->keterangan,
            ];
        })
    ]);
}
}