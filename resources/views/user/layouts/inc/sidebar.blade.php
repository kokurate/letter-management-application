<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('user.index') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('logo.png') }}" alt="LOGO" class="img-fluid" style="width: 50px;" >
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
        
    <!-- ======================= ADMIN ============================= -->
    @if(auth()->user()->type_id == 1)


    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.check-surat') }}">
            <i class="fas fa-inbox fa-sm fa-fw mr-2"></i>
            <span>Lengkapi Surat</span></a>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder"></i>
            <span>Surat-surat</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Daftar Surat</h6>
                <a class="collapse-item" href="{{ route('admin.surat-masuk') }}">Masuk</a>
                <a class="collapse-item" href="{{ route('admin.surat-keluar') }}">Keluar</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.riwayat-upload-surat') }}">
            <i class="fas fa-envelope-open-text fa-sm fa-fw mr-2"></i>
            <span>Tambah Surat</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

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

    @endif
    <!-- ================= END ADMIN =========== -->

   

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->