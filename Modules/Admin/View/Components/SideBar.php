<?php

namespace Modules\Admin\View\Components;

use Illuminate\View\Component;
use Modules\Admin\Utilities\Singleton\SideBar as SingletonSideBar;

class SideBar extends Component
{
    public $menus = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(SingletonSideBar $sideBar)
    {
        $this->menus = $sideBar->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin::components.sidebar');
    }
}
