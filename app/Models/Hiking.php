<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hiking extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'mountains_id',
        'hiking_routes_id',
        'start_date',
        'end_date',
        'companions',
        'notes',
        'hiking_status',
        'duration'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function mountain()
    {
        return $this->belongsTo(Mountain::class, 'mountains_id', 'id');
    }
    public function hikingroute()
    {
        return $this->belongsTo(HikingRoute::class, 'hiking_routes_id', 'id');
    }
}
