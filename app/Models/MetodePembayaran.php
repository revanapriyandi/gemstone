<?php

namespace App\Models;

use App\Traits\DefaultLogo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory, DefaultLogo;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['logo_url'];
}
