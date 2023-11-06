@extends('user.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Dashboard')

@section('content')

<div class="container-fluid">
    <div class="col-lg-6 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2
    mb-3 border-bottom">
        <h1 class="h2">Ganti Password</h1>
    </div>
    <div class="col-6">
        <div class="card card-primary">

            <div class="col-lg-12 mb-3 mt-3">
                <form action="{{ route('user.change-password.store') }}" method="POST" >
                    @csrf
                    
                    <div class="mb-1">
                        <label for="p1" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="p1" name="p1">
                    </div>
                    @error('p1')
                    <p style="color:red;">
                        <span role="alert text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    </p>
                    @enderror
                    <div class="mb-1">
                        <label for="p2" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="p2" name="p2">
                    </div>
                    @error('p2')
                    <p style="color:red;">
                        <span role="alert text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    </p>
                    @enderror
                    <button type="submit" class=" mt-3 btn btn-primary float-right">Submit</button>
                </form>
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