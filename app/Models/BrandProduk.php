<?php

namespace App\Models;

use App\Traits\DefaultLogo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BrandProduk extends Model
{
    use HasFactory, DefaultLogo;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $appends = [
        'logo_url',
        'banner_url',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'brand_produk_id');
    }

    public function gameServer()
    {
        return $this->hasMany(GameServer::class, 'brand_id');
    }

    public function type()
    {
        return $this->belongsTo(TypeProduk::class, 'type_id');
    }
}
