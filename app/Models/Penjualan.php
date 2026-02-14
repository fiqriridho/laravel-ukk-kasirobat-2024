<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Penjualan extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'pelanggan_id',
        'pembayaran_id',
        'obat_id',
        'user_id',
        'tanggal',
        'jumlah',
        'total',
    ];

    public function pelanggan(): HasOne
    {
        return $this->HasOne(Pelanggan::class, 'id', 'pelanggan_id');
    }
    public function pembayaran(): BelongsTo
    {
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id');
    }

    public function obat(): BelongsTo
    {
        return $this->belongsTo(Obat::class, 'obat_id', 'id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(user::class, 'id', 'user_id');
    }
}
