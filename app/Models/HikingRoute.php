<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HikingRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'mountains_id',
        'route_name',
        'status',
        'difficulty',
        'distance',
        'duration',
        'elevation_gain',
        'number_of_pos',
        'location',
        'img',
        'file',
        'links',
        'description',
    ];


    public function mountain()
    {
        return $this->belongsTo(Mountain::class, 'mountains_id', 'id');
    }
}
