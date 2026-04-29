<?php

use App\Models\category;
use App\Models\items;
use App\Models\transactions;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithPagination;


new class extends Component {
    //
    use WithPagination;

    // ── Filter
    public string $periodeAwal   = '';
    public string $periodeAkhir  = '';
    public string $filterKategori = '';
    public string $search        = '';

    public function mount(): void
    {
        // Default: bulan ini
        $this->periodeAwal  = now()->startOfMonth()->format('Y-m-d');
        $this->periodeAkhir = now()->endOfMonth()->format('Y-m-d');
    }

    public function updatedPeriodeAwal(): void
    {
        $this->resetPage();
    }
    public function updatedPeriodeAkhir(): void
    {
        $this->resetPage();
    }
    public function updatedFilterKategori(): void
    {
        $this->resetPage();
    }
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function filter(): void
    {
        $this->resetPage();
    }

    // gemini
    private function getDataRekapitulasi($isForExport = false)
    {
        // Base Query
        $query = items::with('category')
            ->when($this->filterKategori, fn($q) => $q->where('category_id', $this->filterKategori))
            ->when(trim($this->search), fn($q) => $q
                ->where('nama_barang', 'like', '%' . $this->search . '%')
                ->orWhere('kode_barang', 'like', '%' . $this->search . '%'))
            ->orderBy('nama_barang');

        // Fungsi pemetaan untuk menghitung stok awal, masuk, dan keluar
        $mapper = function ($item) {
            $masuk = transactions::where('item_id', $item->id)
                ->where('type', 'masuk')
                ->when($this->periodeAwal, fn($q) => $q->whereDate('tanggal_transaksi', '>=', $this->periodeAwal))
                ->when($this->periodeAkhir, fn($q) => $q->whereDate('tanggal_transaksi', '<=', $this->periodeAkhir))
                ->sum('quantity');

            $keluar = transactions::where('item_id', $item->id)
                ->where('type', 'keluar')
                ->when($this->periodeAwal, fn($q) => $q->whereDate('tanggal_transaksi', '>=', $this->periodeAwal))
                ->when($this->periodeAkhir, fn($q) => $q->whereDate('tanggal_transaksi', '<=', $this->periodeAkhir))
                ->sum('quantity');

            $stokAkhir = $item->stok;
            $stokAwal  = $stokAkhir - $masuk + $keluar;

            return [
                'nama_barang' => $item->nama_barang,
                'kode_barang' => $item->kode_barang,
                'kategori'    => $item->category?->name ?? '-',
                'stok_awal'   => max(0, $stokAwal),
                'masuk'       => $masuk,
                'keluar'      => $keluar,
                'stok_akhir'  => $stokAkhir,
            ];
        };

        // Jika untuk export, ambil semua (get). Jika untuk tampilan, bagi per halaman (paginate).
        return $isForExport
            ? $query->get()->map($mapper)
            : $query->paginate(10)->through($mapper);
    }


    public function exportPDF()
    {
        $data = $this->getDataRekapitulasi(true);

        // Gunakan public_path() untuk mendapatkan path fisik di server
        $logoPath = public_path('logo.png');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('export.rekap-pdf', [
            'results' => $data,
            'tglAwal' => $this->periodeAwal,
            'tglAkhir' => $this->periodeAkhir,
            'logo'    => $logoPath,
            'namaInstansi' => 'BPMP PROVINSI MALUKU UTARA'
        ])->setPaper('a4', 'landscape');

        return response()->streamDownload(
            fn() => print($pdf->output()),
            "Laporan_Inventaris_BPMP_Malut.pdf"
        );
    }
    // end gemini

    public function render()
    {
        // ── Query utama: setiap item dengan mutasi pada periode
        $query = items::with('category')
            ->when($this->filterKategori, fn($q) => $q->where('category_id', $this->filterKategori))
            ->when(trim($this->search), fn($q) => $q
                ->where('nama_barang', 'like', '%' . $this->search . '%')
                ->orWhere('kode_barang', 'like', '%' . $this->search . '%'))
            ->orderBy('nama_barang');

        $rekap = $query->paginate(10)->through(function ($item) {
            // Masuk pada periode
            $masuk = transactions::where('item_id', $item->id)
                ->where('type', 'masuk')
                ->when($this->periodeAwal,  fn($q) => $q->whereDate('tanggal_transaksi', '>=', $this->periodeAwal))
                ->when($this->periodeAkhir, fn($q) => $q->whereDate('tanggal_transaksi', '<=', $this->periodeAkhir))
                ->sum('quantity');

            // Keluar pada periode
            $keluar = transactions::where('item_id', $item->id)
                ->where('type', 'keluar')
                ->when($this->periodeAwal,  fn($q) => $q->whereDate('tanggal_transaksi', '>=', $this->periodeAwal))
                ->when($this->periodeAkhir, fn($q) => $q->whereDate('tanggal_transaksi', '<=', $this->periodeAkhir))
                ->sum('quantity');

            // Stok awal = stok sekarang - masuk + keluar (pada periode)
            $stokAkhir = $item->stok;
            $stokAwal  = $stokAkhir - $masuk + $keluar;

            return [
                'id'          => $item->id,
                'nama_barang' => $item->nama_barang,
                'kode_barang' => $item->kode_barang,
                'kategori'    => $item->category?->name ?? '-',
                'stok_awal'   => max(0, $stokAwal),
                'masuk'       => $masuk,
                'keluar'      => $keluar,
                'stok_akhir'  => $stokAkhir,
            ];
        });

        // ── Summary stats
        $totalItem = items::count();

        $totalMasuk = transactions::where('type', 'masuk')
            ->when($this->periodeAwal,  fn($q) => $q->whereDate('tanggal_transaksi', '>=', $this->periodeAwal))
            ->when($this->periodeAkhir, fn($q) => $q->whereDate('tanggal_transaksi', '<=', $this->periodeAkhir))
            ->sum('quantity');

        $totalKeluar = transactions::where('type', 'keluar')
            ->when($this->periodeAwal,  fn($q) => $q->whereDate('tanggal_transaksi', '>=', $this->periodeAwal))
            ->when($this->periodeAkhir, fn($q) => $q->whereDate('tanggal_transaksi', '<=', $this->periodeAkhir))
            ->sum('quantity');

        // Persentase item dengan stok > 0
        $itemAktif   = items::where('stok', '>', 0)->count();
        $persenAktif = $totalItem > 0 ? round(($itemAktif / $totalItem) * 100) : 0;

        // ── Daftar kategori untuk filter
        $kategoriList = category::orderBy('name')->get();

        return view('pages::rekapitulasi.rekapitulasi', compact(
            'rekap',
            'totalItem',
            'totalMasuk',
            'totalKeluar',
            'persenAktif',
            'kategoriList',
        ));
    }
};
