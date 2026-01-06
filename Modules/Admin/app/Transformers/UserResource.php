<?php

namespace Modules\Admin\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'name' => $this->name ?? trim(($this->first_name ?? '').' '.($this->last_name ?? '')) ?: null,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'avatar_url' => $this->when(isset($this->avatar_url), $this->avatar_url),

            // وضعیت‌ها
            'status' => $this->status ?? null,
            'blocked' => (bool) ($this->blocked ?? false),
            'is_admin' => (bool) ($this->is_admin ?? false),
            'email_verified_at' => $this->email_verified_at,

            // زمان‌ها
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // نقش‌ها و دسترسی‌ها (فقط اگر include شده باشند)
            'roles' => $this->whenLoaded('roles', function () {
                return $this->roles->map(fn ($r) => [
                    'id' => $r->id,
                    'name' => $r->name,
                    'guard_name' => $r->guard_name,
                ])->values();
            }),

            'permissions' => $this->whenLoaded('permissions', function () {
                return $this->permissions->map(fn ($p) => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'guard_name' => $p->guard_name,
                ])->values();
            }),
        ];
    }
}
