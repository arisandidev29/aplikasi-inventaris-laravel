<?php

use App\Models\category;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    //
        use WithPagination;
 
    // State untuk form
    public string $name = '';
    public ?int $editingId = null;
 
    // State untuk modal
    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public ?int $deletingId = null;
 
    // State untuk search & filter
    public string $search = '';
 
    // Reset pagination ketika search berubah
    public function updatingSearch(): void
    {
        $this->resetPage();
    }
 
    // Buka modal tambah
    public function openCreateModal(): void
    {
        $this->reset(['name', 'editingId']);
        $this->showModal = true;
    }
 
    // Buka modal edit
    public function openEditModal(int $id): void
    {
        $kategori = category::findOrFail($id);
        $this->editingId = $id;
        $this->name = $kategori->name;
        $this->showModal = true;
    }
 
    // Tutup modal
    public function closeModal(): void
    {
        $this->showModal = false;
        $this->reset(['name', 'editingId']);
        $this->resetValidation();
    }
 
    // Simpan (create atau update)
    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . ($this->editingId ?? 'NULL'),
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Nama kategori sudah ada.',
            'name.max'      => 'Nama kategori maksimal 100 karakter.',
        ]);
 
        if ($this->editingId) {
            category::findOrFail($this->editingId)->update(['name' => $this->name]);
            session()->flash('success', 'Kategori berhasil diperbarui.');
        } else {
            category::create(['name' => $this->name]);
            session()->flash('success', 'Kategori berhasil ditambahkan.');
        }
 
        $this->closeModal();
    }
 
    // Buka konfirmasi delete
    public function confirmDelete(int $id): void
    {
        $this->deletingId = $id;
        $this->showDeleteModal = true;
    }
 
    // Eksekusi delete
    public function delete(): void
    {
        $kategori = category::withCount('items')->findOrFail($this->deletingId);
 
        if ($kategori->items_count > 0) {
            session()->flash('error', 'Kategori tidak dapat dihapus karena masih memiliki ' . $kategori->items_count . ' barang.');
        } else {
            $kategori->delete();
            session()->flash('success', 'Kategori berhasil dihapus.');
        }
 
        $this->showDeleteModal = false;
        $this->deletingId = null;
    }
 
    public function render()
    {
        $kategori = category::withCount('items')
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate(9);
 
        $totalKategori = category::count();
        $totalItems    = \App\Models\items::count();
 
        return view('pages::kategori-barang.kategori-barang', compact('kategori', 'totalKategori', 'totalItems'));
    }

};
