@extends('user.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Surat Masuk Detail')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">Detail Surat</h1>
        <a href="{{ route('user.index') }}" class="btn btn-primary btn-circle btn-lg">
            <i class="fas fa-arrow-left"></i>
        </a>
        
    </div>

   

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 col-sm-12 my-2">
            <div class="card">
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Nama</strong> : {{ $detail->user->name ?? '---'}}
                        </li>
                        <li class="list-group-item">
                            <strong>Perihal</strong> : {{ $detail->perihal ?? '---' }}
                        </li>
                        <li class="list-group-item">
                            <strong>No Surat</strong> : {{ $detail->no_surat ?? '---' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Tipe Surat</strong> : {{ $detail->tipe_surat ?? '---' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Alamat Pengirim</strong> : {{ $detail->alamat_pengirim ?? '---' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Alamat Tujuan</strong> : {{ $detail->alamat_tujuan ?? '---' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Tanggal</strong> : {{ Carbon\Carbon::parse($detail->tanggal)
                                                                        ->translatedFormat('d M Y') }}
                        </li>
                    </ul>
                </div>
            </div>
            <p class="modal-footer text-mute">
                diupload pada {{ Carbon\Carbon::parse($detail->created_at)->isoFormat('D MMMM YYYY') }}, jam  {{ Carbon\Carbon::parse($detail->created_at)->format('H:m') }}
            </p>
        </div>

        <div class="col-lg-6 col-sm-12 my-2">
            <div class="card">
                <div class="card-body">
                    <a href="{{ asset($detail->file) }}" 
                        class="btn btn-primary mb-3">
                        Download File
                    </a>
                   <iframe src="{{ asset($detail->file) }}" width="100%" height="600px"
                            type='application/pdf'>
                    </iframe>
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
@endpush