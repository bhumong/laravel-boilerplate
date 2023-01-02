<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    protected $relationsClass = [
        'role' => Role::class
    ];

    public function roles()
    {
        return $this->belongsToMany($this->relationsClass['role'] ?? Role::class, 'role_permission');
    }
}
