<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SI Arsip Surat</title>
  <link rel="shortcut icon" href="{{asset('img/folder.png')}}" type="image/x-icon">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  {{-- data tables --}}
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  {{-- icon --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  {{-- dropify --}}
  <link rel="stylesheet" href="{{ asset('dropify/dist/css/dropify.css') }}">
  {{-- sweetalert2 --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.min.css">
  @stack('css')
</head>
{{-- <body class="hold-transition sidebar-mini" style="padding-top: 50px; background-image: url('{{ asset('img/filebg.jpg') }}'); background-size: cover; background-position: center;"> --}}
<body style="height: 100%; margin: 0;">
<!-- Site wrapper -->
<div class="wrapper" >
  <!-- Navbar -->
  @include('layouts.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{asset('img/folder.png')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text">SI Arsip Surat</span>
    </a>

    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="
    /* background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('img/filebg.jpg') }}'); 
    background-size: cover; 
    background-position: center;
    /* background-repeat: repeat; */
    background-size: 500px;
    height: 100vh; */
   ">

    <!-- Content Header (Page header) -->
    @include('layouts.breadcrumb')

    <!-- Main content -->
    <section class="content" >
        <div class="container-fluid">
            @yield('content')
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  {{-- @include('layouts.footer') --}}
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colvis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- jQuery Mapael -->
<script src="{{ asset('adminlte/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('adminlte/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
{{-- Chart JS --}}
<script src="{{ asset('adminlte/plugins/chart.js/Chart.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
{{-- sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // untuk mengirimkan token laravel csrf pada setiap request ajax
    $.ajaxSetup({headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}});
</script>
<script>
  $(document).ready(function() {
      tambahConfirm = function(text) {
          console.log('#tambah_');
          event.preventDefault();
          Swal.fire({
              title: "Tersimpan",
              text: text,
              icon: "success"
          }).then((result) => {
              $('#tambah_').submit();
          });
      }
      updateConfirm = function(id, text) {
          console.log('#edit_'+id);
          event.preventDefault();
          Swal.fire({
              title: "Terubah",
              text: text,
              icon: "success"
          }).then((result) => {
              $('#edit_'+id).submit();
          });
      }
  });
</script>
<script src="{{ asset('dropify/dist/js/dropify.min.js') }}"></script>
@stack('js')
</body>
</html>