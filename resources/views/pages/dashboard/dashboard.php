<?php

use App\Models\items;
use App\Models\Loan;
use App\Models\transactions;
use Livewire\Component;

new class extends Component
{
    public int   $totalIt        = 0;
    public int   $totalPublikasi = 0;
    public int   $activeLoans    = 0;
    public int   $brokenItems    = 0;
    public array $chartMasuk     = [];  // FIX: pisah masuk & keluar
    public array $chartKeluar    = [];
    public int   $chartMax       = 1;   // FIX: untuk skala bar yang benar

    public function mount(): void
    {
        $this->loadData();
    }

    public function loadData(): void
    {
        $this->totalIt = items::whereHas('category', fn($q) =>
            $q->where('name', 'Barang IT')
        )->sum('stok');

        $this->totalPublikasi = items::whereHas('category', fn($q) =>
            $q->where('name', 'Barang Publikasi')
        )->sum('stok');

        $this->activeLoans = Loan::where('status', 'dipinjam')->count();

        $this->brokenItems = items::where('kondisi', 'Rusak')->count();

        $this->loadChart();
    }

    private function loadChart(): void
    {
        $masuk   = [];
        $keluar  = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();

            $masuk[]  = transactions::whereDate('tanggal_transaksi', $date)
                ->where('type', 'masuk')
                ->sum('quantity');

            $keluar[] = transactions::whereDate('tanggal_transaksi', $date)
                ->where('type', 'keluar')
                ->sum('quantity');
        }

        $this->chartMasuk  = $masuk;
        $this->chartKeluar = $keluar;

        // Hitung max untuk skala bar yang proporsional
        $allValues      = array_merge($masuk, $keluar);
        $this->chartMax = max(max($allValues), 1); // minimal 1 agar tidak div-by-zero
    }

    public function render()
    {
        $recentActivities = transactions::with(['item.category', 'user'])
            ->latest()
            ->take(10)
            ->get();

        return view('pages.dashboard.dashboard', [
            'recentActivities' => $recentActivities,
        ]);
    }
};