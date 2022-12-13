<?php

namespace App\Models;

use App\Models\Traits\AutoGenerateUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
