<?php

namespace App\Models;

use App\Models\Traits\AutoGenerateUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }
}
