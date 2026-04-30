<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class items extends Model
{
    //
    protected $fillable = [
        'category_id',
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
    ];

    // Barang terikat pada satu kategori
    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class);
    }

    // Barang memiliki banyak riwayat transaksi
    public function transactions(): HasMany
    {
        return $this->hasMany(transactions::class, 'item_id');
    }

    // Barang memiliki banyak riwayat peminjaman
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class, 'item_id');
    }

    public function activeLoans(): HasMany
    {
        // Sesuaikan 'Dipinjam' dengan status yang Anda gunakan di database
        return $this->hasMany(Loan::class, 'item_id')->where('status', 'Dipinjam');
    }
}
