<?php

namespace Modules\Admin\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'bio' => $this->bio,
            'summary' => $this->summary,
            'avatar' => $this->avatar,
            'website' => $this->website,
            'youtube' => $this->youtube,
            'instagram' => $this->instagram,
            'twitter' => $this->twitter,
            'facebook' => $this->facebook,
            'linkedin' => $this->linkedin,
            'status' => $this->status,

            // includes (only when loaded)
            'location' => $this->whenLoaded('location'),
            'medias' => $this->whenLoaded('medias'),
            'wallet' => $this->whenLoaded('wallet'),
            'video_links' => $this->whenLoaded('videoLinks'),
            'assets' => $this->whenLoaded('assets'),

            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
