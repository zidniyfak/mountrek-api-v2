<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hiking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'hiking_route_id',
        'start_date',
        'end_date',
        'numb_of_teams',
        'notes',
        'status',
        'duration'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mountain()
    {
        return $this->belongsTo(Mountain::class);
    }
    public function hikingroute()
    {
        return $this->belongsTo(HikingRoute::class);
    }
}
