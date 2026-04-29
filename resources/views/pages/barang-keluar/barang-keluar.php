<?php

use App\Models\items;
use App\Models\transactions;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    //
    use WithPagination;
 
    // Form fields
    public string $tanggal_transaksi = '';
    public ?int $item_id = null;
    public int $quantity = 1;
    public string $keterangan = '';
 
    // Search untuk select item
    public string $searchItem = '';
 
    // Info barang terpilih
    public ?array $selectedItem = null;
 
    protected function rules(): array
    {
        return [
            'tanggal_transaksi' => 'required|date',
            'item_id'           => 'required|exists:items,id',
            'quantity'          => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    if ($this->selectedItem && $value > $this->selectedItem['stok']) {
                        $fail('Kuantiti melebihi stok yang tersedia (' . $this->selectedItem['stok'] . ' unit).');
                    }
                },
            ],
            'keterangan' => 'nullable|string|max:500',
        ];
    }
 
    protected array $messages = [
        'tanggal_transaksi.required' => 'Tanggal keluar wajib diisi.',
        'item_id.required'           => 'Pilih barang terlebih dahulu.',
        'quantity.required'          => 'Kuantiti wajib diisi.',
        'quantity.min'               => 'Kuantiti minimal 1.',
    ];
 
    public function mount(): void
    {
        $this->tanggal_transaksi = now()->format('Y-m-d');
    }
 
    public function updatedItemId($value): void
    {
        if ($value) {
            $item = items::with('category')->find($value);
            $this->selectedItem = $item ? [
                'id'          => $item->id,
                'nama_barang' => $item->nama_barang,
                'kode_barang' => $item->kode_barang,
                'stok'        => $item->stok,
                'kondisi'     => $item->kondisi,
                'kategori'    => $item->category?->name ?? '-',
            ] : null;
        } else {
            $this->selectedItem = null;
        }
        $this->resetValidation('quantity');
    }
 
    public function save(): void
    {
        // Refresh stok terbaru sebelum validasi
        if ($this->item_id) {
            $item = items::find($this->item_id);
            if ($item) {
                $this->selectedItem['stok'] = $item->stok;
            }
        }
 
        $this->validate();
 
        // Simpan transaksi
        transactions::create([
            'item_id'           => $this->item_id,
            'user_id'           => Auth::id(),
            'type'              => 'keluar',
            'quantity'          => $this->quantity,
            'tanggal_transaksi' => $this->tanggal_transaksi,
            'keterangan'        => $this->keterangan,
        ]);
 
        // Kurangi stok barang
        items::find($this->item_id)->decrement('stok', $this->quantity);
 
        session()->flash('success', 'Barang keluar berhasil direkam. Stok telah dikurangi.');
 
        $this->reset(['item_id', 'quantity', 'keterangan', 'selectedItem', 'searchItem']);
        $this->tanggal_transaksi = now()->format('Y-m-d');
        $this->resetValidation();
        $this->resetPage();
    }
 
    public function render()
    {
        $items = items::with('category')
            ->when(trim($this->searchItem), fn($q) => $q
                ->where('nama_barang', 'like', '%' . $this->searchItem . '%')
                ->orWhere('kode_barang', 'like', '%' . $this->searchItem . '%'))
            ->orderBy('nama_barang')
            ->get();
 
        $riwayat = transactions::with(['item.category', 'user'])
            ->where('type', 'keluar')
            ->latest('tanggal_transaksi')
            ->paginate(8);
 
        $todayCount = transactions::where('type', 'keluar')
            ->whereDate('tanggal_transaksi', today())
            ->count();
 
        $todayQty = transactions::where('type', 'keluar')
            ->whereDate('tanggal_transaksi', today())
            ->sum('quantity');
 
        // Barang dengan stok kritis (stok <= 5)
        $stokKritis = items::with('category')
            ->where('stok', '<=', 5)
            ->orderBy('stok')
            ->take(5)
            ->get();
 
        $lastEntries = transactions::with('item')
            ->where('type', 'keluar')
            ->latest()
            ->take(3)
            ->get();
 
        return view('pages::barang-keluar.barang-keluar', compact(
            'items', 'riwayat', 'todayCount', 'todayQty', 'stokKritis', 'lastEntries'
        ));
    }

};
