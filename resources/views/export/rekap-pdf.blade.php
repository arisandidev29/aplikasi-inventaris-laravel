<!DOCTYPE html>
<html>
<head>
    <style>
        @page { margin: 1cm; }
        body { font-family: 'Arial', sans-serif; font-size: 10pt; line-height: 1.3; }
        
        /* KOP SURAT FORMAL */
        .header-table { width: 100%; border-bottom: 4px double #000; padding-bottom: 10px; margin-bottom: 20px; }
        .logo-col { width: 15%; text-align: center; }
        .text-col { width: 85%; text-align: center; padding-right: 15%; } /* Padding kanan untuk balancing logo */
        
        .kementrian { font-size: 12pt; margin: 0; font-weight: normal; }
        .bpmp { font-size: 16pt; margin: 0; font-weight: bold; text-transform: uppercase; }
        .alamat { font-size: 8pt; margin: 5px 0 0 0; font-style: italic; font-weight: normal; }

        /* JUDUL LAPORAN */
        .title-section { text-align: center; margin-bottom: 20px; }
        .title-section h3 { text-transform: uppercase; text-decoration: underline; margin: 0; }
        .title-section p { margin: 5px 0; font-size: 9pt; }

        /* TABEL DATA */
        table.main-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.main-table th { background-color: #f2f2f2; border: 1px solid #000; padding: 8px; font-size: 8pt; text-transform: uppercase; }
        table.main-table td { border: 1px solid #000; padding: 6px; font-size: 9pt; }
        
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        .bg-gray { background-color: #fafafa; }

        /* TANDA TANGAN */
        .footer-table { width: 100%; margin-top: 30px; border: none; }
        .sign-area { width: 30%; text-align: center; }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td class="logo-col">
                <img src="{{ $logo }}" style="width: 80px; height: auto;">
            </td>
            <td class="text-col">
                <div class="kementrian">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</div>
                <div class="bpmp">BPMP PROVINSI MALUKU UTARA</div>
                <div class="alamat">Jl. Raya Soasio, Kec. Galela, Kab. Halmahera Utara, Maluku Utara <br> Website: bpmpmalut.kemdikbud.go.id</div>
            </td>
        </tr>
    </table>

    <div class="title-section">
        <h3>LAPORAN REKAPITULASI INVENTARIS</h3>
        <p>Periode: {{ \Carbon\Carbon::parse($tglAwal)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($tglAkhir)->translatedFormat('d F Y') }}</p>
    </div>

    <table class="main-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok Awal</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Stok Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $index => $row)
            <tr class="{{ $index % 2 == 1 ? 'bg-gray' : '' }}">
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-bold text-center">{{ $row['kode_barang'] }}</td>
                <td>{{ $row['nama_barang'] }}</td>
                <td class="text-center">{{ $row['kategori'] }}</td>
                <td class="text-center">{{ $row['stok_awal'] }}</td>
                <td class="text-center" style="color: #059669;">+{{ $row['masuk'] }}</td>
                <td class="text-center" style="color: #dc2626;">-{{ $row['keluar'] }}</td>
                <td class="text-center text-bold">{{ $row['stok_akhir'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="footer-table">
        <tr>
            <td width="70%"></td>
            <td class="sign-area">
                <p>Ternate, {{ now()->translatedFormat('d F Y') }}</p>
                <p>Mengetahui,</p>
                <p>Petugas Inventaris</p>
                <br><br><br>
                <p class="text-bold">( __________________________ )</p>
                <p>NIP. ...........................</p>
            </td>
        </tr>
    </table>

</body>
</html>