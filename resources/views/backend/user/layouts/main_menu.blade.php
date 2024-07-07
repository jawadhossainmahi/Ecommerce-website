<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template/index.html">
                <img class="img-fluid" id="menu_image"  src="{{ asset('app-assets/images/logo/livshem9.png') }}" height="40px" width="150px" alt="...">
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
            <li class="nav-item {{ (request()->routeIs('dashboard')) ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="menu-livicon" data-icon="desktop"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span></a>
            </li>
            <li class=" navigation-header text-truncate"><span data-i18n="Apps">Apps</span>
            </li>
            {{-- <li class=" nav-item"><a href="app-email.html"><i class="menu-livicon" data-icon="envelope-pull"></i><span class="menu-title text-truncate" data-i18n="Email">Email</span></a>
            </li> --}}
           
        </ul>
    </div>
</div>