<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Welcome to GAS</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <link href="lanpage/css/styles2.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top"><img src="lanpage/assets/img/logos/logo.png" alt="..." /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#header">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Gas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#daftar">Daftar</a></li>
                    <li class="nav-item"><a class="nav-link" href="#karir">Karir</a></li>
                    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                    <li><a class="btn btn-primary btn-m text-uppercase" href="login">Sign In</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead" id="header">
        <div class="container">
            <table>
                <tr>
                    <td><br><br><br><br><br>
                        <div class="masthead-heading">Bergabung dengan GAS</div>
                        <div class="masthead-subheading">Aplikasi GAS akan membantumu dalam memantau stok produk tokomu dan menjangkau customer yang lebih luas</div>

                        <div class="masthead-subheading">Unduh<br>
                            <a class="" href="https://play.google.com/store/apps/details?id=id.gas.app&amp;hl=en&pli=1" target="_blank"><img src="lanpage/assets/img/beranda/gplay.png" width="100px" /></a>
                        </div>
                        <br><br><br><br>
                        <a class="" href="https://www.instagram.com/aplikasigas/?hl=id" target="_blank"><img src="lanpage/assets/img/logos/ig.png" width="30px" /></a>&nbsp;
                        <a class="" href="https://web.facebook.com/aplikasigas?_rdc=1&_rdr" target="_blank"><img src="lanpage/assets/img/logos/fb.png" width="30px" /></a>
                    </td>
                    <td>
                        <img src="{{asset('lanpage/assets/img/beranda/header.PNG')}}" width="450px">
                    </td>
                </tr>
            </table>
        </div>
    </header>
    <!-- Fitur -->
    <section class="page-section" id="fitur">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">{{ $fitur[0]->judul }}</h2>
                <h3 class="section-subheading text-muted">{{ $fitur[0]->desk }}</h3>
            </div>
            <div class="row text-center">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                @foreach ($fitur as $f)
                <div class="col-md-2">
                    <img src="{{asset('storage/photo/'.$f->image)}}" alt="" width="100px" height="100px">
                    <h6 class="my-3">{{ $f->subjudul }}</h6>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Kategori Toko-->
    <section class="page-section bg-light">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">{{ $kategori[0]->judul }}</h2>
                <h3 class="section-subheading text-muted">{{ $kategori[0]->desk }}</h3>
            </div>
            <div class="row text-center">
                @foreach ($kategori as $k)
                <div class="col-md-3">
                    <img src="{{asset('storage/photo/'.$k->image)}}" alt="" width="200px">
                    <h6 class="my-3">{{ $k->subjudul }}</h6>
                    <h3 class="section-subheading text-muted">{{ $k->isi }}</h3>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Map -->
    <section class="page-section">
        <div class="container">
            @foreach ($map as $m)
            <div class="text-center">
                <h2 class="section-heading text-uppercase">{{ $m->judul }}</h2>
                <h3 class="section-subheading text-muted">{{ $m->desk }}</h3>
            </div>
            <div align="center">
                <img src="{{asset('storage/photo/'.$m->image)}}" alt="" width="500px">
            </div>
            @endforeach
        </div>
    </section>
    <!-- Daftar -->
    <section class="page-section bg-light" id="daftar">
        <div class="container">
            <div align="center">
                <table>
                    @foreach ($daftar as $d)
                    <tr>
                        <td>
                            <img src="{{asset('storage/photo/'.$d->image)}}" alt="" width="250px">
                        </td>
                        <td style="padding-left:40px">
                            {{ $d->judul }}<br>
                            <h4 class="section-heading">{{ $d->subjudul }}</h4>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
    <!-- Tentang Kami -->
    <section class="page-section bg-light" id="tentang">
        <div class="container">
            <div class="text-center">
                @foreach ($tentang as $t)
                <h2 class="section-heading text-uppercase">{{ $t->judul }}</h2>
                <h3 class="section-subheading text-muted">{{ $t->desk }}</h3>
                @endforeach
                <a class="" href="https://www.instagram.com/aplikasigas/?hl=id" target="_blank"><img src="lanpage/assets/img/logos/ig.png" width="30px" /></a>&nbsp;
                <a class="" href="https://web.facebook.com/aplikasigas?_rdc=1&_rdr" target="_blank"><img src="lanpage/assets/img/logos/fb.png" width="30px" /></a>
            </div>
        </div>
    </section>
    <!-- karir -->
    <section class="page-section bg-light" id="karir">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">{{ $karir[0]->judul }}</h2>
                <h3 class="section-subheading text-muted">{{ $karir[0]->desk }}</h3>
            </div>
            <div class="row">
                <div align="center">
                    <table>
                        <tr>
                            <td style="width: 300px;" align="center">

                                <img src="{{asset('storage/photo/'.$karir[0]->image)}}" alt="" width="150px" height="200px">
                                <h4>{{ $karir[0]->subjudul }}</h4>
                                <p class="text-muted">{{ $karir[0]->isi }}</p>

                            </td>
                            <td style="width: 300px;" align="center">

                                <img src="{{asset('storage/photo/'.$karir[1]->image)}}" alt="" width="150px" height="200px">
                                <h4>{{ $karir[1]->subjudul }}</h4>
                                <p class="text-muted">{{ $karir[1]->isi }}</p>

                            </td>
                        </tr>
                        <tr>
                            <td style="width: 300px;" align="center">>
                                <img src="{{asset('storage/photo/'.$karir[2]->image)}}" alt="" width="150px" height="200px">
                                <h4>{{ $karir[2]->subjudul }}</h4>
                                <p class="text-muted">{{ $karir[2]->isi }}</p>
                            </td>
                            <td style="width: 300px;" align="center">>
                                <img src="{{asset('storage/photo/'.$karir[3]->image)}}" alt="" width="150px" height="200px">
                                <h4>{{ $karir[3]->subjudul }}</h4>
                                <p class="text-muted">{{ $karir[3]->isi }}</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
    </section>
    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container">

            <form action="" id="userform" name="userform" class="form-horizontal" method="post">
                @csrf
                <table width="500" align="center">
                    <tr>
                        <td>
                            <div class="text-center">
                                <h2 class="section-heading text-uppercase">Hubungi Kami</h2>
                                <h3 class="section-subheading text-muted">Kritik dan saran</h3>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">
                                <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" style="width:400px;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">
                                <input type="text" class="form-control" id="email" placeholder="Email" name="email" style="width:400px;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">
                                <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject" style="width:400px;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">
                                <textarea class="form-control" id="pesan" placeholder="Pesan" name="pesan" style="width:400px;"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><br><br>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary" id="btnsimpan">Simpan</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; GAS 2023</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2" href="https://web.facebook.com/aplikasigas?_rdc=1&_rdr" aria-label="Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="https://www.instagram.com/aplikasigas/?hl=id" aria-label="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <table>
                        <tr>
                            <td align="left">
                                Unduh
                            </td>
                            <td rowspan="2">
                                &emsp;&emsp;&emsp;<a class="link-dark text-decoration-none" href="#!">Privacy Policy</a>&emsp;<a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a class="" href="https://play.google.com/store/apps/details?id=id.gas.app&amp;hl=en&pli=1" target="_blank"><img src="lanpage/assets/img/beranda/gplay.png" width="100px" /></a>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </footer>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#btnsimpan').click(function(e) {
                let nama = $('#nama').val();
                let email = $('#email').val();
                let subject = $('#subject').val();
                let pesan = $('#pesan').val();
                let aktif = 1
                console.log('nama', nama);
                if (nama == '' || nama == null) {
                    $('#btnsimpan').html('Simpan')
                    $('#btnsimpan').prop('disabled', false);
                    notifalert('Nama');
                } else if (email == '' || email == null) {
                    $('#btnsimpan').html('Simpan')
                    $('#btnsimpan').prop('disabled', false);
                    notifalert('Email');
                } else if (subject == '' || subject == null) {
                    $('#btnsimpan').html('Simpan')
                    $('#btnsimpan').prop('disabled', false);
                    notifalert('Subject');
                } else if (pesan == '' || pesan == null) {
                    $('#btnsimpan').html('Simpan')
                    $('#btnsimpan').prop('disabled', false);
                    notifalert('Pesan');
                } else {
                    $.ajax({
                        type: "post",
                        url: "{!! route('storesaran') !!}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'nama': nama,
                            'email': email,
                            'subject': subject,
                            'pesan': pesan,
                            'aktif': aktif
                        },
                        dataType: "json",
                        success: function(response) {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: (response.status == 'error') ? 'error' : 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                if (response.status == 'success') {
                                    $('#userform').trigger("reset");
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: 'Data Gagal Disimpan!',
                                text: 'Cek Data',
                                icon: 'error'
                            });
                            return;
                        }
                    });
                }
            });

            function notifalert(params) {
                Swal.fire({
                    title: 'Informasi',
                    text: params + ' Tidak Boleh Kosong',
                    icon: 'warning'
                });
                return;
            }
        });
    </script>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('lanpage/js/scripts.js')}}"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>