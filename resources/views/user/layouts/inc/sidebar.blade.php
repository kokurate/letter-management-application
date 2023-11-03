<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">DPRKP</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- ======================= KADIS ============================= -->
    @if(auth()->user()->type_id == 2)
        <!-- Heading -->
        <div class="sidebar-heading">
            Menu
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.surat-masuk') }}">
                <i class="fas fa-inbox fa-sm fa-fw mr-2"></i>
                <span>Surat Masuk</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.upload-surat') }}">
                <i class="fas fa-envelope-open-text fa-sm fa-fw mr-2"></i>
                <span>Upload Surat</span></a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider">

    @endif
    <!-- ================================================================== -->
        
    <!-- Heading -->
    <div class="sidebar-heading">
        Admin
    </div>

   
    <!-- ADMIN -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users') }}">
            <i class="fas fa-user fa-sm fa-fw mr-2"></i>
            <span>Users</span></a>
    </li>
    <!-- END ADMIN -->

   

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->