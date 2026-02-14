<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pembayaran extends Model
{
    use HasFactory;

    protected  $fillable = ['nama_pembayaran'];

    public function penjualan(): HasMany
    {
        return $this->HasMany(Penjualan::class, 'id', 'nama_pembayaran');
    }
}
