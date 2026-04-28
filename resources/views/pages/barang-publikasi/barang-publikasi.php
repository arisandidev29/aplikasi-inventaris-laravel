<?php

use App\Models\category;
use App\Models\items;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
 use WithPagination;

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

    // Reset pagination saat search/filter berubah
    public function updatingSearch(): void    { $this->resetPage(); }
    public function updatingKategori(): void  { $this->resetPage(); }

    #[Computed]
    public function kategoris()
    {
        return category::all();
    }

    protected string $categoryName = 'Barang Publikasi'; // ganti ke 'Barang IT' untuk BarangIt.php

    public function openCreate(): void
    {
        $this->reset(['editId','kode_barang','nama_barang','merk',
                      'stok','kondisi','lokasi','deskripsi']);
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
        ];
    }


    public function save(): void
    {
        $validated = $this->validate();

        if ($this->isEditing) {
            items::findOrFail($this->editId)->update($validated);
        } else {
            items::create($validated);
        }

        $this->showModal = false;
        $this->reset(['editId','kode_barang','nama_barang','merk',
                      'stok','kondisi','lokasi','deskripsi','category_id']);
    }

    public function delete(int $id): void
    {
        items::findOrFail($id)->delete(); // SoftDelete
    }

    public function render()
    {
        $itCategoryId = category::where('name', $this->categoryName)->value('id');

        $items = items::with('category')
            ->where('category_id', $itCategoryId)
            ->when($this->search, fn ($q) =>
                $q->where('nama_barang', 'like', "%{$this->search}%")
                  ->orWhere('kode_barang', 'like', "%{$this->search}%")
            )
            ->when($this->kategori, fn ($q) =>
                $q->where('category_id', $this->kategori)
            )
            ->paginate(10);

        return view('pages::barang-publikasi.barang-publikasi', ['items' => $items]);
    }
};
