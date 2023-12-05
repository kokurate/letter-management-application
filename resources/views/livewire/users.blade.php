<div>

    <!-- =========== Data Table ============ -->
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pengguna</h6>
                    <div>
                        <a href="" class="btn btn-sm btn-primary" data-bs-toggle='modal' data-bs-target='#tambah_modal'>
                            Tambah User
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <table id="daftar_pengguna" class="table hover table-bordered table-striped cell-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $data)
                            <tr>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->userType->name }}</td>
                                <td>
                                    <div class="btn-group d-block text-center">
                                        <a href="#" class="btn btn-sm btn-primary my-1" wire:click.prevent='editUser({{ $data->id }})'>Edit</a>&nbsp;
                                        <a href="#" class="btn btn-sm btn-danger my-1" wire:click.prevent='deleteUser({{ $data->id }})'>Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Tambah User -->
    <div wire:ignore.self class="modal modal-blur fade" tabindex="-1" role="dialog" aria-hidden="true" id="tambah_modal"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="post"
            @if($updateUserMode)
                wire:submit.prevent='updateUser()'
            @else
                wire:submit.prevent='addUser'
            @endif
            >
                <div class="modal-header">
                    <h5 class="modal-title">{{ $updateUserMode ? 'Update User' : 'Tambah User' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($updateUserMode)
                        <input type="hidden" wire:model="selected_user_id">
                    @endif
                    <div class="mb-3">
                        <div class="form-label">Tipe User</div>
                        <select class="form-select @error('type_id') is-invalid @enderror" wire:model='type_id'>
                            <option value="">Pilih Tipe User</option>
                          @foreach (\App\Models\Type::all() as $level)
                              <option value="{{ $level->id }}">{{ $level->name }}</option>
                          @endforeach
                        </select>
                        @error('type_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <span class="text-danger"> @error('level') {{ $message }} </span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            name="example-text-input" placeholder="Masukkan Nama User" 
                            wire:model="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" 
                            name="example-text-input" placeholder="Masukkan email" 
                            wire:model="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" 
                            name="example-text-input" placeholder="Masukkan Username" 
                            wire:model="username">
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @if($updateUserMode == true)
                        <br>
                        <hr>
                        <p style="font-size: 15px;color:red;">* Optional</p>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                            name="example-text-input" wire:model="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                 
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ $updateUserMode ? 'Update' : 'Tambah'}}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Tambah User  end-->

</div>
