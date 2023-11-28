@extends('hometest')
 @section('content')
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $data['pagetitle'] }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ $data['pagetitle'] }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
     <!-- Main content -->
     <form action="{{ route('home.searchboarddata') }}" method="POST">
      @csrf
      <div class="input-group input-daterange">
        {{-- <input type="text" class="form-control" value="2012-04-05" name="dates">  --}}
      </div>
      </form>
      @if($data['pagetitle'] != 'Current Year Board')
     <?php if(isset($data['myid'])){ ?>
     <a href="{{url('/fetch_data/')}}/{{$data['myid']}}/direct" class="btn btn-warning" style="    display: flex;
    justify-content: center;"><i class="far fa-pull nav-icon"></i> Pull Your Activity</a>
    <?php } ?>
    @endif
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
                <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{number_format($data['today_ride']/1000, 2)}}<sup style="font-size: 20px">Kms</sup></h3>

                    <p>Today's Ride</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{url('/activity')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
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
                <a href="{{url('/activity')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                <a href="{{url('/activity')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                <a href="{{url('/activity')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                <a href="{{url('/activity')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                <div class="inner">
                    <h3>{{number_format(3.6 *$data['max_speed_ride'], 2)}}<sup style="font-size: 20px">Km/h</sup></h3>

                    <p>Fastest - Average speed of ride</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{url('/activity')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
          <!-- ./col -->
        </div>
        @if($data['pagetitle'] == 'Current Year Board')
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Stats
                    {{-- <input type="Text" class="daterange"> --}}
                  </h3>
                  <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                      <li class="nav-item">
                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Kilometer</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#sales-chart" data-toggle="tab">Rides</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart"
                         style="position: relative; height: 300px;">
                        <canvas id="activity-chart-canvas" height="300" style="height: 300px;"></canvas>
                     </div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                      <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div>
                  </div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->

            </section>
        </div>
        @endif
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


<script type="text/javascript" class="init">

  $(document).ready(function() {
     $('input[name="dates"]').daterangepicker();
    //Kilo
        var rides = {{ $data['monthlyRides']}};
        var kilometer = {{ $data['monthlyKilometer']}};
        console.dir(rides);
        console.dir(kilometer);
        var salesChartCanvas = document.getElementById('activity-chart-canvas').getContext('2d');
        var salesChartData = {
        labels  : [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: [
        {
            label               : 'Kilometer',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : true,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : kilometer
        },
        // {
        //     label               : 'Kilometer',
        //     backgroundColor     : 'rgba(210, 214, 222, 1)',
        //     borderColor         : 'rgba(210, 214, 222, 1)',
        //     pointRadius         : false,
        //     pointColor          : 'rgba(210, 214, 222, 1)',
        //     pointStrokeColor    : '#c1c7d1',
        //     pointHighlightFill  : '#fff',
        //     pointHighlightStroke: 'rgba(220,220,220,1)',
        //     data                : kilometer
        // },
        ]


        }

        var salesChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: true
            },
            plugins: {
            datalabels: {
                anchor: 'end',
                align: 'top',
                formatter: function(value, context) {
                    return value; // Display the actual value on top of the bar
                }
            }
            },
            scales: {
                xAxes: [{
                    gridLines : {
                    display : false,
                    }
                }],
                yAxes: [{
                    gridLines : {
                    display : false,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas, {
            type: 'bar',
            data: salesChartData,
            options: salesChartOptions
            }
        )
    //donut
    var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
            var pieData        = {
                labels: [
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
                ],
                datasets: [
                {
                    data: rides,
                    backgroundColor : [
                        '#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd', '#8c564b',
                '#e377c2', '#7f7f7f', '#bcbd22', '#17becf', '#FF5733', '#33FF57'
                    ],
                }
                ]
            }
            var pieOptions = {
                legend: {
                display: true
                },
                maintainAspectRatio : false,
                responsive : true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var pieChart = new Chart(pieChartCanvas, {
                type: 'doughnut',
                data: pieData,
                options: pieOptions
            });


    } );
 </script>

 @endsection
