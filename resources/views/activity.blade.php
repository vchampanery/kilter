 @extends('hometest')

 @section('content')
 
 <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Activity Page</h1>
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

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
          
            <table id="activityTable">
              <thead>
                <th>Id</th>
                <th>Ride Date</th>
                
                <th>distance (km)</th>
                <th>average_speed(km/h)</th>
                <th>max_speed(km/h)</th>
                <th>Strava</th>
              </thead>
              <tbody>
                @if(isset($useractivity) && count($useractivity) > 0)
                @foreach($useractivity as $k=>$v)
                  <tr>
                    <td>{{ $v->id*24*365 }}</td>
                    <td>{{ date('d-m-Y', strtotime($v->start_date_local))}}</td>
                    <td>{{number_format($v->distance/1000, 2)}}</td>
                    <td>{{number_format(3.6 *$v->average_speed, 2)}}</td> 
                    <td>{{number_format(3.6 *$v->max_speed, 2)}}</td>
                    <td>
                      <?php
                        $json = json_decode($v->raw_data);
                        $activity = "https://www.strava.com/activities/".$json->id;
                      ?>
                      <a target="_blank"  href={{$activity}} >strava</a>
                    </td>
                  </tr>
                @endforeach
                @endif
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
    // $('#activityTable').DataTable();
    $('#activityTable').DataTable({
      order: [[0, 'desc']]
  });
} );
</script>
@endsection