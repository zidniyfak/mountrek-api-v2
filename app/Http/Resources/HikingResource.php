<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HikingResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'numb_of_teams' => $this->numb_of_teams,
            'notes' => $this->notes,
            'status' => $this->status,
            'duration' => $this->duration,
            'hiking_route' => [
                'id' => $this->hiking_route->id,
                'name' => $this->hiking_route->name,
                'img' => $this->hiking_route->img,
            ],
            'mountain' => [
                'id' => $this->hiking_route->mountain->id,
                'name' => $this->hiking_route->mountain->name,
                'img' => $this->hiking_route->mountain->img,
            ]
        ];
    }
}
