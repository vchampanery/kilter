 @extends('hometest')

 @section('content')
 
 <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Strava Activity Manually</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Activity Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- filter start-->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
        <form action="{{ route('home.searchboarddata') }}" method="POST">
    	    @csrf
          <div class="input-group input-daterange">
            <!-- <input type="text" class="form-control" value="2012-04-05" name="dates"> -->
          </div>
          </form>
        </div>
        </div>
      </div>
    </div>
    <!-- filter end-->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-lg-4 col-sm-12">
          
            <form action="{{ route('home.addstravaactivity') }}" method="POST">
            @csrf
              <?php 
              // $getMonth = [];
              // foreach (range(1, 12) as $m) {
              //     $getMonth[] = date('m - F', mktime(0, 0, 0, $m, 1));
              // }
              ?>
              <div class="row">
                <div class="col-lg-4 col-sm-4"> 
                      Total kilometer :
                </div>
                <div class="col-lg-8 col-sm-8">
                      <input type="number" step="0.01" name="distance" id="distance" value="">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-sm-4">
                      Today activity :
                </div>
                  <div class="col-lg-8 col-sm-8">
                      <input type="url" name="url" id="url" value="">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-4 col-sm-4">
                  <input type="submit" text="submit" value="submit">
                </div>
              </div>
            </form>

        </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
 

    {{--<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>--}}
 {{--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">--}}
 {{--<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>--}}
    <script type="text/javascript" class="init">
      
 $(document).ready(function() {
    $('#activityTable').DataTable();
   
    $('input[name="dates"]').daterangepicker();
} );
</script>
@endsection