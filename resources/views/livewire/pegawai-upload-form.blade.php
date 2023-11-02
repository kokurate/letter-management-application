<div>

    @if(Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    
    <form class="row gx-4 gx-lg-5 justify-content-center mb-5"
    wire:submit.prevent="PegawaiUpload" method="POST" enctype="multipart/form-data" id="contactForm" >
    @csrf   

        <div class="col-lg-12">
                <div class="mb-3">
                    <label for="tipe_surat" class="form-label">Tipe Surat</label>
                    <select wire:model="tipe_surat" id="tipe_surat" 
                        class="form-select @error('tipe_surat')is-invalid @enderror" >
                        <option value="">Pilih Tipe Surat</option>
                        <option value="Surat Masuk">Surat Masuk</option>
                        <option value="Surat Keluar">Surat Keluar</option>
                    </select>
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
                            id="no_surat" wire:model="no_surat">
                        @error('no_surat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

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
                        <label for="tanggal" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" id="tanggal" 
                            class="form-control  @error('tanggal')is-invalid @enderror" wire:model="tanggal">
                        @error('perihal')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                    
                
        </div>
        <div class="col-lg-6">

                <div class="mb-3">
                    <label for="alamat_pengirim" class="form-label">Alamat Pengirim</label>
                    <input type="text" class="form-control @error('alamat_pengirim')is-invalid @enderror" 
                        id="alamat_pengirim" wire:model="alamat_pengirim">
                    @error('alamat_pengirim')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="alamat_tujuan" class="form-label">Alamat Tujuan</label>
                    <input type="text" class="form-control @error('alamat_tujuan')is-invalid @enderror" 
                        id="alamat_tujuan" wire:model="alamat_tujuan">
                    @error('alamat_tujuan')
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
        <div class="col-lg-12">
            <div class="d-grid"><button class="btn btn-primary btn-xl mt-5" id="submitButton" type="submit">Submit</button></div>

        </div>
    </form>

</div>
