<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mountain extends Model
{
    use HasFactory;

    protected $table = 'mountains';

    protected $fillable = [
        'name',
        'location',
        'altitude',
        'status',
        'type',
        'lat',
        'lng',
        'desc',
        'img',
    ];

    //  Accessor untuk mengubah format URL gambar
    protected function img(): Attribute
    {
        return Attribute::make(
            get: fn($img) => asset('/storage/mountains/' . $img),
        );
    }

    public function hiking_route()
    {
        return $this->hasMany(HikingRoute::class, 'mountain_id', 'id');
    }
}
