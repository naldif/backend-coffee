<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('account.dashboard') }}" class="waves-effect {{ Route::is('account.dashboard*') ? 'active' : '' }}">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('account.category.index') }}" class=" waves-effect {{ Route::is('account.category*') ? 'active' : '' }}">
                        <i class="ri-calendar-2-line"></i>
                        <span>Category</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('account.coffeeshop.index') }}" class=" waves-effect {{ Route::is('account.coffeeshop*') ? 'active' : '' }}">
                        <i class="ri-calendar-2-line"></i>
                        <span>Coffee Shop</span>
                    </a>
                </li>

                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->