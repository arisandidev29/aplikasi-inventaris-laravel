<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class transactions extends Model
{
    //
    protected $fillable = [
        'item_id', 'user_id', 'type', 
        'quantity', 'tanggal_transaksi', 'keterangan'
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(items::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
