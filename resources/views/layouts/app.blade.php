
<!DOCTYPE html>
<html lang="en">

<head>
   
    @stack('before-style')

    @include('includes.dashboard.style')

    @stack('after-style')
</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">
            @include('includes.dashboard.topbar')
        </div>
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            @include('includes.dashboard.sidebar')
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
                @yield('content')
            <!-- content -->

            <footer class="footer">
                @include('includes.dashboard.footer')
            </footer>

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    @include('includes.dashboard.script')

</body>

</html>