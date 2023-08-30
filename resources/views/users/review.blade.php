@extends('hometest')   
 @section('content')
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">User Profile</h1> 
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
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
        <form action="{{route('user.saveReview')}}">
        <!-- @if((auth::user()->id==$data['user']->id) || (auth::user()->id==7) || (auth::user()->id==11) || (auth::user()->id==288) ) -->
        <input type="submit" value="Save" class="btn btn-primary">
        <!-- @endif -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card mb-12">
          <div class="card-body text-center">
              
          <!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" -->
          
          
            <img src="{{$data['profile_pic']}}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;"/>
              <h5 class="my-3"> {{isset($data['user']->name)?$data['user']->name:'-' }}</h5>
              <!-- <p class="text-muted mb-1">Full Stack Developer</p> -->
              <p class="text-muted mb-4">
                <input type="hidden" name="id" value="{{$data['user']->id}}" > 
                  {{isset($data['user']->city)?$data['user']->city:'-' }},{{isset($data['user']->state)?$data['user']->state:'-' }}</p>
                  <textarea name="review" value="" cols="50" rows="10" required 
                  placeholder="Share your experiance here..."></textarea>
              </p>
              
              @if($data['review'])
              @foreach($data['review'] as $rkey=>$rvlu)
              <p class="text-muted mb-4">
                <b>{{$rvlu['review']}}</b> <br>
                &nbsp;&nbsp;&nbsp; - {{$rvlu['name']}} <br>
                ({{$rvlu['date']}})
              </p>
              @endforeach
              @endif
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
