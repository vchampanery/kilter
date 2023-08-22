 @extends('hometest')

 @section('content')
 
 <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">SACC2023</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">SACC2023</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row" style="margin:10px;">
        @foreach($total1 as $k=>$v)
            <div class="col-lg-3 border ">
                <h3>{{$k}} KMs</h3>
                <b>{{$v}}</b>
              </div>  
            @endforeach
            <br>
</div>
            <div class="row">
        <div class="col-lg-12">
            
            

          
            <table id="activityTable">
              <thead>
                <th>name</th>
                <th>id</th>
                <th>total kilometer</th>
                <th>total Ride</th>
                <th>Daily 300</th>
                <th>Total 300</th>
                <th>Daily 200</th>
                <th>Total 200</th>
                <th>Daily 100</th>
                <th>Total 100</th>
                <th>Daily 75</th>
                <th>TOTAL 75</th>
                <th>Daily 50</th>
                <th>TOTAL 50</th>
              </thead>
              <tbody>
                @if(isset($data) && count($data) > 0)
                @foreach($data as $k=>$v)
                  <tr>
                    <td>{{$v['name']}}</td>
                    <td>{{$v['id']}}</td>
                    <td>{{number_format($v['total']/1000,2)}}</td>
                    <td>{{$v['total_ride']}}</td>
                    <td>{{$v['300']}}</td>
                    <td>{{$v['total300']}}</td>
                    <td>{{$v['200']}}</td>
                    <td>{{$v['total200']}}</td> 
                    <td>{{$v['100']}}</td>
                    <td>{{$v['total100']}}</td>
                    <td>{{$v['75']}}</td>
                    <td>{{$v['total75']}}</td>
                    <td>{{$v['50']}}</td>
                    <td>{{$v['total50']}}</td>
                    
                  </tr>
                @endforeach
                @endif
              </tbody>
            </table>

            <table>
              <thead>
                <th>Kilometer</th>
                <th>total</th>
              </thead>
              <tbody>
              @foreach($total1 as $k=>$v)
                <tr>
                  <td>{{$k}}</td>
                  <td>{{$v}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
 
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
 <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script> 
 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
 
     <script type="text/javascript" class="init">
      
 $(document).ready(function() {
    $('#activityTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
</script>
@endsection