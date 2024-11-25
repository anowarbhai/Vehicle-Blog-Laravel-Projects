<!-- ======================= Header Start  ============================ -->
<header class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg p-0">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{getSiteSettings()->logo}}" class="img-fluid" alt="Blog">
                    </a>
                    <div class="d-flex align-items-center d-block d-lg-none">
                        <div class="me-2">
                            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#mobilemenuOffcanvas" aria-controls="mobilemenuOffcanvas">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto d-flex align-items-center">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('/') ? 'active' : '' }}" href="{{url('/')}}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('blogs.index') ? 'active' : '' }}" href="{{ route('blogs.index') }}">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('pages.contact') ? 'active' : '' }}" href="{{ route('pages.contact') }}">Contact</a>
                            </li>
                            <li class="nav-item">
                                <!-- Search Form -->
                                <form class="d-flex" action="{{ route('search') }}" method="GET">
                                    <input class="form-control me-2" type="search" value="{{ request('query') }}" placeholder="Search" aria-label="Search" name="query">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            

            <!-- mobile menu -->
            <div class="mobile_menu offcanvas offcanvas-start d-block d-lg-none" tabindex="-1" id="mobilemenuOffcanvas"
                aria-labelledby="mobilemenuOffcanvasLabel">
                <div class="offcanvas-header">
                    <div class="offcanvas-title" id="mobilemenuOffcanvasLabel">
                        <img src="assets/images/logo2.png" width="120" class="img-fluid" alt="Blog">
                    </div>
                    <button type="button" class="btn-close shadow-none opacity-100" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{url('/')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('blogs.index')}}">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('pages.contact')}}">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- ======================= Header End  ============================ -->