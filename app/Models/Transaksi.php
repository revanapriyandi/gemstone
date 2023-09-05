<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'transaksi_id', 'id');
    }
}
