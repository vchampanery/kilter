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
    @if ($data['pagetitle'] != 'Current Year Board')
        <?php if(isset($data['myid'])){ ?>
        <a href="{{ url('/fetch_data/') }}/{{ $data['myid'] }}/direct" class="btn btn-warning"
            style="    display: flex;
    justify-content: center;"><i class="far fa-pull nav-icon"></i> Pull Your
            Activity</a>
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
            @if (in_array('today_ride', $data['tiles']))
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ number_format($data['today_ride'] / 1000, 2) }}<sup style="font-size: 20px">Kms</sup>
                            </h3>

                            <p>Today's Ride</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ url('/activity') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endif
            @if (in_array('total_rides', $data['tiles']))
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ isset($data['total_rides']) ? $data['total_rides'] : 0 }}</h3>
                            <p>Total Rides</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ url('/activity') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endif
            <!-- ./col -->
            @if (in_array('total_km', $data['tiles']))
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ number_format($data['total_km'] / 1000, 2) }}<sup style="font-size: 20px">Kms</sup></h3>

                            <p>Total Kilometers</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ url('/activity') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endif
            <!-- ./col -->
            @if (in_array('total_avg_speed', $data['tiles']))
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ number_format(3.6 * $data['total_avg_speed'], 2) }}<sup
                                    style="font-size: 20px">Km/h</sup></h3>

                            <p>Avg speed</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ url('/activity') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endif
            <!-- ./col -->
            @if (in_array('total_longest_ride', $data['tiles']))
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ number_format($data['total_longest_ride'] / 1000, 2) }}<sup
                                    style="font-size: 20px">Kms</sup></h3>

                            <p>Longest Ride of the Month</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ url('/activity') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endif
            @if (in_array('max_speed_ride', $data['tiles']))
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3>{{ number_format(3.6 * $data['max_speed_ride'], 2) }}<sup
                                    style="font-size: 20px">Km/h</sup>
                            </h3>

                            <p>Fastest - Average speed of ride</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ url('/activity') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endif
            <!-- ./col -->
        </div>
        @if (in_array('kilometer_graph', $data['tiles']))
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
                                </ul>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Sales -->

                                <div class="chart tab-pane active" id="revenue-chart"
                                    style="position: relative; height: 300px;">
                                    {{-- <canvas id="activity-chart-canvas" height="300" style="height: 300px;"></canvas> --}}
                                    <div id="chart" height="300" style="height: 300px;"></div>
                                </div>
                                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                    <div id="chartRide"></div>
                                    {{-- <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas> --}}
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
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
    <!-- <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script> -->
    <!-- daterangepicker -->
    <!-- <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script> -->
    <!-- jQuery Knob Chart -->
    <!-- <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script> -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> --}}
    <script src=”https://unpkg.com/dayjs@1.8.21/dayjs.min.js”></script>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script type="text/javascript" class="init">
        $(document).ready(function() {
            $('input[name="dates"]').daterangepicker();
            //Kilo
            // var he = require('he');
            var rides = {{ $data['monthlyRides'] }};
            var kilometer = {{ $data['monthlyKilometer'] }};
            var labelV = <?php echo json_encode($data['label']); ?>;
            var temp11 = <?php echo json_encode($data['temp1']); ?>;
            // var temp111 = he.decode(temp11);
            console.dir(rides);
            console.dir(kilometer);
            console.dir(temp11);
            var options = {
                series: [{
                    data: kilometer
                }],
                chart: {
                    type: 'bar',
                    height: 380
                },
                plotOptions: {
                    bar: {
                        barHeight: '100%',
                        distributed: true,
                        horizontal: true,
                        dataLabels: {
                            position: 'bottom'
                        },
                    }
                },
                colors: ['#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B', '#2b908f', '#f9a3a4', '#90ee7e',
                    '#f48024', '#69d2e7'
                ],
                dataLabels: {
                    enabled: true,
                    textAnchor: 'start',
                    style: {
                        colors: ['#fffaaa']
                    },
                    formatter: function(val, opt) {
                        return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val + ' Kms'
                    },
                    offsetX: 0,
                    dropShadow: {
                        enabled: true
                    }
                },
                stroke: {
                    width: 1,
                    colors: ['#fff']
                },
                xaxis: {
                    categories: [
                        "January", "February", "March", "April", "May", "June", "July", "August",
                        "September", "October", "November", "December"
                    ],
                },
                yaxis: {
                    labels: {
                        show: false
                    }
                },
                title: {
                    text: 'Covered Kilometer per month',
                    align: 'center',
                    floating: true
                },
                // subtitle: {
                //     text: 'Category Names as DataLabels inside bars',
                //     align: 'center',
                // },
                tooltip: {
                    theme: 'dark',
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function() {
                                return ''
                            }
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
            //test


            // var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
            //     var pieData        = {
            //         labels: [
            //             "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
            //         ],
            //         datasets: [
            //         {
            //             data: rides,
            //             backgroundColor : [
            //                 '#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd', '#8c564b',
            //         '#e377c2', '#7f7f7f', '#bcbd22', '#17becf', '#FF5733', '#33FF57'
            //             ],
            //         }
            //         ]
            //     }
            //     var pieOptions = {
            //         legend: {
            //         display: true
            //         },
            //         maintainAspectRatio : false,
            //         responsive : true,
            //     }
            //     //Create pie or douhnut chart
            //     // You can switch between pie and douhnut using the method below.
            //     var pieChart = new Chart(pieChartCanvas, {
            //         type: 'doughnut',
            //         data: pieData,
            //         options: pieOptions
            //     });


        });
    </script>
@endsection
