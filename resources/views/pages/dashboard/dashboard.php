<?php

use App\Models\items;
use App\Models\Loan;
use App\Models\transactions;
use Livewire\Component;

new class extends Component
{
     public int $totalIt        = 0;
    public int $totalPublikasi = 0;
    public int $activeLoans    = 0;
    public int $brokenItems    = 0;
    public array $chartBars    = [];

    public function mount(): void
    {
        $this->loadData();
    }

    public function loadData(): void
    {
        $this->totalIt = items::whereHas('category', fn ($q) =>
            $q->where('name', 'Barang IT')
        )->sum('stok');

        $this->totalPublikasi = items::whereHas('category', fn ($q) =>
            $q->where('name', 'Barang Publikasi')
        )->sum('stok');

        $this->activeLoans = Loan::where('status', 'dipinjam')->count();

        $this->brokenItems = items::where('kondisi', 'Rusak')->count();

        $this->chartBars = $this->getChartBars();
    }

    private function getChartBars(): array
    {
        $bars = [];

        for ($i = 6; $i >= 0; $i--) {
            $bars[] = transactions::whereDate(
                'tanggal_transaksi',
                now()->subDays($i)->toDateString()
            )->count();
        }

        return $bars;
    }

    public function render()
    {
        // Query di render agar fresh setiap poll
        $recentActivities = transactions::with(['item.category', 'user'])
            ->latest()
            ->take(10)
            ->get();

        return view('pages.dashboard.dashboard', [
            'recentActivities' => $recentActivities,
        ]);
    }
};
