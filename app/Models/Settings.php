<?php

namespace App\Models;

use App\Traits\DefaultLogo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Settings extends Model
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
        'favicon_url',
    ];
}
