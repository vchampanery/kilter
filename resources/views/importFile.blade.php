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
     <?php if(isset($data['myid'])){ ?>
     <a href="{{url('/fetch_data/')}}/{{$data['myid']}}/direct" class="btn btn-warning" style="    display: flex;
    justify-content: center;"><i class="far fa-pull nav-icon"></i> Pull Your Activity</a>
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
        <div class="row">
        <h6> Import and Export Excel data to
           database Using Laravel 5.8
    </h6>
    <div class="container">
        <div class="card bg-light mt-3">
            <div class="card-header">
                Import and Export Excel data
                  to database Using Laravel 5.8
            </div>
            <div class="card-body">
                <form action="{{ url('/import') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file"
                           class="form-control">
                    <br>
                    <button class="btn btn-success">
                          Import User Data
                       </button>
                    <a class="btn btn-warning"
                       href="{{ url('/export') }}">
                              Export User Data
                      </a>
                </form>
            </div>
        </div>
    </div>
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
