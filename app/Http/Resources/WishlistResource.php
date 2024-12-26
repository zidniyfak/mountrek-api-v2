<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WishlistResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'mountain_id' => $this->mountain_id,
            'mountain' => [
                'name' => $this->mountain->name,
                'img' => $this->mountain->img,
            ],
        ];
    }
}
