<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaFullUrlResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->uuid,
            'original_url' => $this->getUrl(),
            'xs_url' => $this->getUrl('xs'),
            'sm_url' => $this->getUrl('sm'),
            'md_url' => $this->getUrl('md'),
            'lg_url' => $this->getUrl('lg'),
            'xl_url' => $this->getUrl('xl')
        ];
    }
}
