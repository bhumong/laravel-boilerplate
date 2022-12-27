<?php

namespace Modules\Admin\Http\Resources\Json;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Admin\Entities\Role;

class RoleResource extends JsonResource
{
    /** @var Role */
    public $resource;

    public function toArray($request)
    {
        return [
            'title' => e($this->resource->title),
            'is_active' => $this->resource->is_active ? 'Active' : 'Inactive',
            'created_at' => $this->resource->created_at->format('Yd/m/y H:i'),
            'action' => '<a href="' . route('admin/roles/show', ['role' => $this->resource->id]) . '">
                           <span class="badge badge-primary">View</span>
                        </a>'
        ];
    }
}
