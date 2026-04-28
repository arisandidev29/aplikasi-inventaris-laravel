<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class items extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'kode_barang', 'nama_barang', 
        'merk', 'stok', 'kondisi', 'lokasi', 'deskripsi'
    ];

    // Barang terikat pada satu kategori
    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class);
    }

    // Barang memiliki banyak riwayat transaksi
    public function transactions(): HasMany
    {
        return $this->hasMany(transactions::class);
    }

    // Barang memiliki banyak riwayat peminjaman
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
