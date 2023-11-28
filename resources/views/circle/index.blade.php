@extends('hometest')
 @section('content')
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Circle</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Circle</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
     <!-- Main content -->
     <?php if(isset($data['myid'])){ ?>
     <a href="{{url('/fetch_data/')}}/{{$data['myid']}}/direct" class="btn btn-warning" style="    display: flex;
    justify-content: center;"><i class="far fa-pull nav-icon"></i> Pull Your Activity {{dump($user)}} </a>
    <?php } ?>
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

        <!-- /.row -->
        <!-- Main row -->
        <form action="{{route('circle.store')}}">
            <input type="submit" value="Save" class="btn btn-primary">
            <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="col-lg-6">
                        <div class="card-body input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Circle Name :</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </form>
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
