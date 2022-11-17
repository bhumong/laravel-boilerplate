<?php

namespace Tests\Unit;

use App\Models\Permission;
use App\Models\Role;
use DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Str;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_roles()
    {
        $roleId = Str::uuid()->toString();
        $permissionId = Str::uuid()->toString();

        Role::factory()->create([
            'id' => $roleId
        ]);
        $permission = Permission::factory()->create([
            'id' => $permissionId
        ]);

        DB::table('role_permission')->insert([
            'role_id' => $roleId,
            'permission_id' => $permissionId
        ]);

        $this->assertEquals($roleId, $permission->roles->first()->id);
    }
}
