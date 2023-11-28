@extends('hometest')
 @section('content')
 <style>
    span.select2-selection.select2-selection--multiple{
    padding: 6px;
    border: 1px solid #ced4da;
}

    </style>
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Circle</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Circle</li>
              <li class="breadcrumb-item active">Create</li>
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

                                <input type="text" class="form-control" aria-label="Default"
                                aria-describedby="inputGroup-sizing-default" name="name" id="name">
                            </div>
                        </div>
                        <div class="card-body input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Circle Member :</span>

                                <select
                                    class="js-example-basic-multiple form-control p-8"
                                    style="padding:8px;"
                                    aria-label="Default"
                                    aria-describedby="inputGroup-sizing-default"
                                    name="member[]"
                                    id="member"
                                    multiple="multiple">
                                    @foreach ( $userList as $kul=>$user )
                                        <option value="{{ $user['id'] }}">{{ $user['name'] }}  {{$user['city']?' - '.$user['city']:'' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </form>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->

      <script type="text/javascript" class="init">

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({ closeOnSelect: false });
        });
       </script>

 @endsection

