<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>UKP | Unit Konsulasi Psikologi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('bower_components/admin-lte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('bower_components/admin-lte/dist/css/skins/_all-skins.min.css')}}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('bower_components/admin-lte/plugins/iCheck/all.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('bower_components/admin-lte/plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">


  <link href="{{asset('css/style.css')}}" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
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
          @guest
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              <li class="nav-item">
                  @if (Route::has('register'))
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  @endif
              </li>
          @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} 
                  @if (!Auth::user()->foto)
                    <img class="user-image" src="{{asset('images/user.png')}}" alt="User Image">
                  @else
                    <img class="user-image" src="{{asset('images/'.Auth::user()->foto.'')}}" alt="User Image">
                  @endif
              </a>

              <ul class="dropdown-menu" role="menu" style="width: 50px;">
                <li style="margin:3px;">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="{{ url('profile/'.Auth::user()->id.'') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('profile-form').submit();"><i class="icon ion-person" style="padding-right:3px;"></i>
                      {{ __('Profile') }}
                  </a>
                </li>
                  <form id="profile-form" action="{{ url('profile/'.Auth::user()->id.'') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                  
                <li style="margin:3px;">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="icon ion-power" style="padding-right:3px;"></i>
                      {{ __('Logout') }}
                  </a>
                </li>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                
                </ul>
            </li>
            <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          @endguest
          <!-- User Account: style can be found in dropdown.less 
          <li class="dropdown user user-menu">
            <a href="{{url('')}}" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('bower_components/admin-lte/dist/img/avatar3.png')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">Admin 2</span>
            </a>
            <ul class="dropdown-menu" role="menu" style="width: 50px;">
              <li style="margin:10px;"><a href="{{url('profil_detail.html')}}"><i class="fa fa-user"></i> Profil</a></li>
              <li style="margin:10px;"><a href="{{url('login.html')}}"><i class="fa fa-power-off"></i> Sign out</a></li>     
            </ul>
          </li>  -->       
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
        <li class="{{ request()->is('home') ? 'active' : ''}}">
          <a href="{{url('/home')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{url('#')}}">
            <i class="fa fa-user"></i>
            <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('user/admin')}}"><i class="fa fa-circle-o"></i> Admin</a></li>
            <li><a href="{{url('user/klien')}}"><i class="fa fa-circle-o"></i> Klien</a></li>
            <li><a href="{{url('user/psikolog')}}"><i class="fa fa-circle-o"></i> Psikolog</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="{{url('#')}}">
            <i class="fa fa-file-text-o"></i>
            <span>Data Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('data/layanan')}}"><i class="fa fa-circle-o"></i> Jenis Layanan & Tarif</a></li>
            <li><a href="{{url('data/kategori')}}"><i class="fa fa-circle-o"></i> Kategori Klien</a></li>
            <li><a href="{{url('data/asesmen')}}"><i class="fa fa-circle-o"></i> Asesmen</a></li>
            <li><a href="{{url('data/ruangan')}}"><i class="fa fa-circle-o"></i> Ruangan</a></li>
            <li><a href="{{url('data/sesi')}}"><i class="fa fa-circle-o"></i> Sesi</a></li>
            <li><a href="{{url('data/status')}}"><i class="fa fa-circle-o"></i> Status</a></li>
          </ul>
        </li>
        <li class="{{ request()->is('jadwal') ? 'active' : ''}}">
          <a href="{{url('jadwal')}}"><i class="fa fa-calendar-check-o"></i> <span>Jadwal Konsultasi</span></a>
        </li>
        <li class="{{ request()->is('transaksi') ? 'active' : ''}}">
          <a href="{{url('transaksi')}}"><i class="fa fa-money"></i> <span>Transaksi</span></a>
        </li>
        <li class="treeview">
          <a href="{{url('#')}}">
            <!-- <i class="fa fa-bar-chart"></i> <span>Report</span> -->
            <i class="fa fa-window-restore"></i> <span>Rekap Konsultasi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('statistik/statistik_layanan')}}"><i class="fa fa-circle-o"></i> Layanan</a></li>
            <li><a href="{{url('statistik/statistik_psikolog')}}"><i class="fa fa-circle-o"></i> Psikolog</a></li>
            <li><a href="{{url('statistik/statistik_klien')}}"><i class="fa fa-circle-o"></i> Klien</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="{{url('#')}}">
            <i class="fa fa-wrench"></i> <span>Pengaturan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('pengaturan/aproval')}}"><i class="fa fa-circle-o"></i> Approval Jadwal</a></li>
            <!-- <li><a href="{{url('pengaturan/aproval/psikolog')}}"><i class="fa fa-circle-o"></i> Approval Psikolog</a></li> -->
            <li><a href="{{url('pengaturan/pesan')}}"><i class="fa fa-circle-o"></i> Pesan</a></li>
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
    Copyright &copy; {{ now()->year }} Unit Konsultasi Psikologi UGM. All rights reserved.
  </footer>
</div>
</div>
<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Select2 -->
<!-- <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script> -->
<!-- InputMask -->
<script src="{{asset('bower_components/admin-lte/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('bower_components/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('bower_components/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker-->
<script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('bower_components/admin-lte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('bower_components/admin-lte/dist/js/demo.js')}}"></script>
<script src="{{asset('js/inputmask/jquery.inputmask.bundle.js')}}"></script>
<!-- Page script -->
@include('sweetalert::alert')`
<!-- Select2 -->
<script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>

<script>
  $(function () {
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
  })
</script>

<script>
  $(function () {
    //Date picker
    $('#datepicker1').datepicker({
      autoclose: true
    })
  })
</script>

<script type="text/javascript">
      var url = window.location;
      // for sidebar menu but not for treeview submenu
      $('ul.sidebar-menu a').filter(function() {
          return this.href == url;
      }).parent().siblings().removeClass('active').end().addClass('active');
      // for treeview which is like a submenu
      $('ul.treeview-menu a').filter(function() {
          return this.href == url;
      }).parentsUntil(".sidebar-menu > .treeview-menu").siblings().removeClass('active menu-open').end().addClass('active menu-open');
</script>

<script>
  $('.currency').inputmask("numeric", {
                radixPoint: ",",
                groupSeparator: ".",
                digits: 2,
                autoGroup: true,
                rightAlign: false,
                removeMaskOnSubmit: true,
                oncleared: function () { self.Value(''); }
            });
</script>
<script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.trigger('confirm');
                }
            });

            $(document).on('confirm', function (e) {
                var ele = e.target;
                e.preventDefault();

                $.ajax({
                    url: ele.href,
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        if (data['success']) {
                            location.reload();
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });
                return false;
            });
        });
    </script>
@yield('javascript')

</body>
</html>
