<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HikingRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'mountain_id',
        'name',
        'status',
        'difficulty',
        'location',
        'distance',
        'duration',
        'elevation_gain',
        'operating_hours',
        'number_of_posts',
        'contact',
        'fee',
        'img',
        'file',
        'link',
        'rules',
    ];


    public function mountain()
    {
        return $this->belongsTo(Mountain::class);
    }
}
