<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasImageUpload;
use App\Models\category;
use App\Models\items;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;
    use HasImageUpload;

    public string $search    = '';
    public string $kategori  = '';
    public bool   $showModal = false;
    public bool   $isEditing = false;

    // Form fields
    public ?int   $editId       = null;
    public string $kode_barang  = '';
    public string $nama_barang  = '';
    public string $merk         = '';
    public int    $stok         = 0;
    public string $kondisi      = 'Bagus';
    public string $lokasi       = '';
    public string $deskripsi    = '';
    public ?int   $category_id  = null;

    // Image
    public $photo                    = null;
    public ?string $image_url        = null;
    public ?string $imagekit_file_id = null;

    // ──────────────────────────────────────────
    // FITUR BARU: Modal hapus single
    // ──────────────────────────────────────────
    public bool   $modalHapus      = false;
    public ?int   $hapusId         = null;
    public string $hapusNamaBarang = '';

    // ──────────────────────────────────────────
    // FITUR BARU: Multiple delete
    // ──────────────────────────────────────────
    public array $selectedIds      = [];
    public bool  $modalBulkHapus   = false;
    public bool  $selectAll        = false;

    // Reset pagination saat search/filter berubah
    public function updatingSearch(): void
    {
        $this->resetPage();
        $this->selectedIds = [];
        $this->selectAll   = false;
    }

    public function updatingKategori(): void
    {
        $this->resetPage();
        $this->selectedIds = [];
        $this->selectAll   = false;
    }

    // Saat selectAll berubah, pilih/batal semua item di halaman ini
    public function updatedSelectAll(bool $value): void
    {
        if ($value) {
            $itCategoryId    = category::where('name', $this->categoryName)->value('id');
            $this->selectedIds = items::where('category_id', $itCategoryId)
                ->when($this->search, fn($q) => $q->where('nama_barang', 'like', "%{$this->search}%")
                    ->orWhere('kode_barang', 'like', "%{$this->search}%"))
                ->when($this->kategori, fn($q) => $q->where('category_id', $this->kategori))
                ->paginate(10)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedIds = [];
        }
    }

    #[Computed]
    public function kategoris()
    {
        return category::all();
    }

    protected string $categoryName = 'Barang Publikasi';

    public function openCreate(): void
    {
        $this->reset([
            'editId',
            'kode_barang',
            'nama_barang',
            'merk',
            'stok',
            'kondisi',
            'lokasi',
            'deskripsi',
            'photo',
            'image_url',
            'imagekit_file_id',
        ]);
        $this->category_id = category::where('name', $this->categoryName)->value('id');
        $this->isEditing   = false;
        $this->showModal   = true;
    }

    public function openEdit(int $id): void
    {
        $item              = items::findOrFail($id);
        $this->editId      = $item->id;
        $this->kode_barang = $item->kode_barang;
        $this->nama_barang = $item->nama_barang;
        $this->merk        = $item->merk;
        $this->stok        = $item->stok;
        $this->kondisi     = $item->kondisi;
        $this->lokasi      = $item->lokasi;
        $this->deskripsi   = $item->deskripsi ?? '';
        $this->category_id = $item->category_id;
        $this->isEditing   = true;

        $this->image_url        = $item->image_url;
        $this->imagekit_file_id = $item->imagekit_file_id;
        $this->photo            = null;
        $this->showModal        = true;
    }

    // ──────────────────────────────────────────
    // FITUR BARU: Buka modal hapus single
    // ──────────────────────────────────────────
    public function confirmDelete(int $id): void
    {
        $item                  = items::findOrFail($id);
        $this->hapusId         = $id;
        $this->hapusNamaBarang = $item->nama_barang;
        $this->modalHapus      = true;
    }

    public function tutupModal(): void
    {
        $this->modalHapus    = false;
        $this->modalBulkHapus = false;
        $this->hapusId       = null;
        $this->hapusNamaBarang = '';
    }

    // ──────────────────────────────────────────
    // FITUR BARU: Buka modal bulk delete
    // ──────────────────────────────────────────
    public function confirmBulkDelete(): void
    {
        if (empty($this->selectedIds)) return;
        $this->modalBulkHapus = true;
    }

    protected function rules(): array
    {
        return [
            'kode_barang' => 'required|string|max:50|unique:items,kode_barang,' . ($this->editId ?? 'NULL'),
            'nama_barang' => 'required|string|max:100',
            'merk'        => 'required|string|max:100',
            'stok'        => 'required|integer|min:0',
            'kondisi'     => 'required|in:Bagus,Rusak,Diperbaiki',
            'lokasi'      => 'required|string|max:100',
            'deskripsi'   => 'nullable|string',
            'category_id' => 'required|integer|exists:categories,id',
            'photo'       => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp',
        ];
    }

    public function save(): void
    {
        $validated = $this->validate();
        unset($validated['photo']);

        $imageData = $this->uploadImageIfExists(
            oldPath: $this->isEditing ? items::find($this->editId)?->imagekit_file_id : null,
            folder: 'asset/barang-it',
            namaBarang: $this->nama_barang,
            kodeBarang: $this->kode_barang
        );

        $validated['image_url']        = $imageData['image_url'];
        $validated['imagekit_file_id'] = $imageData['imagekit_file_id'];

        if ($this->isEditing) {
            items::findOrFail($this->editId)->update($validated);
            $this->dispatch('notify', msg: 'Barang berhasil diperbarui!', type: 'success');
        } else {
            $item = items::create($validated);
            if ($item->stok > 0) {
                \App\Models\transactions::create([
                    'item_id'           => $item->id,
                    'user_id'           => auth()->id(),
                    'type'              => 'masuk',
                    'quantity'          => $item->stok,
                    'tanggal_transaksi' => now()->toDateString(),
                    'keterangan'        => 'Stok awal',
                ]);
            }
            $this->dispatch('notify', msg: 'Barang baru berhasil ditambahkan!', type: 'success');
        }

        $this->showModal = false;
        $this->reset([
            'editId',
            'kode_barang',
            'nama_barang',
            'merk',
            'stok',
            'kondisi',
            'lokasi',
            'deskripsi',
            'category_id',
            'photo',
            'image_url',
            'imagekit_file_id',
        ]);
    }

    // ──────────────────────────────────────────
    // FITUR BARU: Hapus single via modal
    // ──────────────────────────────────────────
    public function hapus(): void
    {
        if (! $this->hapusId) return;

        $item = items::withCount(['activeLoans', 'transactions'])->findOrFail($this->hapusId);

        if ($item->active_loads_count > 0) {
            $this->dispatch('notify', msg: 'Gagal! Barang masih memiliki peminjaman aktif.', type: 'error');
            $this->tutupModal();
            return;
        }

        $item->loans()->delete();
        $item->transactions()->delete();

        if ($item->imagekit_file_id) {
            $this->deleteImageFromImageKit($item->imagekit_file_id);
        }

        $item->delete();

        $this->tutupModal();
        $this->dispatch('notify', msg: 'Barang dan riwayat transaksi berhasil dihapus.', type: 'warning');
    }

    // ──────────────────────────────────────────
    // FITUR BARU: Hapus multiple
    // ──────────────────────────────────────────
    public function hapusBulk(): void
    {
        if (empty($this->selectedIds)) return;

        $items = items::withCount(['activeLoans'])
            ->whereIn('id', $this->selectedIds)
            ->get();

        $gagal  = 0;
        $sukses = 0;

        foreach ($items as $item) {
            if ($item->active_loads_count > 0) {
                $gagal++;
                continue;
            }

            $item->loans()->delete();
            $item->transactions()->delete();

            if ($item->imagekit_file_id) {
                $this->deleteImageFromImageKit($item->imagekit_file_id);
            }

            $item->delete();
            $sukses++;
        }

        $this->selectedIds  = [];
        $this->selectAll    = false;
        $this->modalBulkHapus = false;

        if ($sukses > 0 && $gagal === 0) {
            $this->dispatch('notify', msg: "{$sukses} barang berhasil dihapus.", type: 'warning');
        } elseif ($sukses > 0 && $gagal > 0) {
            $this->dispatch('notify', msg: "{$sukses} dihapus, {$gagal} gagal (ada peminjaman aktif).", type: 'warning');
        } else {
            $this->dispatch('notify', msg: 'Semua item gagal dihapus karena ada peminjaman aktif.', type: 'error');
        }
    }

    public function render()
    {
        $itCategoryId = category::where('name', $this->categoryName)->value('id');

        $items = items::with('category')
            ->where('category_id', $itCategoryId)
            ->when($this->search, fn($q) =>
            $q->where('nama_barang', 'like', "%{$this->search}%")
                ->orWhere('kode_barang', 'like', "%{$this->search}%"))
            ->when($this->kategori, fn($q) =>
            $q->where('category_id', $this->kategori))
            ->paginate(10);

        return view('pages::barang-it.barang-it', ['items' => $items]);
    }
};
