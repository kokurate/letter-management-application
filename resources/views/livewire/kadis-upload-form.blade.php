<div>
   
    <!-- =========== Data Table ============ -->
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Riwayat Upload Surat</h6>
                    <div>
                        <a href="" class="btn btn-sm btn-primary" data-bs-toggle='modal' data-bs-target='#tambah_modal_surat'>
                            Tambah
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <table id="daftar_upload_surat" class="table hover table-bordered table-striped cell-border display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Perihal</th>
                                <th>Tanggal</th>
                                <th>File</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surat_kadis as $data)                            
                            <tr>
                                <td>{{ $data->user->name }}</td>
                                <td>{{ $data->perihal }}</td>
                                <td>{{ Carbon\Carbon::parse($data->tanggal)->translatedFormat('d M Y') }}</td>
                                <td><a href="{{ asset($data->file) }}">File</a></td>
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

    <!-- Modal Start-->
    
    <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="tambah_modal_surat" data-bs-backdrop="static" 
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambah_modal_suratLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form wire:submit.prevent="KadisUpload" method="POST" enctype="multipart/form-data">
                        @csrf   

                        <div class="modal-header">
                            <h5 class="modal-title" id="tambah_modal_suratLabel">Tambah Surat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                    <div class="row gx-4 gx-lg-5 justify-content-center">
                                        <div class="mb-3">
                                            <label for="perihal" class="form-label">
                                                Perihal
                                            </label>
                                            <input type="text" class="form-control  @error('perihal')is-invalid @enderror" 
                                                    id="perihal" wire:model="perihal">

                                            @error('perihal')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="tanggal" class="form-label">Tanggal</label>
                                            <input type="date" id="tanggal" 
                                                class="form-control  @error('tanggal')is-invalid @enderror" wire:model="tanggal">
                                            @error('perihal')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>

                                        <div class="mb-3">
                                            <label for="file" class="form-label">File Surat</label>
                                            <input class="form-control @error('file')is-invalid @enderror" 
                                                    type="file" id="file" wire:model="file" accept=".pdf">    
                                            @error('file')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>                            
                                    </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- Modal End-->

</div>
