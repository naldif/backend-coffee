
<!doctype html>
<html lang="en">

    <head>
        
        @include('includes.dashboard.style')

    </head>

    <body data-sidebar="dark">
    
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                @include('includes.dashboard.topbar')
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    @include('includes.dashboard.sidebar')
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    @yield('content')
                    
                </div>
                <!-- End Page-content -->
               
                <footer class="footer">
                    @include('includes.dashboard.footer')
                </footer>
                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        @include('includes.dashboard.script')
    </body>

</html>