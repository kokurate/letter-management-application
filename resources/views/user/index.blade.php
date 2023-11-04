@extends('user.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Dashboard')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- ============================== ADMIN ==================================-->
        @if(auth()->user()->type_id == 1)
            <!-- SURAT MASUK -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 pl-3">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Surat Masuk
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $admin_sm }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-inbox fa-2x text-gray-300 pr-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 pl-3">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Surat Keluar
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $admin_sk }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-envelope-open-text fa-2x text-gray-300 pr-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 pl-3">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    User
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $users }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300 pr-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- ====================================================================== -->

        <!-- ============================== KADIS ==================================-->
        @if(auth()->user()->type_id == 2)
            <!-- SURAT MASUK -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 pl-3">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Surat Masuk
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kadis_incoming }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-inbox fa-2x text-gray-300 pr-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- UPLOAD SURAT -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 pl-3">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Upload Surat
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $kadis_upload }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-envelope-open-text fa-2x text-gray-300 pr-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- ====================================================================== -->

            <!-- Earnings (Monthly) Card Example 
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 pl-3">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                </div>
                                <div class="row no-gutters align-items-center pl-2">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2 ">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300 pr-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            -->



    </div>
    <!-- Content End Row -->

    <!-- =========== Data Table ============ -->
    <!-- Content Row -->
    {{-- <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                </div>
                <div class="card-body">
                    <h2>testing</h2>
                </div>
            </div>
        </div>
    </div> --}}


</div>
<!-- /.container-fluid -->

@endsection