<?php

namespace Modules\Admin\Utilities\DataObject;

use App\Utilities\DataStructure;

class Menu extends DataStructure
{
    /** @var string */
    public $name;

    /** @var bool */
    public $isActive = false;

    /** @var string */
    public $href = "";

    /** @var string */
    public $icon = "";

    /** @var Menu[]|null */
    public $items = null;

    /** @var bool */
    public $canAccess = true;

    /** @var bool */
    public $isHeader = false;

    public function getActiveClass()
    {
        return $this->isActive ? "active" : "";
    }
}
