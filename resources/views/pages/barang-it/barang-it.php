<?php

use App\Livewire\Concerns\HasImageUpload;
use App\Models\category;
use App\Models\items;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;
    use HasImageUpload;

    public string $search     = '';
    public string $kategori   = '';
    public bool   $showModal  = false;
    public bool   $isEditing  = false;

    // Form fields
    public ?int   $editId     = null;
    public string $kode_barang  = '';
    public string $nama_barang  = '';
    public string $merk         = '';
    public int    $stok         = 0;
    public string $kondisi      = 'Bagus';
    public string $lokasi       = '';
    public string $deskripsi    = '';
    public ?int   $category_id  = null;

    // image
    public $photo            = null;   // temporary upload Livewire
    public ?string $image_url         = null;
    public ?string $imagekit_file_id  = null;


    // Reset pagination saat search/filter berubah
    public function updatingSearch(): void
    {
        $this->resetPage();
    }
    public function updatingKategori(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function kategoris()
    {
        return category::all();
    }

    protected string $categoryName = 'Barang IT'; // ganti ke 'Barang IT' untuk BarangIt.php

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
            'imagekit_file_id'
        ]);
        $this->category_id = category::where('name', $this->categoryName)->value('id');
        $this->isEditing   = false;
        $this->showModal   = true;
    }

    public function openEdit(int $id): void
    {
        $item = items::findOrFail($id);
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

        $this->image_url = $item->image_url;        // <-- tambahkan ini
        $this->imagekit_file_id   = $item->imagekit_file_id; // <-- tambahkan ini
        $this->photo              = null;
        $this->showModal   = true;
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
            'photo' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp'
        ];
    }


    public function save(): void
    {
        $validated = $this->validate();



        unset($validated['photo']);


        $oldItem = $this->isEditing ? items::find($this->editId) : null;

        // TAMBAH: proses upload gambar
        $imageData = $this->uploadImageIfExists(
            oldPath: $this->isEditing
                ? items::find($this->editId)?->imagekit_file_id
                : null,
            folder: 'asset/barang-it',
            namaBarang: $this->nama_barang,
            kodeBarang: $this->kode_barang
        );

        // TAMBAH: merge image data ke validated
        $validated['image_url']        = $imageData['image_url'];
        $validated['imagekit_file_id'] = $imageData['imagekit_file_id'];


        if ($this->isEditing) {
            items::findOrFail($this->editId)->update($validated);
            $this->dispatch('notify', msg: 'Barang berhasil diperbarui!', type: 'success');
        } else {
            // items::create($validated);
            // $this->dispatch('notify', msg: 'Barang berhasil Edit!', type: 'success');

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
            'imagekit_file_id'
        ]);
    }

    // public function delete(int $id): void
    // {
    //     items::findOrFail($id)->delete(); // SoftDelete
    //     $this->dispatch('notify', msg: 'Barang berhasil dihapus.', type: 'warning');
    // }

    public function delete(int $id): void
    {
        $item = items::withCount(['activeLoans', 'transactions'])->findOrFail($id);

        // 1. Cek apakah ada data peminjaman
        if ($item->active_loads_count > 0) {
            $this->dispatch(
                'notify',
                msg: 'Gagal! Barang tidak bisa dihapus karena masih memiliki riwayat peminjaman.',
                type: 'error'
            );
            return;
        }

        $item->loans()->delete();
        $item->transactions()->delete();

        // 3. Hapus gambar dari ImageKit sebelum data DB dihapus
        if ($item->imagekit_file_id) {
            $this->deleteImageFromImageKit($item->imagekit_file_id);
        }

        // 4. Hapus data barang secara permanen (karena Soft Delete sudah dimatikan)
        $item->delete();

        $this->dispatch('notify', msg: 'Barang dan riwayat transaksi berhasil dihapus permanen.', type: 'warning');
    }

    public function render()
    {
        $itCategoryId = category::where('name', $this->categoryName)->value('id');

        $items = items::with('category')
            ->where('category_id', $itCategoryId)
            ->when(
                $this->search,
                fn($q) =>
                $q->where('nama_barang', 'like', "%{$this->search}%")
                    ->orWhere('kode_barang', 'like', "%{$this->search}%")
            )
            ->when(
                $this->kategori,
                fn($q) =>
                $q->where('category_id', $this->kategori)
            )
            ->paginate(10);

        return view('pages::barang-it.barang-it', ['items' => $items]);
    }
};
