<aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="{{route('admin.dashboard')}}" class="brand-link text-center">
                    <span class="brand-text font-weight-light"
                        >Blog CPanel</span
                    >
                </a>
                <div class="sidebar">
                    <nav class="mt-2">
                        <ul
                            class="nav nav-pills nav-sidebar flex-column"
                            data-widget="treeview"
                            role="menu"
                            data-accordion="false"
                        >
                            <li class="nav-item">
                                <a href="{{route('admin.dashboard')}}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('admin.blogs.index') ? 'menu-open' : '' }} {{ request()->routeIs('admin.blogs.create') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link">
                                    <i
                                        class="nav-icon fas fa-tachometer-alt"
                                    ></i>
                                    <p>
                                        Blog
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.blogs.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Post List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.blogs.create') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add New Post</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{ request()->routeIs('admin.category.index') ? 'menu-open' : '' }} {{ request()->routeIs('admin.category.create') ? 'menu-open' : '' }}">
                                <a href="{{ route('admin.category.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Category <i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a
                                            href="{{ route('admin.category.index') }}"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>Category List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            href="{{ route('admin.category.create') }}"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>Add Category</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.pages.contact')}}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>Contact</p>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('admin.pages.privacy') ? 'menu-open' : '' }} {{ request()->routeIs('admin.pages.terms') ? 'menu-open' : '' }}">
                                <a  href="{{ route('admin.pages.privacy') }}" class="nav-link">
                                    <i
                                        class="nav-icon fas fa-tachometer-alt"
                                    ></i>
                                    <p>
                                        Pages
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a
                                            href="{{ route('admin.pages.privacy') }}"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>Privacy Policy</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            href="{{ route('admin.pages.terms') }}"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>Terms & Conditions</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i
                                        class="nav-icon fas fa-tachometer-alt"
                                    ></i>
                                    <p>
                                        Role & Permissions
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a
                                            href="permission/index.html"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>Users Role</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            href="systemusers/index.html"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>System Users</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.settings.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Web Setting
                                        <span class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>