 @extends('hometest')

 @section('content')
 
 <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Member</h1>
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
        <div class="col-lg-12">
          <div class="table-responsive">
            <table id="activityTable">
              <thead>
                <th>Name</th>
                <!-- <th>Rank#</th> -->
                
                <!-- <th>Total Rides </th>
                <th>Distance (km)</th>
                <th>average_speed(km/h)</th>
                <th>max_speed(km/h)</th>
                <th>activity</th> -->
                <th>Total Kms</th>
                <th>300 </th>
                <th>200 </th>
                <th>100</th>
                <th>75</th>
                <th>50</th>
                <th>Total Rides </th>
                <th>Longest Rides </th>
                @if(Auth::user()->email == 'vchampanery@gmail.com')
                <th>email</th>
                <th>id</th>
                <th>Action</th>
                @endif
              </thead>
              <tbody>
                @php $i=0; @endphp
                @foreach($useractivity as $k=>$v)
                  <tr>
                    <!-- <td>{{$v['name']}}</td>
                    <td>{{$v['total_ride']}}</td>
                    <td>{{number_format($v['distance']/1000, 2)}}</td>
                    <td>{{number_format(3.6 *$v['average_speed'], 2)}}</td> 
                    <td>{{number_format(3.6 *$v['max_speed'], 2)}}</td>
                    <td><a href="{{url('/fetch_data/')}}/{{$v['id']}}/direct" class="btn btn-default"><i class="far fa-pull nav-icon"></i> Pull</a></td> -->
                   
                      <td>
                      <div class="image" style="">
                      <?php if($v['strava_profile_pic']){ ?>
                          <img width='30px' height="30px"  src="{{$v['strava_profile_pic']}}" class="" alt="User Image">
                      <?php }
                        $url = "/profile/".$v['id'];
                      ?>

                      <a href="{{url($url)}}" target='_blank' title="Strava link" >{{$v['name']}}</a></td>  
                      </div>
                        

                    <!-- <td>{{++$i}}</td> -->
                    <td>{{number_format($v['distance']/1000, 2)}}</td>
                    <td>{{$v['total_300']}}</td>
                    <td>{{$v['total_200']}}</td>
                    <td>{{$v['total_100']}}</td>
                    <td>{{$v['total_75']}}</td>
                    <td>{{$v['total_50']}} </td>
                    <td>{{$v['total_ride']}}</td>
                    <td>{{number_format($v['longest']/1000, 2)}}</td>
                    <!-- <td> </td> -->
                  
                    @if(Auth::user()->email == 'vchampanery@gmail.com')
                    <td>{{$v['email']}}</td>
                    <td>{{$v['id']}}</td>
                    <td>
                      <a href="{{url('/strava_reset/')}}/{{$v['id']}}" class="btn btn-default">
                        <i class="far fa-pull nav-icon"></i> reset Strava
                      </a>
                      <a href="{{url('/updatedefualtpassword/')}}/{{$v['id']}}" class="btn btn-default">
                        <i class="far fa-pull nav-icon"></i> reset password
                      </a>
                      <a href="{{url('/fetch_data/')}}/{{$v['id']}}/admin" class="btn btn-default"><i class="far fa-pull nav-icon"></i> Pull</a>
                    </td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
 

   
    <script type="text/javascript" class="init">
      
 $(document).ready(function() {
  $('#activityTable').DataTable({
      order: [[1, 'desc']]
  });
   
   
    $('input[name="dates"]').daterangepicker();
} );
</script>
@endsection