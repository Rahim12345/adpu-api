<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeAboutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title_1'=>$this->title_1,
            'title_2'=>$this->title_2,
            'intro_text'=>$this->intro_text,
            'src'=>asset($this->src),
            'alt'=>$this->alt,
            'icon'=>$this->icon,
        ];
    }
}
