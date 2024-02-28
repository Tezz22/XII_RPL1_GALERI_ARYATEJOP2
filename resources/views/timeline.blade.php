<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GALERI FOTO</title>

  <!-- Google Font: Source Sans Pro -->
  {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
  <!-- Font Awesome -->
  <link rel="stylesheet" href="p/plugins/fontawesome-free/css/all.min.css">
  <!-- AdminLTE css -->
  <link rel="stylesheet" href="p/dist/css/adminlte.min.css">
</head>
<body>
<!-- Site wrapper -->
<div>
  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-cyan navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="timeline" class="nav-link"><strong>{{ Auth::user()->name }}</strong></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">|</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" data-toggle="modal" data-target="#uploadfoto">Upload Foto</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout" role="button">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
      
    </ul>
  </nav>

  <div class="modal fade" id="uploadfoto">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="background: cyan">
          <h4 class="modal-title">Upload Foto Wak</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="uploadfoto" method="post" enctype="multipart/form-data">
            @csrf
            <label for="">Judul :</label>
            <input type="text" class="form-control" name="judul">
            <label for="">Deskripsi :</label>
            <input type="text" class="form-control" name="deskripsi">
            <label for="">Foto :</label>
            <input type="file" class="form-control" name="foto">
          
        </div>
        <div class="modal-footer justify-content-between" style="background: cyan">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Timeline</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Timeline</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-red">Foto Linimasa Anda</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              
              <div>
                <i class="fa fa-camera bg-purple"></i>
                <div class="timeline-item">
                  <span class="time"></span>
                  <h3 class="timeline-header"><a href="#">{{ Auth::user()->username }}</a> |  jelajahi foto anda</h3>
                  @foreach ($fototerbaru as $fb)
                  <div class="timeline-body">
                    <img src="{{ url('foto/'.$fb->foto) }}" alt="" width="250" height="150">
                  </div>
                  @endforeach
                </div>
              </div>
             
              

              @foreach ($fototerbaru as $fotbar)
              <div class="time-label">
                <span class="bg-green">{{ $fotbar->tanggal }}</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fa fa-camera bg-purple"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i>{{ $fotbar->tanggal }}</span>
                  <h3 class="timeline-header">
                    <a href="#"><strong>{{ $fotbar->judul }}</strong></a> | 
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editfoto{{ $fotbar->id }}">Edit</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusfoto{{ $fotbar->id }}">Hapus</button>
                  </h3>

                  <div class="modal fade" id="editfoto{{ $fotbar->id }}">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header" style="background: yellow">
                          <h4 class="modal-title">Edit Foto Wak</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{ url('editfoto/'.$fotbar->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="">Judul :</label>
                            <input type="text" class="form-control" value="{{ $fotbar->judul }}" name="judul">
                            <label for="">Deskripsi :</label>
                            <input type="text" class="form-control" value="{{ $fotbar->deskripsi }}" name="deskripsi">
                            <label for="">Foto :</label>
                            <input type="file" class="form-control" value="{{ $fotbar->foto }}" name="foto">
                          
                        </div>
                        <div class="modal-footer justify-content-between" style="background: yellow">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>

                  <div class="modal fade" id="hapusfoto{{ $fotbar->id }}">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header" style="background: red">
                          <h4 class="modal-title">Hapus Foto Wak</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{ url('hapusfoto/'.$fotbar->id) }}" method="get" enctype="multipart/form-data">
                           <p> Yakin Di Hapus??? </p>
                          
                        </div>
                        <div class="modal-footer justify-content-between" style="background: red">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>


                  <div class="timeline-body">
                    <img src="{{ url('foto/'.$fotbar->foto) }}" alt="" width="250" height="150">
                  </div>
                  <div class="timeline-footer">
                    {{ $fotbar->deskripsi }}
                  </div>
                </div>
              </div>
              @endforeach
              
        
              <!-- END timeline item -->
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  {{-- <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer> --}}

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="p/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="p/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="p/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="p/dist/js/demo.js"></script> --}}
</body>
</html>
