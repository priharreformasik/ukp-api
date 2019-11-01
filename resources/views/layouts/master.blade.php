<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Starter</title>
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@yield('css')
<!-- Google Font -->
  <link rel="stylesheet"
        href="{{url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic')}}">
</head>

  
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <div class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{asset('bower_components/admin-lte/dist/img/ugm2.png')}}" width="25"></span>   
        <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>UKP</b> UGM</span>
    </div>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" >
      <!-- Sidebar toggle button-->
      <a href="{{url('')}}" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="{{url('')}}" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('bower_components/admin-lte/dist/img/avatar3.png')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">Admin 2</span>
            </a>
            <ul class="dropdown-menu" role="menu" style="width: 50px;">
              <li style="margin:10px;"><a href="{{url('profil_detail.html')}}"><i class="fa fa-user"></i> Profil</a></li>
              <li style="margin:10px;"><a href="{{url('login.html')}}"><i class="fa fa-power-off"></i> Sign out</a></li>     
            </ul>
          </li>          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGATION</li>
        <li>
          <a href="{{url('/')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{url('')}}">
            <i class="fa fa-user"></i>
            <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('psikolog_list.html')}}"><i class="fa fa-circle-o"></i> Psikolog</a></li>
            <li><a href="{{url('klien_list.html')}}"><i class="fa fa-circle-o"></i> Klien</a></li>
            <li><a href="{{url('user/admin')}}"><i class="fa fa-circle-o"></i> Admin</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="{{url('')}}">
            <i class="fa fa-file-text-o"></i>
            <span>Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('layanan_list.html')}}"><i class="fa fa-circle-o"></i> Jenis Layanan & Tarif</a></li>
            <li><a href="{{url('tes_list.html')}}"><i class="fa fa-circle-o"></i> Jenis Tes & Tarif</a></li>
            <li><a href="{{url('kategori_list.html')}}"><i class="fa fa-circle-o"></i> Kategori Klien</a></li>
            <li><a href="{{url('jadwal_list.html')}}"><i class="fa fa-circle-o"></i> Ruang/Waktu/Jadwal</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="{{url('')}}">
            <i class="fa fa-bar-chart"></i> <span>Output</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('statistik_layanan_list.html')}}"><i class="fa fa-circle-o"></i> Statistik Layanan</a></li>
            <li><a href="{{url('statistik_psikolog_list.html')}}"><i class="fa fa-circle-o"></i> Statistik Psikolog</a></li>
            <li><a href="{{url('statistik_klien_list.html')}}"><i class="fa fa-circle-o"></i> Statistik Klien</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="{{url('')}}">
            <i class="fa fa-wrench"></i> <span>Pengaturan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('')}}"><i class="fa fa-circle-o"></i> Aproval</a></li>
            <li><a href="{{url('')}}"><i class="fa fa-circle-o"></i> Pesan</a></li>
          </ul>
        </li>        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">

      @yield('content-header')

      @yield('content')
      
  </div>
  <footer class="main-footer">
    Copyright &copy; 2018 Unit Konsultasi Psikologi UGM. All rights reserved.
  </footer>
<script src="{{asset('js/app.js')}}"></script>
<!-- bootstrap datepicker-->
<script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
</body>
</html>