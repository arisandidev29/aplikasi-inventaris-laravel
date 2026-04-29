<?php

use App\Models\items;
use App\Models\transactions;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    // Form fields
    public string $tanggal_transaksi = '';
    public ?int $item_id = null;
    public int $quantity = 1;
    public string $keterangan = '';

    // Search untuk select item
    public string $searchItem = '';

    // State UI
    public bool $showForm = true;
    public ?array $selectedItem = null;

    protected function rules(): array
    {
        return [
            'tanggal_transaksi' => 'required|date',
            'item_id'           => 'required|exists:items,id',
            'quantity'          => 'required|integer|min:1',
            'keterangan'        => 'nullable|string|max:500',
        ];
    }

    protected array $messages = [
        'tanggal_transaksi.required' => 'Tanggal transaksi wajib diisi.',
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
    }

    public function save(): void
    {
        $this->validate();

        // Simpan transaksi
        transactions::create([
            'item_id'           => $this->item_id,
            'user_id'           => Auth::id(),
            'type'              => 'masuk',
            'quantity'          => $this->quantity,
            'tanggal_transaksi' => $this->tanggal_transaksi,
            'keterangan'        => $this->keterangan,
        ]);

        // Update stok barang
        items::find($this->item_id)->increment('stok', $this->quantity);

        session()->flash('success', 'Barang masuk berhasil direkam. Stok telah diperbarui.');

        // Reset form
        $this->reset(['item_id', 'quantity', 'keterangan', 'selectedItem', 'searchItem']);
        $this->tanggal_transaksi = now()->format('Y-m-d');
        $this->resetValidation();
        $this->resetPage();
    }

    public function render()
    {
        $items = items::with('category')
            ->when($this->searchItem, fn($q) => $q->where('nama_barang', 'like', '%' . $this->searchItem . '%')
                ->orWhere('kode_barang', 'like', '%' . $this->searchItem . '%'))
            ->orderBy('nama_barang')
            ->get();

        $riwayat = transactions::with(['item.category', 'user'])
            ->where('type', 'masuk')
            ->latest('tanggal_transaksi')
            ->paginate(8);

        $todayCount = transactions::where('type', 'masuk')
            ->whereDate('tanggal_transaksi', today())
            ->count();

        $todayQty = transactions::where('type', 'masuk')
            ->whereDate('tanggal_transaksi', today())
            ->sum('quantity');

        $lastEntries = transactions::with('item')
            ->where('type', 'masuk')
            ->latest()
            ->take(3)
            ->get();

        return view('pages::barang-masuk.barang-masuk', compact(
            'items',
            'riwayat',
            'todayCount',
            'todayQty',
            'lastEntries'
        ));
    }
};
