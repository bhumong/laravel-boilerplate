<?php

namespace Modules\Admin\Http\Resources\Json;

use App\Models\Permission;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    /** @var Permission */
    public $resource;

    public function toArray($request)
    {
        return [
            'permission' => e($this->resource->permission),
            'is_active' => $this->resource->is_active ? 'Active' : 'Inactive',
            'created_at' => $this->resource->created_at->format('Yd/m/y H:i'),
            'action' => '<a href="' . route('admin/permissions/edit', ['permission' => $this->resource->id]) . '">
                           <span class="badge badge-primary">View</span>
                        </a>'
        ];
    }
}
