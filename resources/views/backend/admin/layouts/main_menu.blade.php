<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header" style="background: #077607;">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="/">
                    <img id="menu_image" class="img-fluid" src="{{ asset('app-assets/images/logo/livshem9.png') }}"
                        height="40px" width="150px" alt="...">
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i
                        class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block" data-ticon="bx-disc"
                        style="color: yellow;"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content" style="background: #060c00">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation"
            data-icon-style="lines" style="background: linear-gradient(177deg, #217601, #060c00);">
            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"><a
                    href="{{ route('dashboard') }}"><i class="menu-livicon" data-icon="desktop"></i><span
                        class="menu-title text-truncate" data-i18n="Dashboard">instrumentbräda</span></a>
            </li>
            <li class=" navigation-header text-truncate"><span data-i18n="Apps">Appar</span>
            <li class=" nav-item" style="background-color: #0f3d00; border-color: #fbff00;"><a href="#"><i
                        class="menu-livicon" data-icon="shoppingcart"></i><span class="menu-title text-truncate"
                        data-i18n="Products">Produkter Tab</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('admin.product.index') ? 'active' : '' }}"><a
                            class="d-flex align-items-center {{ request()->routeIs('admin.product.index') ? 'active' : '' }}"
                            href="{{ route('admin.product.index') }}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item text-truncate" data-i18n="Product"> Produkt</span></a>
                    </li>
                    <li class="{{ request()->routeIs('admin.category.index') ? 'active' : '' }}"><a
                            class="d-flex align-items-center {{ request()->routeIs('admin.category.index') ? 'active' : '' }}"
                            href="{{ route('admin.category.index') }}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item text-truncate" data-i18n="Product Categories">
                                produktkategori</span></a>
                    </li>
                    <li class="{{ request()->routeIs('admin.subcategory.index') ? 'active' : '' }}"><a
                            class="d-flex align-items-center {{ request()->routeIs('admin.subcategory.index') ? 'active' : '' }}"
                            href="{{ route('admin.subcategory.index') }}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item text-truncate" data-i18n="Product SubCategories">Produkt
                                underkategori</span></a>
                    </li>
                    <li class="{{ request()->routeIs('admin.subsubcat.index') ? 'active' : '' }}"><a
                            class="d-flex align-items-center {{ request()->routeIs('admin.subsubcat.index') ? 'active' : '' }}"
                            href="{{ route('admin.subsubcat.index') }}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item text-truncate" data-i18n="Product SubSubCategories">Produkt
                                Sub-Underkategori</span></a>
                    </li>
                    <li class="{{ request()->routeIs('admin.tag.index') ? 'active' : '' }}"><a
                            class="d-flex align-items-center {{ request()->routeIs('admin.tag.index') ? 'active' : '' }}"
                            href="{{ route('admin.tag.index') }}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item text-truncate" data-i18n="Product Tags">Produkttaggar</span></a>
                    <li class="{{ request()->routeIs('admin.productorigin.index') ? 'active' : '' }}"><a
                            class="d-flex align-items-center {{ request()->routeIs('admin.productorigin.index') ? 'active' : '' }}"
                            href="{{ route('admin.productorigin.index') }}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item text-truncate" data-i18n="Product Tags">Produktens ursprung</span></a>
                    </li>
                    <li class="{{ request()->routeIs('admin.trademark.index') ? 'active' : '' }}"><a
                            class="d-flex align-items-center {{ request()->routeIs('admin.trademark.index') ? 'active' : '' }}"
                            href="{{ route('admin.trademark.index') }}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item text-truncate"
                                data-i18n="Product Trademark">Produktvarumärken</span></a>
                    </li>
                    <li class="{{ request()->routeIs('admin.diet.index') ? 'active' : '' }}"><a
                            class="d-flex align-items-center {{ request()->routeIs('admin.diet.index') ? 'active' : '' }}"
                            href="{{ route('admin.diet.index') }}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item text-truncate" data-i18n="Product Diets">Produktdiet</span></a>
                    </li>
                    {{-- <li class="{{ (request()->routeIs('admin.review.index')) ? 'active' : '' }}"><a class="d-flex align-items-center {{ (request()->routeIs('admin.review.index')) ? 'active' : '' }}" href="{{ route('admin.review.index') }}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Product Reviews">Produktrecensioner</span></a>
                    </li> --}}
                </ul>
            </li>
            <li class=" nav-item {{ request()->routeIs('admin.postcode.index') ? 'active' : '' }}"><a
                    href="{{ route('admin.postcode.index') }}"><i class="menu-livicon" data-icon="minus-alt"></i><span
                        class="menu-title text-truncate" data-i18n="Postcode">Privat postnummer</span></a>

            </li>
            <li class=" nav-item {{ request()->routeIs('admin.postcode.business') ? 'active' : '' }}"><a
                    href="{{ route('admin.postcode.business') }}"><i class="menu-livicon" data-icon="minus-alt"></i><span
                        class="menu-title text-truncate" data-i18n="Postcode">Företags postnummer</span></a>

            </li>
            <li class=" nav-item {{ request()->routeIs('admin.postnumber.index') ? 'active' : '' }}"><a
                    href="{{ route('admin.postnumber.index') }}"><i class="menu-livicon"
                        data-icon="minus-alt"></i><span class="menu-title text-truncate"
                        data-i18n="Postcode">Postrequest</span></a>

            </li>
            <li class=" nav-item {{ request()->routeIs('admin.deliverytime.index') ? 'active' : '' }}"><a
                    href="{{ route('admin.deliverytime.index') }}"><i class="menu-livicon"
                        data-icon="minus-alt"></i><span class="menu-title text-truncate"
                        data-i18n="Leveranstid">Leveranstid</span></a>

            </li>
            <li class=" nav-item {{ request()->routeIs('admin.message') ? 'active' : '' }}"><a
                    href="{{ route('admin.message') }}"><i class="menu-livicon" data-icon="minus-alt"></i><span
                        class="menu-title text-truncate" data-i18n="meddelanden">Meddelanden</span></a>

            </li>
            <li class=" nav-item {{ request()->routeIs('admin.coupons.index') ? 'active' : '' }}"><a
                    href="{{ route('admin.coupons.index') }}"><i class="menu-livicon"
                        data-icon="minus-alt"></i><span class="menu-title text-truncate"
                        data-i18n="Products">Kuponger</span></a>

            </li>
            <li class=" nav-item {{ request()->routeIs('admin.order.index') ? 'active' : '' }}"><a
                    href="{{ route('admin.order.index') }}"><i class="menu-livicon"
                        data-icon="shoppingcart-in"></i><span class="menu-title text-truncate"
                        data-i18n="Orders">Beställa</span></a>

            </li>
            <li class=" nav-item {{ request()->routeIs('admin.cust.index') ? 'active' : '' }}"><a
                    href="{{ route('admin.cust.index') }}"><i class="menu-livicon" data-icon="user"></i><span
                        class="menu-title text-truncate" data-i18n="Customers">Kunder</span></a>

            </li>
            <li class=" nav-item {{ request()->routeIs('admin.faqs.catselect') ? 'active' : '' }}"><a
                    href="{{ route('admin.faqs.catselect') }}"><i class="menu-livicon" data-icon="user"></i><span
                        class="menu-title text-truncate" data-i18n="Customers">Vanliga frågor</span></a>

            </li>
            <li style="background: none"
                class=" nav-item {{ request()->routeIs('admin.reports*') ? 'active' : '' }}"><a href="#"><i
                        class="menu-livicon" data-icon="minus-alt"></i><span class="menu-title text-truncate"
                        data-i18n="Reports">Rapporter</span></a>
                <ul class="menu-content report-menu">
                    <li class="{{ request()->routeIs('admin.reports.popular_products') ? 'active' : '' }}">
                        <a class="d-flex align-items-center {{ request()->routeIs('admin.reports.popular_products') ? 'active' : '' }}"
                            href="{{ route('admin.reports.popular_products') }}"><i
                                class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate"
                                data-i18n="Product"> Populära produkter</span></a>
                    </li>
                    <li class="{{ request()->routeIs('admin.reports.searched_keywords') ? 'active' : '' }}">
                        <a class="d-flex align-items-center {{ request()->routeIs('admin.reports.searched_keywords') ? 'active' : '' }}"
                            href="{{ route('admin.reports.searched_keywords') }}"><i
                                class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate"
                                data-i18n="Product">Sökte nyckelord</span></a>
                    </li>
                    <li class="{{ request()->routeIs('admin.reports.purchased_products') ? 'active' : '' }}">
                        <a class="d-flex align-items-center {{ request()->routeIs('admin.reports.purchased_products') ? 'active' : '' }}"
                            href="{{ route('admin.reports.purchased_products') }}"><i
                                class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate"
                                data-i18n="Product">Inköpta produkter</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ request()->routeIs('admin.delivery_settings.index') ? 'active' : '' }}"><a
                    href="{{ route('admin.delivery_settings.index') }}"><i class="menu-livicon"
                        data-icon="minus-alt"></i><span class="menu-title text-truncate" data-i18n="Reports">Delivery
                        Settings</span></a>
            <li class=" nav-item {{ request()->routeIs('settings.index') ? 'active' : '' }}"><a
                    href="{{ route('settings.index') }}"><i class="menu-livicon" data-icon="minus-alt"></i><span
                        class="menu-title text-truncate" data-i18n="Reports">inställningar</span></a>
        </ul>
    </div>
</div>
