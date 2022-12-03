<?php

namespace Modules\Admin\Http\Resources\Json;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Admin\Entities\User;

class UserResource extends JsonResource
{
    /** @var User */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => e($this->resource->name),
            'email' => $this->resource->email,
            'role' => $this->resource->role->title ?? '-',
            'view' => '<a href="#" class="invoice-action-view mr-4">
                           View
                        </a>'
        ];
    }
}
