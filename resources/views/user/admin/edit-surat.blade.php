@extends('user.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Admin Upload Surat')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">{{ $h1 }}</h1>
        <a href="{{ route('admin.riwayat-upload-surat') }}" class="btn btn-primary btn-circle btn-lg">
            <i class="fas fa-arrow-left"></i>
        </a>
        
    </div>

   

    <!-- Content Row -->
    <div class="row">
        
        
        <div>

            <form class="row gx-4 gx-lg-5 justify-content-center mb-5" 
                action="{{ route('admin.upload-surat-edit-store', $detail->id) }}" method="POST" enctype="multipart/form-data">
            @csrf   

            <div class="col-lg-12">
                <div class="mb-3">
                    <label for="tipe_surat" class="form-label">Tipe Surat</label>
                    <select name="tipe_surat" id="tipe_surat" 
                        class="form-select @error('tipe_surat') is-invalid @enderror">
                        <option value="">Pilih Tipe Surat</option>
                        {{-- <option value="Surat Masuk" {{ (isset($detail) && $detail->tipe_surat === 'Surat Masuk') || old('tipe_surat') === 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                        <option value="Surat Keluar" {{ (isset($detail) && $detail->tipe_surat === 'Surat Keluar') || old('tipe_surat') === 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar</option>                    </select> --}}
                        <option value="Surat Masuk" {{ old('tipe_surat', $detail->tipe_surat) === 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                        <option value="Surat Keluar" {{ old('tipe_surat', $detail->tipe_surat) === 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar</option>                    </select>
                    @error('tipe_surat')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
                <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="no_surat" class="form-label ">
                                    No Surat
                                </label>
                                <input type="text" class="form-control @error('no_surat')is-invalid @enderror" 
                                    id="no_surat" name="no_surat"
                                    value="{{ old('no_surat', $detail->no_surat) }}">
                                @error('no_surat')
                                    <span class="text-danger mb-0 mt-0">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="perihal" class="form-label">
                                    Perihal
                                </label>
                                <input type="text" class="form-control  @error('perihal')is-invalid @enderror" 
                                        id="perihal" name="perihal"
                                        value="{{ old('perihal', $detail->perihal) }}">

                                @error('perihal')
                                    <span class="text-danger mb-0 mt-0">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Pelaksanaan</label>
                                <input type="date" id="tanggal" 
                                    class="form-control  @error('tanggal')is-invalid @enderror" 
                                    name="tanggal" value="{{ old('tanggal', $detail->tanggal) }}">
                                @error('tanggal')
                                    <span class="text-danger mb-0 mt-0">{{ $message }}</span>
                                @enderror

                            </div>


                </div>
                <div class="col-lg-6">

                        <div class="mb-3">
                            <label for="alamat_pengirim" class="form-label">Alamat Pengirim</label>
                            <input type="text" class="form-control @error('alamat_pengirim')is-invalid @enderror" 
                                id="alamat_pengirim" name="alamat_pengirim"
                                value="{{ old('alamat_pengirim', $detail->alamat_pengirim) }}">
                            @error('alamat_pengirim')
                                <span class="text-danger mb-0 mt-0">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label for="alamat_tujuan" class="form-label">Alamat Tujuan</label>
                            <input type="text" class="form-control @error('alamat_tujuan')is-invalid @enderror" 
                                id="alamat_tujuan" name="alamat_tujuan"
                                value="{{ old('alamat_tujuan', $detail->alamat_tujuan) }}">
                            @error('alamat_tujuan')
                                <span class="text-danger mb-0 mt-0">{{ $message }}</span>
                            @enderror

                        </div>


                        <div class="mb-3">
                            <label for="file" class="form-label">File Surat</label>
                            <input class="form-control @error('file')is-invalid @enderror" 
                                type="file" id="file" name="file" accept=".pdf">    
                            @error('file')
                                <span class="text-danger mb-0 mt-0">{{ $message }}</span>
                            @enderror
                        </div>
                </div>
                <div class="col-lg-12">
                    <div class="d-grid"><button class="btn btn-primary btn-xl mt-5" id="submitButton" type="submit">Submit</button></div>

                </div>
            </form>

        </div>

    </div>

   
    <!-- Content End Row -->



</div>
<!-- /.container-fluid -->

@endsection