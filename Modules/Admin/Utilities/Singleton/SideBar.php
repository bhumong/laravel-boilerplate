<?php

namespace Modules\Admin\Utilities\Singleton;

use Cache;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Redis;
use Modules\Admin\Utilities\DataObject\Menu;

class SideBar implements Arrayable
{
    protected $sideNav = null;

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
                            'icon' => 'bi bi-person-circle'
                        ]),
                    ]),
                ]),
            ])->toArray();
    }
}
