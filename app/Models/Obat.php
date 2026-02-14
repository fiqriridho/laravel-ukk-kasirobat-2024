<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Obat extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'kategori_id',
        'nama_obat',
        'harga',
        'keterangan',
        'stok',
        'exp',
    ];

    public function kategori(): HasOne{
        return $this->hasOne(Kategori::class, 'id', 'kategori_id');
    }

    public function penjualan(): HasMany
    {
        return $this->hasMany(Penjualan::class, 'obat_id', 'id');
    }


}
