<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MountainResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        //         'name',
        // 'location',
        // 'altitude',
        // 'status',
        // 'type',
        // 'lat',
        // 'long',
        // 'desc',
        // 'img',
        return [
            'id' => $this->id,
            'name' => $this->name,
            'altitude' => $this->altitude,
            'location' => $this->location,
            'status' => $this->status,
            'type' => $this->type,
            'lat' => $this->lat,
            'long' => $this->long,
            'img' => $this->img,
            'description' => $this->desc,
            'hiking_routes' => $this->hiking_route->map(function ($route) {
                return [
                    'id' => $route->id,
                    'name' => $route->name,
                    'img' => $route->img,
                ];
            }),
        ];
    }
}
