<?php

namespace App\Livewire\Concerns;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

trait HasImageUpload
{
    use WithFileUploads;

    public function uploadImageIfExists(?string $oldPath = null, string $folder = 'inventaris', string $namaBarang = '', string $kodeBarang = ''): array
    {
        // 1. Jika tidak ada file baru yang diupload, gunakan data lama[cite: 4]
        if (! $this->photo) {
            return [
                'image_url'        => $this->image_url ?? null,
                'imagekit_file_id' => $this->imagekit_file_id ?? null,
            ];
        }

        // 2. Hapus file lama di ImageKit jika ada[cite: 4]
        if ($oldPath) {
            Storage::disk('imagekit')->delete($oldPath);
        }

        // 3. Buat nama file yang bersih[cite: 4]
        $fileName = time() . '_' . str()->slug($namaBarang . '-' . $kodeBarang) . '.' . $this->photo->getClientOriginalExtension();

        // 4. Upload menggunakan Laravel Storage (Adapter akan menangani semuanya)
        $path = Storage::disk('imagekit')->putFileAs($folder, $this->photo, $fileName);

        return [
            'image_url'        => Storage::disk('imagekit')->url($path),
            'imagekit_file_id' => $path, // Simpan path sebagai ID untuk keperluan delete nanti
        ];
    }
    // Fungsi baru untuk hapus gambar saja
    public function deleteImageFromImageKit(?string $path): void
    {
        if ($path) {
            Storage::disk('imagekit')->delete($path);
        }
    }
}
