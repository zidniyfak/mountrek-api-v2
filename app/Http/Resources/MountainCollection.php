<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MountainCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'message' => 'List data mountain',
            'data' => $this->collection->map(function ($data) {
                return new MountainResource($data);
            })
        ];
    }
}
