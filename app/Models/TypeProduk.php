<?php

namespace App\Models;

use App\Traits\DefaultLogo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeProduk extends Model
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
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_produk_id');
    }

    public function formatNameAndSlug()
    {
        $this->name = Str::ucfirst($this->name);
        $this->slug = Str::slug($this->name);
        return $this;
    }

    public function brands()
    {
        return $this->hasMany(BrandProduk::class, 'type_id', 'id');
    }
}
