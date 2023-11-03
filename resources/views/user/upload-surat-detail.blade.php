@extends('user.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Upload Surat Detail')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">Detail Surat Kadis</h1>
        <a href="{{ route('user.upload-surat') }}" class="btn btn-primary btn-circle btn-lg my-3">
            <i class="fas fa-arrow-left"></i>
        </a>
        
    </div>

   

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 my-3">
            <div class="">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                        <h4 class="m-0 font-weight-bold text-primary">Edit Surat</h4>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="collapseCardExample" style="">
                        <div class="card-body">
                            <form action="{{ route('user.upload-surat-store', $detail->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                             
    
                                <div class="mb-3">
                                    <label for="perihal" class="form-label">
                                        Perihal
                                    </label>
                                    <input type="text" class="form-control  @error('perihal')is-invalid @enderror" 
                                            id="perihal" name="perihal" value="{{ old('perihal', $detail->perihal) }}"">
    
                                    @error('perihal')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
    
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" id="tanggal" value="{{ old('tanggal', $detail->tanggal) }}""
                                        class="form-control  @error('tanggal')is-invalid @enderror" name="tanggal">
                                    @error('tanggal')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
    
                                </div>
    
                                <div class="mb-3">
                                    <label for="file" class="form-label">File Surat</label>
                                    <input class="form-control @error('file') is-invalid @enderror" 
                                        type="file" id="file" name="file" accept=".pdf" >    
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
            
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-xl mt-3" 
                                        id="submitButton" type="submit">
                                        Submit
                                    </button>
                                </div>
    
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class=" my-2">
                <div class="card">
                    <div class="card-body">
                        <h4><strong>Nama</strong> : {{ $detail->user->name }}</h4>
                        <h4><strong>Perihal</strong> : {{ $detail->perihal }}</h4>
                        <h4><strong>Tanggal</strong> : {{ Carbon\Carbon::parse($detail->tanggal)
                                                            ->translatedFormat('d M Y') }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 my-3">
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
    <!-- Content End Row -->



</div>
<!-- /.container-fluid -->

@endsection
@push('css')
    @livewireStyles
@endpush

@push('js')
    @livewireScripts
@endpush