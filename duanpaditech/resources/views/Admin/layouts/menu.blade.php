<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('asset_home/images/logo1.png') }}" width="80px" alt="Estudiez"/><a href=""></a>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>
                @if( Auth::guard('admin')->user()->app_id == null )
                    <li class="{{ request()->routeIs('app.index') || request()->routeIs('app.create') ? 'active' : '' }}">
                        <a href=" {{ route('app.index') }}">
                            App Setting
                        </a>
                    </li>
                @endif
                @if( Auth::guard('admin')->user()->app_id == null )
                    <li class="{{ request()->routeIs('appAdmin.index') || request()->routeIs('appAdmin.create') ? 'active' : '' }}">
                        <a href="{{ route('appAdmin.index') }}">
                            Admin Setting
                        </a>
                    </li>
                @endif
                <li class="{{ request()->routeIs('stamp.index') || request()->routeIs('stamp.create') ? 'active' : '' }}">
                    <a href=" {{ route('stamp.index')  }} ">
                        Stamp Setting
                    </a>
                </li>
                <li class="{{ request()->routeIs('image.index') || request()->routeIs('image.create') ? 'active' : '' }}">
                    <a href=" {{ route('image.index')  }} ">
                        Stamp Image Setting
                    </a>
                </li>
                <li class="{{ request()->routeIs('coupom.index') || request()->routeIs('coupom.create') ? 'active' : '' }}">
                    <a href=" {{ route('coupon.index')  }} ">
                        Coupon Setting
                    </a>
                </li>
                <li class="{{ request()->routeIs('store.index') ? 'active' : '' }}">
                    <a href=" {{ route('store.index')}} ">
                        Stores Import
                    </a>
                </li>
                <li class="{{ request()->routeIs('user.coupon.index') ? 'active' : '' }}">
                    <a href=" {{ route('user.coupon.index')}} ">
                        User Coupon Export
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
