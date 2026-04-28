<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $fillable = [
        'item_id', 'nama_peminjam', 'jumlah', 
        'tanggal_pinjam', 'tanggal_kembali_rencana', 
        'tanggal_kembali_realisasi', 'status'
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(items::class);
    }
}
