<?php

namespace Modules\Admin\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'status' => $this->status,

            'parent_id' => $this->parent_id,

            'parent' => $this->whenLoaded('parent', fn () => [
                'id' => $this->parent?->id,
                'title' => $this->parent?->title,
                'slug' => $this->parent?->slug,
            ]),

            'children' => CategoryResource::collection($this->whenLoaded('children')),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
