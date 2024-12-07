<?php

namespace App\Http\Resources\Api\Destinations;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FindDestinationInRadiusResourceCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
