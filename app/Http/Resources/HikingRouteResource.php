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
            'img' => $this->img,
            'status' => $this->status,
            'difficulty' => $this->difficulty,
            'location' => $this->location,
            'distance' => $this->distance,
            'duration' => $this->duration,
            'elevation_gain' => $this->elevation_gain,
            'operating_hours' => $this->operating_hours,
            'numb_of_posts' => $this->numb_of_posts,
            'contact' => $this->contact,
            'fee' => $this->fee,
            'file' => $this->file,
            'link' => $this->link,
            'rules' => $this->rules,
        ];
    }
}
