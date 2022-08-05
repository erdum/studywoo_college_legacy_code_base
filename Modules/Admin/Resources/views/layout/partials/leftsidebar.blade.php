



<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <!-- User box -->
        <div class="user-box text-center">
            <img src="" alt="user-img" title="Mat Helme"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-toggle="dropdown">Erdum</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user mr-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings mr-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock mr-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out mr-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                @foreach (Sidebar::get() as $route1)
                    @if (hasPermission($route1))
                        <li class="menu-title">{{ ucwords($route1['navigation']) }}</li>

                        @foreach ($route1['children'] as $route2)
                            @if (hasPermission($route2))
                                @if (array_key_exists('children', $route2))
                                    <li>
                                        <a href="#sidebar{{ Str::slug($route2['name']) }}" data-toggle="collapse">
                                            <i data-feather="{{ $route2['icon'] }}"></i>
                                            <span> {{ ucwords($route2['name']) }} </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="sidebar{{ Str::slug($route2['name']) }}">
                                            <ul class="nav-second-level">
                                                @foreach ($route2['children'] as $route3)
                                                @if (hasPermission($route3))
                                                    <li>
                                                        <a href="{{ route('admin.' . $route3['route']) }}"> <span>
                                                                {{ ucwords($route3['name']) }} </span></a>
                                                    </li>
                                                @endif
                                                @endforeach

                                            </ul>
                                        </div>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('admin.' . $route2['route']) }}">
                                            <i data-feather="{{ $route2['icon'] }}"></i>
                                            <span> {{ ucwords($route2['name']) }} </span>
                                        </a>
                                    </li>
                                @endif
                            @endif

                        @endforeach
                    @endif
                @endforeach
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
