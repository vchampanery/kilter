@extends('hometest')   
 @section('content')
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Personal Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Personal Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
     <!-- Main content -->
    
      <div class="container-fluid center">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-info center">
              <div class="inner">
                <h3>Strava</h3>
                <p><a href="http://www.strava.com/oauth/authorize?
client_id=75321&response_type=code&redirect_uri=
https://kilter.fun/strava/getauth&approval_prompt=force&scope=read_all&scope=activity:read_all" 
class="btn btn-outline-warning">Strava Connect</a>
</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
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
