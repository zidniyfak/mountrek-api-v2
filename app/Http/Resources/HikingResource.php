<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class HikingResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'start_date' => Carbon::parse($this->start_date)->format('d-m-Y'),
            'end_date' => Carbon::parse($this->end_date)->format('d-m-Y'),
            'numb_of_teams' => $this->numb_of_teams,
            'desc' => $this->desc,
            'status' => $this->status,
            'duration' => $this->duration,
            'hiking_route' => [
                'id' => $this->hiking_route->id,
                'name' => $this->hiking_route->name,
                'img' => $this->hiking_route->img,
                'location' => $this->hiking_route->location,
                'lat' => $this->hiking_route->lat,
                'lng' => $this->hiking_route->lng,
                'file' => $this->hiking_route->file,
            ],
            'mountain' => [
                'id' => $this->hiking_route->mountain->id,
                'name' => $this->hiking_route->mountain->name,
                'img' => $this->hiking_route->mountain->img,
            ]
        ];
    }
}
