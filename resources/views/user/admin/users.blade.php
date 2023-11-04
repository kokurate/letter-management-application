@extends('user.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Daftar Pengguna')


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Pengguna</h1>
    </div>
    -->

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif


    <!-- Content Row -->
    <div class="row">

        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2 pl-3">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pengguna Terdaftar
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\User::all()->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300 pr-3"></i>
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
                                Pegawai
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\User::where('type_id',3)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300 pr-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2 pl-3">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                               Kadis
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\User::where('type_id',2)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300 pr-3"></i>
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
                               Admin
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\User::where('type_id',1)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-secret fa-2x text-gray-300 pr-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   @livewire('users')


</div>
<!-- /.container-fluid -->

@endsection

@push('css')
    @livewireStyles
@endpush

@push('js')
    @livewireScripts

    <!-- Data Table-->
    <script>
        new DataTable('#daftar_pengguna', {
        scrollX: true,
    });
    
    
        window.addEventListener('hideUserModal', function(e){
            $('#tambah_modal').modal('hide');
        });

        window.addEventListener('showUserModal', function(e){
            $('#tambah_modal').modal('show');
        });    

        $('#tambah_modal').on('hidden.bs.modal', function(e){
          Livewire.emit('resetModalForm');
        });

        
        window.addEventListener('deleteUser', function(event) {
            Swal.fire({
                title: event.detail.title,
                html: event.detail.html,
                icon: 'warning', // Use a warning icon
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                width: '500px',
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteUserAction', event.detail.id);
                }else {
                    Swal.fire({
                        title: 'User Tidak Jadi Dihapus!',
                        icon: 'info', // Use an info icon
                        width: 400, // Set the width to 400 pixels
                    });
                }
            });
        });
    
    
    </script>

@endpush