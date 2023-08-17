 @extends('hometest')

 @section('content')
 
 <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">View Summary </h1>
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
                <th>Riders</th>
                <th>total</th>
                <th>Strava</th>
              </thead>
              <tbody>
                @if(isset($useractivity) && count($useractivity) > 0)
                @foreach($useractivity as $k=>$v)
                  <tr>
                  <?php if($v['strava_profile_link']){ ?>
                      <td>
                      <div class="image" style="">
                      <?php if($v['strava_profile_pic']){ 
                        
                        try{
                          $img = 'myproject.dev/image.jpg';
                          $test_img = file_get_contents($v['strava_profile_pic']);
                          echo "<img src='{$img}'>";
                      }catch(Exception $e){
                          echo "<img src='img/no-img.jpg'>";
                      }
                        
                        ?>
                          <img width='30px' height="30px"  src="{{$v['strava_profile_pic']}}" class="" alt="User Image">
                      <?php }?>
                      {{$v['name']}}</td>  
                      </div>
                        
                    <?php } else {?>
                      <td>{{$v['name']}}</td>
                    <?php } ?>
                    <td>{{$v['total']}}</td>
                    <td>
                      <?php
                        // $activity = "https://kilter.fun/profile/".$v['user_id'];
                      ?>
                      
                      <a href="{{$v['strava_profile_link']}}" target='_blank' title="Strava link" >strava</a></td>  
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
    $('#activityTable').DataTable({
    order: [[1, 'desc']]
});
} );
</script>
@endsection