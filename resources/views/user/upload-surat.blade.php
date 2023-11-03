@extends('user.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Daftar Surat Masuk')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Surat Kadis</h1>
    </div>

    <!-- =========== Data Table ============ -->
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Riwayat Upload Surat</h6>
                    <div>
                        <a href="" class="btn btn-sm btn-primary" data-bs-toggle='modal' data-bs-target='#tambah_modal'>
                            Tambah
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <table id="daftar_upload_surat" class="table hover table-bordered table-striped cell-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat Pengirim</th>
                                <th>Alamat Tujuan</th>
                                <th>Perihal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>Verel Lantan</td>
                                <td>Fakultas Teknik</td>
                                <td>Rektor Universitas</td>
                                <td>Kenaikan Pangkat Dosen</td>
                                <td class="text-center">  
                                    <a href="#" class="btn btn-danger btn-sm delete" data-id="8">
                                            <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="#" class="btn btn-primary btn-sm delete" data-id="1">
                                            <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>                   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


  
    



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
        new DataTable('#daftar_upload_surat', {
            scrollX: true,
        });

    </script>


@endpush