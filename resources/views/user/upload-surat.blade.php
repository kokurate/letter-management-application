@extends('user.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Daftar Surat Masuk')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Surat Kadis</h1>
    </div>

    @livewire('kadis-upload-form')
        



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

        window.addEventListener('hideKadisModal', function(e){
            $('#tambah_modal_surat').modal('hide');
        });


        $('#tambah_modal_surat').on('hidden.bs.modal', function(e){
          Livewire.emit('resetModalForm');
        });

    </script>


@endpush