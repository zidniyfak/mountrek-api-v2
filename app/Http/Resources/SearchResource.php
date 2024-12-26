<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'img' => $this->img,
            'height' => $this->height,
            'location' => $this->location,
            'description' => $this->description,
            'difficulty' => $this->difficulty,
            'duration' => $this->duration,
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
