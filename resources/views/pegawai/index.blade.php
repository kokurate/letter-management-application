<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard Pegawai</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="/templates/pegawai/css/styles.css" rel="stylesheet" />
        
        <!-- Toastr Cdn-->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       
        <!-- Data Table-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

        @livewireStyles

    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="{{ route('pegawai.index') }}">DPRKP</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#upload">Upload</a></li>
                        <li class="nav-item"><a class="nav-link" href="#history">Daftar Surat</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('pegawai.change-password') }}">Ganti Password</a></li>
                        <li class="nav-item">
                            <a href="{{ route('auth.logout') }}" 
                                class="nav-link" 
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">

                                Keluar
                            </a>
                            <form action="{{ route('auth.logout') }}"
                                id="logout-form" method="post">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h2 class="text-white font-weight-bold" style="font-size: 35px;">
                            <strong>Dinas Perumahan Rakyat Dan Kawasan Pemukiman Kabupaten Minahasa</strong>
                        </h2>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5" style="font-size: 25px">Selamat Datang</p>
                        <p class="text-white-75 mb-5" style="font-size: 25px;margin-top:-40px" >{{ auth()->user()->name }}</p>
                        <a class="btn btn-primary btn-xl" href="#upload">Upload Surat</a>
                    </div>
                </div>
            </div>
        </header>
    
 
        <section class="page-section" id="upload">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h1 class="mt-0">Upload Surat</h1>
                        <hr class="divider" />
                        {{-- <p class="text-muted mb-5">Ready to start your next project with us? Send us a messages and we will get back to you as soon as possible!</p> --}}
                    </div>
                </div>
              
                <!-- ROW IN FORM-->
                @livewire('pegawai-upload-form')
                
            </div>

  
            <br><br>
            <div class="container px-4 px-lg-5 mt-5 mb-12" id="history">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Daftar Surat</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">daftar surat yang sudah lengkap</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table id="index" class="table hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th>No Surat</th>
                                    <th>Alamat Pengirim</th>
                                    <th>Alamat Tujuan</th>
                                    <th>Perihal</th>
                                    <th>Tanggal</th>
                                    <th>File</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\Surat::where('tipe_surat', '!=', null)
                                                        ->where('alamat_pengirim', '!=', null)
                                                        ->where('alamat_tujuan', '!=', null)
                                                        ->where('no_surat', '!=', null)
                                                        ->where('user_id', auth()->user()->id)
                                                        ->orderBy('created_at', 'asc')
                                                        ->get() 
                                                        as 
                                                        $data)
                                    <tr>
                                        <td>{{ $data->no_surat }}</td>
                                        <td>{{ $data->alamat_pengirim }}</td>
                                        <td>{{ $data->alamat_tujuan }}</td>
                                        <td>{{ $data->perihal }}</td>
                                        <td>{{ Carbon\Carbon::parse($data->tanggal)
                                                ->translatedFormat('d M Y') }}
                                        </td>
                                        <td><a href="{{ asset($data->file) }}" target="__blank">File</a></td>
                                        <td class="text-center">  
                                            <a href="#" class="my-1 btn btn-primary btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#Modal-{{ $data->id }}">
                                                <i class="fas fa-eye"></i>Detail
                                            </a>
                                        </td>
                                    </tr>  

                                    <!-- ======== MODAL ======== -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="Modal-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Add your modal content here -->
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><strong>NAMA</strong> : {{ auth()->user()->name }}</li>
                                                        <li class="list-group-item"><strong>PERIHAL</strong> : {{ $data->perihal }}</li>
                                                        <li class="list-group-item"><strong>NO SURAT</strong> : {{ $data->no_surat }}</li>
                                                        <li class="list-group-item"><strong>TIPE SURAT</strong> : {{ $data->tipe_surat }}</li>
                                                        <li class="list-group-item"><strong>ALAMAT PENGIRIM</strong> : {{ $data->alamat_pengirim }}</li>
                                                        <li class="list-group-item"><strong>ALAMAT TUJUAN</strong> : {{ $data->alamat_tujuan }}</li>
                                                        <li class="list-group-item"><strong>TANGGAL</strong> : {{ $data->tanggal }}</li>
                                                    </ul>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ======== MODAL END ======== -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            
            <br><br><br><br><br><br><br><br><br><br>

        </section>

        

         <!-- Jquery-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


     <!-- Data Table-->
     <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

     <!-- Data Table-->
     <script>
         new DataTable('#index', {
             scrollX: true,
             columnDefs: [
        {
            target: [0,1,2],
            visible: false
        }
    ]
         });
     </script>


    <!-- Toastr  cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Toastr script for livewire-->
    <script>
      $(document).ready(function(){
          toastr.options= {
            'progressBar' : true,
            'positionClass' : 'toast-bottom-right'
          }
      });
      window.addEventListener('info', event =>{
        toastr.info(event.detail.message);
      });
      window.addEventListener('success', event =>{
        toastr.success(event.detail.message);
      });
      window.addEventListener('warning', event =>{
        toastr.warning(event.detail.message);
      });
      window.addEventListener('error', event =>{
        toastr.error(event.detail.message);
      });
    </script>
   
        @livewireScripts
        <!-- Footer-->
        {{-- <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2023 - Company Name</div></div>
        </footer> --}}
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="/templates/pegawai/js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

   
    </body>
</html>
