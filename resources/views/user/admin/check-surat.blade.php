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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Surat Yang Belum Dilengkapi</h6>
                </div>
                
                <div class="card-body">
                    <table id="admin_check_surat" class="table hover table-bordered table-striped cell-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Perihal</th>
                                <th>Tanggal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Models\Surat::whereIn('status_id', [2, 3])
                                                    // ->orWhere('tipe_surat', null)
                                                    // ->orWhere('alamat_pengirim', null)
                                                    // ->orWhere('alamat_tujuan', null)
                                                    // ->orWhere('no_surat', null)
                                                    ->orderBy('created_at', 'asc')
                                                    ->get() as $data)
                                <tr>
                                    <td>{{ $data->user->name }}</td>
                                    <td>{{ $data->perihal }}</td>
                                    {{-- <td>{{ Carbon\Carbon::parse($data->tanggal)
                                            ->translatedFormat('d M Y') }} --}}
                                    <td>{{ $data->tanggal }}
                                    </td>
                                    <td class="text-center">  
                                        {{-- <form action="{{ route('admin.check-surat-delete', $data->id) }}" id="delete-form-{{ $data->id }}" method="post">@csrf @method('delete')</form>
                                        <a href="#" class="my-1 btn btn-danger btn-sm delete" id="{{ $data->id }}"
                                            data-confirm-delete="true"
                                            onclick="deleteItem({{ $data->id }})">
                                            <i class="fas fa-trash"></i>
                                        </a> --}}
                                        
                                        {{-- <a href="{{ route('user.check-surat.detail', ['detail' => $data->id]) }}?token={{ session('surat_token') }}" 
                                                class="btn btn-secondary btn-sm delete" data-id="1">
                                                <i class="fas fa-eye"></i>
                                        </a> --}}

                                        <a href="{{ route('admin.check-surat-edit', $data->id) }}" class="my-1 btn btn-primary btn-sm delete">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="{{ route('admin.surat.detail', ['id' => $data->id]) }}" 
                                            class="btn btn-secondary btn-sm delete">
                                            <i class="fas fa-eye"></i>
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
<!-- /.container-fluid -->

@endsection
@push('css')
    @livewireStyles
@endpush

@push('js')
    @livewireScripts

    <!-- Data Table-->
    <script>
        new DataTable('#admin_check_surat', {
            scrollX: true,
        });

    </script>

@endpush