<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak SPK - {{ $spk->nomor_invoice }}</title>
    <link rel="shortcut icon" href="{{ asset('images/Ibekami.png') }}">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1e293b;
            background-color: #f8fafc;
            padding: 24px;
        }
        .print-container {
            max-width: 850px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 32px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #0f172a;
            padding-bottom: 16px;
            margin-bottom: 24px;
        }
        .header-title h2 {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.02em;
            text-transform: uppercase;
        }
        .header-title p {
            font-size: 13px;
            color: #64748b;
            margin-top: 2px;
        }
        .brand-badge {
            font-size: 14px;
            font-weight: 700;
            color: #4f46e5;
            background: #eef2ff;
            border: 1px solid #c7d2fe;
            padding: 6px 14px;
            border-radius: 6px;
        }
        .spk-layout {
            display: flex;
            gap: 24px;
        }
        .spk-info-table {
            flex: 1.3;
        }
        .spk-image-container {
            flex: 0.9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            border: 1.5px dashed #cbd5e1;
            border-radius: 8px;
            padding: 16px;
            background: #f8fafc;
            min-height: 250px;
        }
        .spk-image-container img {
            max-width: 100%;
            max-height: 280px;
            object-fit: contain;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }
        .table-data {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }
        .table-data th, .table-data td {
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
            text-align: left;
        }
        .table-data th {
            width: 38%;
            background-color: #f1f5f9;
            color: #334155;
            font-weight: 600;
        }
        .table-data td {
            background-color: #ffffff;
            color: #0f172a;
            font-weight: 500;
        }
        .badge-express-yes {
            color: #dc2626;
            font-weight: 700;
            background: #fee2e2;
            padding: 2px 8px;
            border-radius: 4px;
            display: inline-block;
        }
        .badge-express-no {
            color: #475569;
            font-weight: 600;
        }
        .print-actions {
            margin-top: 24px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }
        .btn {
            padding: 8px 18px;
            font-size: 13.5px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            border: none;
            transition: all 0.15s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-print {
            background: #4f46e5;
            color: #ffffff;
        }
        .btn-print:hover {
            background: #4338ca;
        }
        .btn-close-window {
            background: #e2e8f0;
            color: #475569;
        }
        .btn-close-window:hover {
            background: #cbd5e1;
        }
        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }
            .print-container {
                border: none;
                box-shadow: none;
                padding: 0;
                max-width: 100%;
            }
            .print-actions {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="print-container">
        <div class="header">
            <div class="header-title">
                <h2>Surat Perintah Kerja (SPK)</h2>
                <p>Dokumen Instruksi Kerja Produksi & Desain</p>
            </div>
            <div class="brand-badge">
                IBEKAMI / TOKABE
            </div>
        </div>

        <div class="spk-layout">
            <div class="spk-info-table">
                <table class="table-data">
                    <tr>
                        <th>Nomor Invoice</th>
                        <td><strong>{{ $spk->nomor_invoice }}</strong></td>
                    </tr>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <td>{{ $tanggal }}</td>
                    </tr>
                    <tr>
                        <th>Pelanggan / Customer</th>
                        <td>{{ $spk->customer }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Pekerjaan</th>
                        <td>{{ $spk->pekerjaan }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Pesanan</th>
                        <td>{{ number_format($spk->jumlah) }} {{ $spk->satuan }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Bahan</th>
                        <td>{{ $spk->jenis_bahan ?? '-' }}</td>
                    </tr>
                    @if(!empty($spk->ketebalan))
                    <tr>
                        <th>Ketebalan</th>
                        <td>{{ $spk->ketebalan }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Ukuran</th>
                        <td>{{ $spk->ukuran ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Keterangan Lainnya</th>
                        <td>{{ $spk->lain ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Prioritas Express</th>
                        <td>
                            @if($spk->express === 'Y')
                                <span class="badge-express-yes">⚡ YA (Express)</span>
                            @else
                                <span class="badge-express-no">Tidak (Standar)</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Target Selesai</th>
                        <td><strong>{{ $target }}</strong></td>
                    </tr>
                </table>
            </div>

            <div class="spk-image-container">
                <div style="font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 8px; text-transform: uppercase;">
                    Contoh Desain / Layout
                </div>
                @if(!empty($spk->gambar) && $spk->gambar !== 'noImage.jpg' && file_exists(public_path('images/spk/' . $spk->gambar)))
                    <img src="{{ asset('images/spk/' . $spk->gambar) }}" alt="Preview Desain SPK {{ $spk->nomor_invoice }}">
                @else
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 180px; color: #94a3b8; font-size: 13px;">
                        <span>Tidak ada lampiran gambar</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="print-actions">
            <button onclick="window.close()" class="btn btn-close-window">Tutup</button>
            <button onclick="window.print()" class="btn btn-print">Cetak Sekarang</button>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                window.print();
            }, 400);
        });
    </script>
</body>
</html>