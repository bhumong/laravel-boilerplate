<?php

namespace Tests\Feature\Unit\Models;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_role()
    {
        $roleId = Str::uuid()->toString();
        $role = Role::factory()->create([
            'id' => $roleId
        ]);
        $user = User::factory()->create([
            'role_id' => $roleId
        ]);
        $this->assertEquals($role->id, $user->role->id);
    }
}
