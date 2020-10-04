<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>لوحة الإدارة - مكتبة حسوب</title>

  <!-- Custom fonts for this template-->
  <link href="{!! asset('theme/vendor/fontawesome-free/css/all.min.css') !!}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{!! asset('theme/css/sb-admin-2.min.css') !!}" rel="stylesheet">
    <style>
        .sidebar.toggled .nav-item .nav-link {
            text-align: center !important;
        }
        .sidebar #sidebarToggle::after {
            content: '\f105';
        }
        .sidebar.toggled #sidebarToggle::after {
            content: '\f104';

        }
    </style>
    @yield('head')
</head>

<body id="page-top" dir="rtl" style="text-align: right">

  <!-- Page Wrapper -->
  <div id="wrapper">
    @include('theme.sidebar')


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
        @include('theme.header')

        <!-- Begin Page Content -->
        <div class="container-fluid">
          @if(Session::has('flash_message'))
              <div class="p-3 mb-2 bg-success text-white rounded text-center">
                  {{ session('flash_message') }}
              </div>  
          @endif
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
          </div>

          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
        @include('theme.footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">هل أنت جاهز للمغادرة؟</h5>
        </div>
        <div class="modal-body">إذا كنت متأكد أنك تريد إنهاء الجلسة اضغط على زر خروج</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
          <a class="btn btn-primary" 
             href="{{ route('logout') }}"
             onclick="event.preventDefault();
             document.getElementById('logout-form').submit();"
          >خروج</a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{!! asset('theme/vendor/jquery/jquery.min.js') !!}"></script>
  <script src="{!! asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{!! asset('theme/vendor/jquery-easing/jquery.easing.min.js') !!}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{!! asset('theme/js/sb-admin-2.min.js') !!}"></script>

  <!-- Page level plugins -->
  <script src="{!! asset('theme/vendor/chart.js/Chart.min.js') !!}"></script>

  <!-- Page level custom scripts -->
  <script src="{!! asset('theme/js/demo/chart-area-demo.js') !!}"></script>
  <script src="{!! asset('theme/js/demo/chart-pie-demo.js') !!}"></script>
  @yield('script')
</body>

</html>
