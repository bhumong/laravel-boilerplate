<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin/dashboard') }}" class="brand-link">
        <img src="https://avatars.githubusercontent.com/u/25484023?s=96&v=4" alt="Admin Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://avatars.githubusercontent.com/u/25484023?s=96&v=4" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="bi bi-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @foreach ($menus as $menu)
                    <?php
                        $canAccessMenu = $menu['canAccess'] ?? false;
                        $accessibleChildren = array_filter($menu['items'] ?? [], function ($subMenu) {
                            return $subMenu['canAccess'] ?? false;
                        });
                        $hasAccessibleChildren = count($accessibleChildren) > 0;
                    ?>
                    @if (!$canAccessMenu || (!empty($menu['items']) && !$hasAccessibleChildren))
                        @continue
                    @endif
                    <?php
                        $hasActiveChild = empty($accessibleChildren) ? false : count(array_filter(array_column($accessibleChildren, 'isActive'))) > 0;
                        $upperMenuClassess = [];
                        $aClasses = [];
                        if($hasActiveChild) {
                            $upperMenuClassess[] = 'active';
                        }
                        if($menu['isActive']) {
                            $aClasses[] = 'active';
                        }
                    ?>
                    @if (!empty($menu['isHeader']))
                        <li class="nav-header">{{ $menu['name'] }}</li>
                    @else
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ implode(' ', $upperMenuClassess) }}">
                                <i class="nav-icon {{ $menu['icon'] }}"></i>
                                <p>
                                    {{ $menu['name'] }}
                                    @if (!empty($hasAccessibleChildren))
                                        <i class="bi bi-caret-left right"></i>
                                    @endif
                                </p>
                            </a>
                            @if (!empty($hasAccessibleChildren))
                                <ul class="nav nav-treeview">
                                    @foreach ($menu['items'] as $item)
                                        <li class="nav-item">
                                            <a href="{{ $item['href'] }}" class="nav-link {{ implode(' ', $upperMenuClassess) }}">
                                                <i class="{{ $item['icon'] }} nav-icon"></i>
                                                <p>{{ $item['name'] }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>