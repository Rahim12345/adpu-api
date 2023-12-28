<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class HomeSpecialProgramsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            $this->collection->transform(function ($special_program){
                return new HomeSpecialProgramsResource($special_program);
            })
        ];
    }
}
