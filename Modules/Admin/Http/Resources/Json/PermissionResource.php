<?php

namespace Modules\Admin\Http\Resources\Json;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    /** @var Permission */
    public $resource;

    public function toArray($request)
    {
        return [
            'permission' => e($this->resource->permission),
            'roles' => $this->resource->roles->isNotEmpty() ?
                $this->resource->roles->map(function (Role $role) {
                    return $role->title;
                })->flatten()->implode(', ') :
                '-',
            'is_active' => $this->resource->is_active ? 'Active' : 'Inactive',
            'created_at' => $this->resource->created_at->format('d/m/Y H:i'),
            'action' => '<a href="' . route('admin/permissions/show', ['permission' => $this->resource->id]) . '">
                           <span class="badge badge-primary">View</span>
                        </a>'
        ];
    }
}
