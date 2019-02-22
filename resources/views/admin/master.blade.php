@include('admin.inc.header')

<!-- Left side column. contains the logo and sidebar -->
@include('admin.inc.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    @yield('content')

    <!-- Main content -->
    <section class="content">
      
      @yield('content-full')

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          
          @yield('dashboard-left-item')

        </section>
        <!-- /.Left col -->

        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">
          
          @yield('dashboard-right-item')

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  @include('admin.inc.footer')