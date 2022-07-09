<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        return [
            'id' => $this->id,
            'image_name' => $this->image_name,
            'image_width' => $this->image_width,
            'image_height' => $this->image_height,
            'image_size' => $this->image_size,
            'image_extension' => $this->image_extension,
            'image_lat' => $this->image_lat,
            'image_long' => $this->image_long,
            'image' => $this->image,
            'user_name' => $this->user_name,
            'image_url' => $this->image_url,
        ];
    }
}
