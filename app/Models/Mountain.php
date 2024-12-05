<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mountain extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'mountains_name',
        'region',
        'altitude',
        'mountains_status',
        'mountains_type',
        'latitude',
        'longitude',
        'description',
        'img',
    ];
}
