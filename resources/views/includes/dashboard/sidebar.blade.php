<div class="slimscroll-menu" id="remove-scroll">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu" id="side-menu">
            <li class="menu-title">Menu</li>
            <li>
                <a href="{{ route('account.dashboard') }}" class="waves-effect {{ Route::is('account.dashboard*') ? 'active' : '' }}">
                    <i class="dripicons-meter"></i><span> Dashboard </span>
                </a>
            </li>

            <li class="menu-title">Master</li>
            <li>
                <a href="{{ route('account.category.index') }}" class="waves-effect {{ Route::is('account.category*') ? 'active' : '' }}"><i class="dripicons-calendar"></i><span>Category</span></a>
            </li>
            <li>
                <a href="{{ route('account.menus.index') }}" class="waves-effect {{ Route::is('account.menus*') ? 'active' : '' }}"><i class="dripicons-calendar"></i><span>Menu</span></a>
            </li>
            <li>
                <a href="{{ route('account.coffeeshop.index') }}" class="waves-effect {{ Route::is('account.coffeeshop*') ? 'active' : '' }}"><i class="dripicons-calendar"></i><span>Coffee Shop</span></a>
            </li>

        </ul>

    </div>
    <!-- Sidebar -->
    <div class="clearfix"></div>

</div>