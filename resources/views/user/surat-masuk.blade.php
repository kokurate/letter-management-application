@extends('user.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Daftar Surat Masuk')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Surat Masuk</h1>
    </div> --}}

    <!-- =========== Data Table ============ -->
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Surat Masuk</h6>
                </div>
                
                <div class="card-body">
                    <table id="daftar_surat_masuk" class="table hover table-bordered table-striped cell-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Perihal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Models\Surat::where('status_id', 1)->orderBy('created_at', 'asc')->get() as $data)
                                <tr>
                                    <td>{{ $data->user->name }}</td>
                                    <td>{{ $data->perihal }}</td>
                                    <td class="text-center">  
                                        <a href="{{ route('user.surat-masuk.delete', $data->id) }}" 
                                            class="btn btn-danger btn-sm delete" data-id="8"
                                            data-confirm-delete="true"
                                            onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                                                <i class="fas fa-trash"></i>
                                        </a>
                                        
                                        <a href="{{ route('user.surat-masuk.detail', ['detail' => $data->id]) }}?token={{ session('surat_token') }}" 
                                                class="btn btn-secondary btn-sm delete" data-id="1">
                                                <i class="fas fa-eye"></i>
                                        </a>
                                        
                                    </td>
                                </tr>  
                                <form action="{{ route('user.surat-masuk.delete', $data->id) }}" id="delete-form" method="post">@csrf @method('delete')</form>  
                            @endforeach
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
        new DataTable('#daftar_surat_masuk', {
            scrollX: true,
        });

    </script>


@endpush