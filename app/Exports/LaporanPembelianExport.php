<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;

class LaporanPembelianExport implements FromArray, ShouldAutoSize, WithHeadings, WithEvents, WithHeadingRow
{
    protected $pembelians;
    protected $namaPerusahaan;

    public function __construct(Collection $pembelians, $namaPerusahaan = null)
    {
        $this->pembelians = $pembelians;
        $this->namaPerusahaan = $namaPerusahaan;
    }

    public function headings(): array
    {
        return [
            ['#', '#', '#', '#', '#', '#', '#', '#', '#'],
            [
                'No',
                'No Invoice/Nota',
                'Tanggal Pembelian',
                'Nama Vendor',
                'Total Transaksi',
                'Total Terbayar',
                'Sisa',
                'Status',
                'Tanggal Jatuh Tempo',
            ]
        ];
    }

    public function headingRow(): int
    {
        return 2;
    }

    public function array(): array
    {
        Carbon::setLocale('id');
        $data = [];

        foreach ($this->pembelians as $index => $pem) {
            $tglBeli = !empty($pem->tanggal) ? Carbon::parse($pem->tanggal)->locale('id')->isoFormat('DD MMMM YYYY') : '-';
            $tglJto = !empty($pem->tgl_jto) ? Carbon::parse($pem->tgl_jto)->locale('id')->isoFormat('DD MMMM YYYY') : '-';
            $vendorName = $pem->vendor ? $pem->vendor->nama_vendor : 'Tidak Diketahui';

            $data[] = [
                $index + 1,
                $pem->nomor_inv ?? ('PEM-' . $pem->id),
                $tglBeli,
                $vendorName,
                (float) ($pem->jumlah_harga ?? 0),
                (float) ($pem->terbayar ?? 0),
                (float) ($pem->sisa ?? 0),
                $pem->status ?? '-',
                $tglJto,
            ];
        }

        return $data;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Merge and center the title across A1:I1 (9 Kolom)
                $event->sheet->getDelegate()->mergeCells('A1:I1');
                $event->sheet->getDelegate()->getStyle('A1:I1')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                ]);

                $perusahaanTitle = !empty($this->namaPerusahaan) ? strtoupper($this->namaPerusahaan) : 'IKHTIAR BERKAH';
                $event->sheet->getDelegate()->setCellValue('A1', 'LAPORAN PEMBELIAN ' . $perusahaanTitle);

                // Heading Style
                $event->sheet->getDelegate()->getStyle('A2:I2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $lastColumn = 'I';
                $lastRow = max(2, $event->sheet->getDelegate()->getHighestRow());
                $range = 'A2:' . $lastColumn . $lastRow;

                // Border & alignment for content
                $event->sheet->getDelegate()->getStyle('A3:' . $lastColumn . $lastRow)->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
                $event->sheet->getDelegate()->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // Summary Row
                if ($lastRow >= 3) {
                    $summaryRow = $lastRow + 1;
                    $event->sheet->getDelegate()->setCellValue('D' . $summaryRow, 'Total');
                    $event->sheet->getDelegate()->setCellValue('E' . $summaryRow, '=SUM(E3:E' . $lastRow . ')');
                    $event->sheet->getDelegate()->setCellValue('F' . $summaryRow, '=SUM(F3:F' . $lastRow . ')');
                    $event->sheet->getDelegate()->setCellValue('G' . $summaryRow, '=SUM(G3:G' . $lastRow . ')');

                    $event->sheet->getDelegate()->getStyle('D' . $summaryRow . ':G' . $summaryRow)->getFont()->setBold(true);

                    // Currency Formats
                    $event->sheet->getDelegate()->getStyle('E3:E' . $summaryRow)->getNumberFormat()->setFormatCode('Rp#,##0');
                    $event->sheet->getDelegate()->getStyle('F3:F' . $summaryRow)->getNumberFormat()->setFormatCode('Rp#,##0');
                    $event->sheet->getDelegate()->getStyle('G3:G' . $summaryRow)->getNumberFormat()->setFormatCode('Rp#,##0');
                    $lastRow = $summaryRow;
                }

                // Footer signature block
                $perusahaanNama = !empty($this->namaPerusahaan) ? $this->namaPerusahaan : 'IKHTIAR BERKAH';
                $footerRows = [
                    [
                        'row' => $lastRow + 3,
                        'text' => $perusahaanNama . ', ' . Carbon::now()->locale('id')->isoFormat('DD MMMM YYYY'),
                        'underline' => false,
                        'bold' => false,
                    ],
                    [
                        'row' => $lastRow + 4,
                        'text' => 'Disiapkan Oleh,',
                        'underline' => false,
                        'bold' => false,
                    ],
                    [
                        'row' => $lastRow + 8,
                        'text' => Auth::user()->nama ?? 'Admin',
                        'underline' => true,
                        'bold' => true,
                    ],
                    [
                        'row' => $lastRow + 9,
                        'text' => Auth::user()->role ?? 'Staff',
                        'underline' => false,
                        'bold' => false,
                    ],
                ];

                foreach ($footerRows as $f) {
                    $r = $f['row'];
                    $event->sheet->getDelegate()->mergeCells('A' . $r . ':D' . $r);
                    $event->sheet->getDelegate()->getStyle('A' . $r)->applyFromArray([
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                        ],
                        'font' => [
                            'bold' => $f['bold'],
                            'size' => 10,
                            'underline' => $f['underline'] ? Font::UNDERLINE_SINGLE : Font::UNDERLINE_NONE,
                        ],
                    ]);
                    $event->sheet->getDelegate()->setCellValue('A' . $r, $f['text']);
                }
            }
        ];
    }
}
