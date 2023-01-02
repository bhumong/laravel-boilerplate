<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    protected $relationsClass = [
        'permission' => Permission::class,
        'user' => User::class,
    ];

    public function permissions()
    {
        return $this->belongsToMany($this->relationsClass['permission'] ?? Permission::class, 'role_permission');
    }

    public function users()
    {
        return $this->hasMany($this->relationsClass['user'] ?? User::class, 'role_id', 'id');
    }
}
