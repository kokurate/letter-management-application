@extends('user.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Daftar Surat Admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Surat Admin</h1>
    </div>

    <div>
   
        <!-- =========== Data Table ============ -->
        <!-- Content Row -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Riwayat Upload Surat</h6>
                        <div>
                            <a href="{{ route('admin.upload-surat') }}" class="btn btn-sm btn-primary">
                                Tambah
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <table id="daftar_upload_surat_admin" class="table hover table-bordered table-striped cell-border display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Perihal</th>
                                    <th>Tanggal</th>
                                    <th>No Surat</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\Surat::where('user_id', auth()->user()->id)
                                            ->where('status_id',4)
                                            ->orderBy('created_at','asc')
                                            ->get() as $data)                            
                                <tr>
                                    <td>{{ $data->perihal }}</td>
                                    <td>{{ Carbon\Carbon::parse($data->tanggal)->translatedFormat('d M Y') }}</td>
                                    <td>{{ $data->no_surat }}</td>
                                    <td class="text-center">  
                                        <form action="{{ route('user.upload-surat-delete', $data->id) }}" id="delete-form-{{ $data->id }}" method="post">@csrf @method('delete')</form>
                                        <a href="#" class="my-1 btn btn-danger btn-sm delete" id="{{ $data->id }}"
                                            data-confirm-delete="true"
                                            onclick="deleteItem({{ $data->id }})">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="{{ route('user.upload-surat-detail', $data->id) }}" class="my-1 btn btn-primary btn-sm delete">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </td>
                                </tr>   
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        



</div>
<!-- /.container-fluid -->

@endsection

@push('js')


    <!-- Data Table-->
    <script>
        new DataTable('#daftar_upload_surat_admin', {
            scrollX: true,
        });

    </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function deleteItem(id) {
            swal({
                title: "Apakah Anda Yakin?",
                text: "Surat Akan Terhapus Permanen!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    document.getElementById('delete-form-' + id).submit();
                } else {
                    swal("Surat Tidak Jadi Dihapus!");
                }
            });
        }
    </script>


@endpush