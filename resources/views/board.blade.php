 @extends('hometest')

 @section('content')
 
 <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">all Page</h1>
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
            <input type="text" class="form-control" value="2012-04-05" name="dates">
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
        <div class="col-lg-12">
          
            <table id="activityTable">
              <thead>
                <th>Name</th>
                
                <th>Total Rides </th>
                <th>Distance (km)</th>
                <th>average_speed(km/h)</th>
                <th>max_speed(km/h)</th>
                <th>activity</th>
              </thead>
              <tbody>
                @foreach($useractivity as $k=>$v)
                  <tr>
                    <td>{{$v['name']}}</td>
                    <td>{{$v['total_ride']}}</td>
                    <td>{{number_format($v['distance']/1000, 2)}}</td>
                    <td>{{number_format(3.6 *$v['average_speed'], 2)}}</td> 
                    <td>{{number_format(3.6 *$v['max_speed'], 2)}}</td>
                    <td><a href="{{url('/fetch_data/')}}/{{$v['id']}}/direct" class="btn btn-default"><i class="far fa-pull nav-icon"></i> Pull</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>


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