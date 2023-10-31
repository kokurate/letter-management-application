<div>
    
    @if(Session::get('fail'))
    <div class="alert alert-danger">
        {{ Session::get('fail') }}
    </div>
    @endif

    @if(Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <form class="user" wire:submit.prevent="LoginHandler()" method="POST" autocomplete="off">
        <div class="form-group">
            <input type="text" class="form-control form-control-user @error('login_id') is-invalid @enderror"
                id="exampleInputEmail" aria-describedby="emailHelp"
                placeholder="Email atau Username"
                autocomplete="off" wire:model='login_id'>
            @error('login_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                id="exampleInputPassword" placeholder="Password"
                wire:model="password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
     
        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
  
        <hr>
    </form>

</div>
