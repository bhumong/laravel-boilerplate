<?php

namespace Tests\Unit;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Str;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_users()
    {
        $this->markTestSkipped();
        $roleId = Str::uuid()->toString();
        $role = Role::factory()->create([
            'id' => $roleId
        ]);
        User::factory()->create([
            'role_id' => $roleId
        ]);
        $this->assertEquals($roleId, $role->users->first()->role_id);
    }

    public function test_permissions()
    {
        $roleId = Str::uuid()->toString();
        $permissionId = Str::uuid()->toString();

        $role = Role::factory()->create([
            'id' => $roleId
        ]);
        Permission::factory()->create([
            'id' => $permissionId
        ]);

        DB::table('role_permission')->insert([
            'role_id' => $roleId,
            'permission_id' => $permissionId
        ]);

        $this->assertEquals($permissionId, $role->permissions->first()->id);
    }
}
