<div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu">
                        <a href="{{ route('dashboard') }}" data-active="<?php if(request()->is('admin/dashboard')) echo 'true'; else echo 'false'; ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="#user" data-active="<?php if(request()->is('admin/users') || request()->is('admin/users/*')) echo 'true'; else echo 'false'; ?>" data-toggle="collapse" aria-expanded="<?php if(request()->is('admin/users') || request()->is('admin/users/*')) echo 'true'; else echo 'false'; ?>"
                            class="dropdown-toggle">
                            <div class="">
                                <i class="fas fa-user-secret"></i>
                                <span>{{ __('Admins') }}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled <?php if(request()->is('admin/users') || request()->is('admin/users/*')) echo 'show'; ?>" id="user" data-parent="#accordionExample">
                            <li class="<?php if(request()->is('admin/users/create')) echo 'active'; ?>">
                                <a href="{{ route('admin.users.create') }}"> {{ __('New Admin') }} </a>
                            </li>
                            <li class="<?php if(request()->is('admin/users')) echo 'active'; ?>">
                                <a href="{{ route('admin.users.index') }}"> {{ __('All Admin') }} </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu">
                        <a href="#building" data-active="<?php if(request()->is('admin/buildings') || request()->is('admin/buildings/*')) echo 'true'; else echo 'false'; ?>" data-toggle="collapse" aria-expanded="<?php if(request()->is('admin/buildings') || request()->is('admin/buildings/*')) echo 'true'; else echo 'false'; ?>"
                            class="dropdown-toggle">
                            <div class="">
                                <i class="fas fa-warehouse"></i>
                                <span>{{ __('Buildings') }}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled <?php if(request()->is('admin/buildings') || request()->is('admin/buildings/*')) echo 'show'; ?>" id="building" data-parent="#accordionExample">
                            <li class="<?php if(request()->is('admin/buildings/create')) echo 'active'; ?>">
                                <a href="{{ route('admin.buildings.create') }}"> {{ __('New Building') }} </a>
                            </li>
                            <li class="<?php if(request()->is('admin/buildings')) echo 'active'; ?>">
                                <a href="{{ route('admin.buildings.index') }}"> {{ __('All Building') }} </a>
                            </li>
                        </ul>
                    </li>

                </ul>
                <!-- <div class="shadow-bottom"></div> -->

            </nav>

        </div>