<div>

    @if(Session::get('success'))
        <div class="row justify-content-center">
            <div class="col-lg-6">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
            </div>
        </div>
    @endif
       
    
    
    <form class="row gx-4 gx-lg-5 justify-content-center mb-5"
    wire:submit.prevent="PegawaiUpload" method="POST" enctype="multipart/form-data" id="contactForm" >
    @csrf   

  
        <div class="col-lg-6">
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
                        @error('tanggal')
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

                    <div class="d-grid">
                        <button class="btn btn-primary btn-xl mt-5" 
                            id="submitButton" type="submit">
                            Submit
                        </button>
                    </div>
                    
                
        </div>
    </form>

</div>
