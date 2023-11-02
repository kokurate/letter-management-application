<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard Pegawai</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="/templates/pegawai/assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="/templates/pegawai/css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">DPRKP</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#upload">Upload</a></li>
                        <li class="nav-item"><a class="nav-link" href="#history">History</a></li>
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
                        <p class="text-white-75 mb-5" style="font-size: 25px">Selamat Datang Pegawai</p>
                        <p class="text-white-75 mb-5" style="font-size: 25px;margin-top:-40px" >{{ auth()->user()->name }}</p>
                        <a class="btn btn-primary btn-xl" href="#upload">Upload Surat</a>
                    </div>
                </div>
            </div>
        </header>
    
 
        <!-- Contact-->
        <section class="page-section" id="upload">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h1 class="mt-0">Upload Surat</h1>
                        <hr class="divider" />
                        {{-- <p class="text-muted mb-5">Ready to start your next project with us? Send us a messages and we will get back to you as soon as possible!</p> --}}
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-12">
                        <form action="insertpegawai" method="POST" enctype="multipart/form-data" id="contactForm" >
                            @csrf   
                            <div class="mb-3">
                                <label for="tipe_surat" class="form-label">Tipe Surat</label>
                                <select name="tipe_surat" id="tipe_surat" class="form-select" >
                                    <option value="">Pilih Tipe Surat</option>
                                    <option value="Surat Masuk">Surat Masuk</option>
                                    <option value="Surat Keluar">Surat Keluar</option>
                                </select>
                            </div>
                    </div>
                    <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="no_surat" class="form-label">No Surat</label>
                                    <input type="text" class="form-control" id="no_surat" name="no_surat">
                                </div>

                                <div class="mb-3">
                                    <label for="perihal_pegawai" class="form-label">Perihal</label>
                                    <input type="text" class="form-control" id="perihal_pegawai" name="perihal_pegawai">
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Pelaksanaan</label>
                                    <input type="date" id="tanggal" 
                                            class="form-control" name="tanggal" value="" required>
                                    
                                </div>
                                
                            
                    </div>
                    <div class="col-lg-6">

                            <div class="mb-3">
                                <label for="alamat_pengirim" class="form-label">Alamat Pengirim</label>
                                <input type="text" class="form-control" id="alamat_pengirim" name="alamat_pengirim">
                            </div>

                            <div class="mb-3">
                                <label for="alamat_tujuan" class="form-label">Alamat Tujuan</label>
                                <input type="text" class="form-control" id="alamat_tujuan" name="alamat_tujuan">
                            </div>

                            
                            <div class="mb-3">
                                <label for="file" class="form-label">File Surat</label>
                                <input class="form-control" type="file" id="file">    
                            </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-grid"><button class="btn btn-primary btn-xl mt-5" id="submitButton" type="submit">Submit</button></div>

                        </form>
                    </div>
                </div>
            </div>

            <!-- Table Daftar Surat
                <br><br>
            <div class="container px-4 px-lg-5 mt-5" id="history">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Let's Get In Touch!</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">Ready to start your next project with us? Send us a messages and we will get back to you as soon as possible!</p>
                    </div>
                </div>
            </div>
            -->

        </section>

   

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
