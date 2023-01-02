<?php

namespace Modules\Admin\Utilities\Singleton;

use Auth;
use Illuminate\Contracts\Support\Arrayable;
use Modules\Admin\Entities\Permission;
use Modules\Admin\Entities\Role;
use Modules\Admin\Entities\User;
use Modules\Admin\Utilities\DataObject\Menu;

class SideBar implements Arrayable
{
    protected $sideNav = [];

    public function __construct()
    {
        $this->init();
    }

    public function toArray()
    {
        return $this->sideNav;
    }

    public function init()
    {
        $this->sideNav = collect([
            new Menu([
                'name' => 'Menu',
                'isHeader' => true,
            ]),
            new Menu([
                'name' => 'Dashboard',
                'isActive' => url()->current() === route('admin/dashboard'),
                'href' => route('admin/dashboard'),
                'icon' => 'bi bi-layout-sidebar-inset'
            ]),
            new Menu([
                'name' => 'User Management',
                'icon' => 'bi bi-people',
                'items' => collect([
                    new Menu([
                        'name' => 'User',
                        'isActive' => url()->current() === route('admin/users/index'),
                        'href' => route('admin/users/index'),
                        'icon' => 'bi bi-person-circle',
                        'canAccess' => Auth::user()->can('index', User::class),
                    ]),
                    new Menu([
                        'name' => 'Role',
                        'isActive' => url()->current() === route('admin/roles/index'),
                        'href' => route('admin/roles/index'),
                        'icon' => 'bi bi-people',
                        'canAccess' => Auth::user()->can('index', Role::class),
                    ]),
                    new Menu([
                        'name' => 'Permission',
                        'isActive' => url()->current() === route('admin/permissions/index'),
                        'href' => route('admin/permissions/index'),
                        'icon' => 'bi bi-layout-text-sidebar',
                        'canAccess' => Auth::user()->can('index', Permission::class),
                    ]),
                ]),
            ]),
        ])->toArray();
    }
}
