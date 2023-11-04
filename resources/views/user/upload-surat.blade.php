@extends('user.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Upload Surat Kadis')

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