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
        <form action="{{route('user.saveProfile')}}">
        @if((auth::user()->id==$data['user']->id) || (auth::user()->id==7) || (auth::user()->id==11) || (auth::user()->id==288) )
        <input type="submit" value="Save" class="btn btn-primary">
        @endif
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
              
          <!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" -->
          
          @if((auth::user()->id==$data['user']->id) || (auth::user()->id==7) || (auth::user()->id==11) || (auth::user()->id==288))
          <!-- <form action="{{route('user.saveProfile')}}"> -->
            <img src="{{$data['profile_pic']}}" alt="avatar"
            class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"> 
            <input type="hidden" name="id" value="{{$data['user']->id}}" > 
            <input type="text" name="name" value="{{isset($data['user']->name)?$data['user']->name:'-' }}" > 
            </h5>
            <!-- <p class="text-muted mb-1">Full Stack Developer</p> -->
            <p class="text-muted mb-4">
              
                @php
                $cityselect = isset($data['user']->city)?$data['user']->city:'-';
                $stateselect = isset($data['user']->state)?$data['user']->state:'-';
                $genderselect = isset($data['user']->gender)?$data['user']->gender:'-';
                $chapterselect = isset($data['user']->chapter)?$data['user']->chapter:'-';
                @endphp
              <select name="city">
                @foreach($city as $k=>$v)
                <option value="{{$k}}" {{($k==$cityselect)?'selected=selected':''}}">{{$v}}</option>
                @endforeach
              </select>,
              <select name="state">
                @foreach($state as $k=>$v)
                <option value="{{$k}}" {{($k==$stateselect)?'selected=selected':''}}">{{$v}}</option>
                @endforeach
              </select>,
              
              </p>
              <h5 class="my-3"> 
              <select name="gender">
                @foreach($gender as $k=>$v)
                <option value="{{$k}}" {{($k==$genderselect)?'selected=selected':''}}">{{$v}}</option>
                @endforeach
              </select> 
            </h5>
            <div class="d-flex justify-content-center mb-2">
              <!-- <button type="button" class="btn btn-primary">Follow</button>
              <button type="button" class="btn btn-outline-primary ms-1">Message</button> -->
            </div>
            
          <!-- </form> -->
          @else
          <img src="{{$data['profile_pic']}}" alt="avatar"
            class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"> {{isset($data['user']->name)?$data['user']->name:'-' }}</h5>
            <!-- <p class="text-muted mb-1">Full Stack Developer</p> -->
            <p class="text-muted mb-4">
              {{isset($data['user']->city)?$data['user']->city:'-' }},{{isset($data['user']->state)?$data['user']->state:'-' }}</p>
            <div class="d-flex justify-content-center mb-2">
              <!-- <button type="button" class="btn btn-primary">Follow</button>
              <button type="button" class="btn btn-outline-primary ms-1">Message</button> -->
            </div>
          @endif
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
          @if((auth::user()->id==$data['user']->id) || (auth::user()->id==7) || (auth::user()->id==11) || (auth::user()->id==288) )
          <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <!-- <i class="fas fa-globe fa-lg text-warning"></i> -->
                
                <i class="fab fa-strava fa-lg" style="color: #fc5200;"></i>
                <p class="mb-0">
                    <input type="text" name="strava_link" value="{{isset($data['user']->strava_link)?$data['user']->strava_link:'-'}}">
                </p>
              </li>
              <!-- <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                <p class="mb-0">mdbootstrap</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                <p class="mb-0">@mdbootstrap</p>
              </li> -->
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                
                <p class="mb-0">
                <input type="text" name="instagram" value="{{isset($data['user']->instagram)?$data['user']->instagram:'-'}}">
                </p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                <p class="mb-0">
                    <input type="text" name="facebook" value="{{isset($data['user']->facebook)?$data['user']->facebook:'-'}}">
                </p>
              </li>
            </ul>
          @else
          <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <!-- <i class="fas fa-globe fa-lg text-warning"></i> -->
                <i class="fab fa-strava fa-lg " style="color: #fc5200;"></i>
                <p class="mb-0"><a target="_blank" href="{{isset($data['strava_profile_link'])?$data['strava_profile_link']:'#'}}">{{isset($data['strava_profile_link'])?'strava':'-'}}</a></p>
              </li>
              <!-- <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                <p class="mb-0">mdbootstrap</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                <p class="mb-0">@mdbootstrap</p>
              </li> -->
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                <p class="mb-0">{{isset($data['user']->instagram)?$data['user']->instagram:'-'}}</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                <p class="mb-0">{{isset($data['user']->facebook)?$data['user']->facebook:'-'}}</p>
              </li>
            </ul>
          @endif
            
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
        @if((auth::user()->id==$data['user']->id) || (auth::user()->id==7) || (auth::user()->id==11)  || (auth::user()->id==288)   )
        <!-- <form action="{{route('user.saveProfile')}}"> -->
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">
                {{isset($data['user']->name)?$data['user']->name:'-' }}
                </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{isset($data['user']->email)?$data['user']->email:'-' }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Mobile</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">
                <input type="text" name="mobile" value="{{isset($data['user']->mobile)?$data['user']->mobile:'-' }}" >  
                </p>
              </div>
            </div>
            <hr>  
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Chapter</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">
                  <select name="chapter">
                    @foreach($chapter as $k=>$v)
                    <option value="{{$k}}" {{($k==$chapterselect)?'selected=selected':''}}">{{$v}}</option>
                    @endforeach
                  </select>  
                </p>
              </div>
            </div>
            <!-- <hr> -->
            <!-- <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
              </div>
            </div> -->
          </div>
        <!-- </form> -->
        @else
        <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{isset($data['user']->name)?$data['user']->name:'-' }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{isset($data['user']->email)?$data['user']->email:'-' }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Mobile</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{isset($data['user']->mobile)?$data['user']->mobile:'-' }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Chapter</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{isset($data['user']->chapter)?$data['user']->chapter:'-' }}</p>
              </div>
            </div>
            <!-- <hr> -->
            <!-- <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
              </div>
            </div> -->
          </div>
          @endif
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">Achivements</span>
                </p>
                <p class="mb-1" style="font-size: .77rem;">30's <span style="float: right;">{{$data['30']}}</span></p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">50's <span style="float: right;">{{$data['50']}}</span></p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">100's <span style="float: right;">{{$data['100']}}</span></p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Highest <span style="float: right;"> {{number_format($data['highest']/1000, 2)}} Kms</span></p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Total <span style="float: right;">{{number_format($data['total']/1000, 2)}} Kms</span></p>
                <div class="progress rounded mb-2" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">Recent</span>Activities
                </p>
                @foreach($data['lastActivity'] as $k=>$v)
                
                <p class="mt-4 mb-1" style="font-size: .77rem;">{{date('d-M-y', strtotime($v['start_date_local']))}} 
                <span style="float: right;">{{number_format($v['distance']/1000, 2)}} Kms</span></p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                @endforeach
                @php $url = "/activity/".$data['user']->id; @endphp
                <a href="{{url($url)}}" target="_blank">more....</a>
                <!-- <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                <div class="progress rounded mb-2" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div> -->
              </div>
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
