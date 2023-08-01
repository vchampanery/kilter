@extends('hometest')   
 @section('content')
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Current Month Board</h1> 
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Current Month Board</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
     <!-- Main content -->
     <a href="{{url('/fetch_data/')}}/{{$data['id']}}/direct" class="btn btn-warning" style="    display: flex;
    justify-content: center;"><i class="far fa-pull nav-icon"></i> Pull Your activity</a>
      <br>
      <div class="container-fluid">
      @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{isset($data['total_rides'])?$data['total_rides']:0}}</h3>
                <p>Total Rides</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{url('/first_page')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{number_format($data['total_km']/1000, 2)}}<sup style="font-size: 20px">Kms</sup></h3>

                <p>Total Kilometers</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{url('/first_page')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{number_format(3.6 *$data['total_avg_speed'], 2)}}<sup style="font-size: 20px">Km/h</sup></h3>

                <p>Avg speed</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{url('/first_page')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{number_format($data['total_longest_ride']/1000, 2)}}<sup style="font-size: 20px">Kms</sup></h3>

                <p>Longest Ride of the Month</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{url('/first_page')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{number_format(3.6 *$data['max_speed_ride'], 2)}}<sup style="font-size: 20px">Km/h</sup></h3>

                <p>Fastest - Average speed of ride</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{url('/first_page')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
      
      
    <!-- <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> -->
    <!-- Summernote -->
<!-- <script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script> -->
<!-- daterangepicker -->
<!-- <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script> -->
<!-- <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="{{asset('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script> -->
 @endsection
