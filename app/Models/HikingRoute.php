<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'operating_hours',
        'numb_of_posts',
        'contact',
        'fee',
        'img',
        'lat',
        'lng',
        'file',
        'rules',
    ];


    public function mountain()
    {
        return $this->belongsTo(Mountain::class);
    }

    public function hiking()
    {
        return $this->hasMany(Hiking::class, 'hiking_route_id', 'id');
    }

    protected function img(): Attribute
    {
        return Attribute::make(
            get: fn($img) => asset('/storage/hikingroutes/' . $img),
        );
    }

    protected function file(): Attribute
    {
        return Attribute::make(
            get: fn($file) => asset('/storage/gpx/' . $file),
        );
    }
}
