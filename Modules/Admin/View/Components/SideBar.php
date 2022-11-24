<?php

namespace Modules\Admin\View\Components;

use App\Utilities\Sidenav as SidenavData;
use Illuminate\View\Component;

class SideBar extends Component
{
    public $menus = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->menus = $this->generateMenus();
        return view('admin::components.sidebar');
    }

    public function generateMenus()
    {
        return collect([
            new SidenavData([
                'name' => 'Menu',
                'isHeader' => true,
            ]),
            new SidenavData([
                'name' => 'Dashboard',
                'isActive' => url()->current() === route('admin/dashboard'),
                'href' => route('admin/dashboard'),
                'icon' => 'bi bi-layout-sidebar-inset'
            ]),
            new SidenavData([
                'name' => 'User Management',
                'icon' => 'bi bi-people',
                'items' => collect([
                    new SidenavData([
                        'name' => 'User',
                        'isActive' => url()->current() === route('admin/dashboard'),
                        'href' => route('admin/dashboard'),
                        'icon' => 'bi bi-person-circle'
                    ]),
                ])->toArray(),
            ]),
        ])->toArray();
    }
}
