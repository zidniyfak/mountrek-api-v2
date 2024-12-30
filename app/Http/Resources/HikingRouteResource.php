<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HikingRouteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'difficulty' => $this->difficulty,
            'location' => $this->location,
            'distance' => "$this->distance Km",
            'duration' => "$this->duration Jam",
            'operating_hours' => $this->operating_hours,
            'numb_of_posts' => $this->numb_of_posts,
            'contact' => $this->contact,
            'fee' => $this->fee,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'img' => $this->img,
            'file' => $this->file,
            'rules' => $this->rules,
            'mountain' => [
                'id' => $this->mountain->id,
                'name' => $this->mountain->name,
            ]
        ];
    }
}
