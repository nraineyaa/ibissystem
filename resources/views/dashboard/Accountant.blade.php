@extends('layouts.sideNav')
@section('content')

<!-- Page Header -->

<head>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-ui.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js"></script>
    <link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">



    <style>
        #chart-container {
            width: 100%;
            height: auto;
        }

        .card-equal-height {
            height: 100%;
        }
    </style>





    <?php
    $dataPoints = array(
        array("label" => "Ceo", "symbol" => "CEO", "y" => 46.6),
        array("label" => "Supervisor", "symbol" => "SV", "y" => 27.7),
        array("label" => "Accountant", "symbol" => "ACC", "y" => 13.9),
        array("label" => "Human Resources", "symbol" => "HR", "y" => 5),
        array("label" => "Head Technical", "symbol" => "HT", "y" => 3.6),
        array("label" => "Manager", "symbol" => "M", "y" => 2.6),
        array("label" => "Worker", "symbol" => "W", "y" => 2.1),
        array("label" => "Others", "symbol" => "Others", "y" => 1.5),

    )


    ?>


    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer2", {
                theme: "light2",
                animationEnabled: true,
                title: {
                    text: "Average of Salary"
                },
                data: [{
                    type: "doughnut",
                    indexLabel: "{symbol} - {y}",
                    yValueFormatString: "#,##0.0\"%\"",
                    showInLegend: true,
                    legendText: "{label} : {y}",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }

        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["2015-01", "2015-02", "2015-03", "2015-04", "2015-05", "2015-06", "2015-07", "2015-08", "2015-09", "2015-10", "2015-11", "2015-12"],
                datasets: [{
                    label: '# of Tomatoes',
                    data: [12, 19, 3, 5, 2, 3, 20, 3, 5, 6, 2, 1],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                scales: {
                    xAxes: [{
                            ticks: {
                                maxRotation: 90,
                                minRotation: 80
                            },
                            gridLines: {
                                offsetGridLines: true // à rajouter
                            }
                        },
                        {
                            position: "top",
                            ticks: {
                                maxRotation: 90,
                                minRotation: 80
                            },
                            gridLines: {
                                offsetGridLines: true // et matcher pareil ici
                            }
                        }
                    ],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</head>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<body>

    <div class="row">
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">

                        <div class="stats-small__data text-center">
                            <div class="d-flex ">
                                <span class="stats-small__label text-uppercase mt-auto mb-auto">Total Clients</span>
                            </div>


                            <h6 class="stats-small__value count my-3">{{$totalClient}}</h6>
                        </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-1"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <div class="d-flex ">
                                <span class="stats-small__label text-uppercase mt-auto mb-auto">New</span>
                            </div>
                            <h6 class="stats-small__value count my-3">{{$totalNewJS}}</h6>
                        </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-2"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-4 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <div class="d-flex ">
                                <span class="stats-small__label text-uppercase mt-auto mb-auto">In-Progress</span>
                            </div>


                            <h6 class="stats-small__value count my-3">{{$totalIPJS}}</h6>
                        </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-3"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-4 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">

                            <div class="d-flex ">
                                <span class="stats-small__label text-uppercase mt-auto mb-auto">Completed (Unpaid)</span>
                            </div>
                            <h6 class="stats-small__value count my-3">{{$totalCPJS}}</h6>
                        </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-4"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-4 col-sm-12 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <div class="d-flex ">
                                <span class="stats-small__label text-uppercase mt-auto mb-auto">Completed (Fully Paid)</span>
                            </div>

                            <h6 class="stats-small__value count my-3">{{$totalFPJS}}</h6>
                        </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-5"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card card-small h-100">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Invoice Status</h6>
                </div>
                <div class="card-body d-flex py-0">
                    <canvas height="220" class="m-auto" id="teamPie"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-8 col-sm-12 mb-4">
            <div class="card card-small h-100">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Invoice Details</h6>
                </div>

                <div class="row" style="text-align: center; height:50%">

                    <div class="col-md-6 col-sm-12 m-auto" style="text-align: center; height:auto">
                        <a data-toggle="tooltip" title="Total quantity of Fire Extinguisher where the Efeis expiration date is next month"><i class="fas fa-info-circle info-color"></i></a>
                        &nbsp;
                        <span class="stats-small__label text-uppercase" style="font-weight: 600px; font-size:15px">Expired Invoice Next Month</span>
                        <h6 class="stats-small__value count my-3" style="font-weight: 600px; font-size:40px">{{$totalExpiredNM}}</h6>


                    </div>

                    <div class="col-md-6 col-sm-12 m-auto" style="text-align: center;">
                        <a data-toggle="tooltip" title="Total quantity of Fire Extinguisher where the Efeis expiration date is in this year"><i class="fas fa-info-circle info-color"></i></a>
                        &nbsp;
                        <span class="stats-small__label text-uppercase" style="font-weight: bold; font-size:15px; color:red; ">EXPIRED blabla IN {{now()->year}}</span>
                        <h6 class="stats-small__value count my-3" style="font-weight: 600px; font-size:40px">{{$totalExpiredYear}}</h6>


                    </div>

                </div>

                <div class="row" style="text-align: center; height:50%">

                    <div class="col-md-6 col-sm-12 m-auto" style="text-align: center;">
                        <a data-toggle="tooltip" title="Total quantity of Fire Extinguisher where the Efeis expiration date is 14 days from now"><i class="fas fa-info-circle info-color"></i></a>
                        &nbsp;
                        <span class="stats-small__label text-uppercase" style="font-weight: 600px; font-size:15px; color:orangered; ">Expired blBL Within 14 Days</span>
                        <h6 class="stats-small__value count my-3" style="font-weight: 600px; font-size:40px">{{$totalExpired14}}</h6>


                    </div>
                    <div class="col-md-6 col-sm-12 m-auto" style="text-align: center;">
                        <a data-toggle="tooltip" title="Total quantity of Fire Extinguisher that is registered in this year"><i class="fas fa-info-circle info-color"></i></a>
                        &nbsp;
                        <span class="stats-small__label text-uppercase" style="font-weight: 600px; font-size:15px; color:green; ">Total blalba REGISTER in {{now()->year}}</span>
                        <h6 class="stats-small__value count my-3" style="font-weight: 600px; font-size:40px">{{$totalRegisterYear}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row mb-4">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div id="chartContainer2" style=" height: 387px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
<script>
    window.onload = function() {
        //   console.log(document.getElementById("team1").innerHTML);

        //technician pie chart
        var team1 = document.getElementById("team1").innerHTML;
        var team2 = document.getElementById("team2").innerHTML;
        var team3 = document.getElementById("team3").innerHTML;

        $(document).ready(function() {
            // Data
            var ubdData = {
                datasets: [{
                    hoverBorderColor: '#ffffff',
                    data: [team1, team2, team3],
                    backgroundColor: [
                        'rgba(0,123,255,0.9)',
                        'rgba(0,123,255,0.5)',
                        'rgba(0,123,255,0.3)'
                    ],
                    datalabels: {
                        color: '#FFCE56'
                    }
                }],
                labels: ["Team 1", "Team 2", "Team 3"]
            };

            // Options
            var ubdOptions = {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 25,
                        boxWidth: 20
                    }
                },
                cutoutPercentage: 0,
                // Uncomment the following line in order to disable the animations.
                // animation: false,
                tooltips: {
                    custom: false,
                    mode: 'index',
                    position: 'nearest'
                },
                datalabels: {
                    color: '#36A2EB'
                }
            };

            var ubdCtx = document.getElementById('teamPie');

            // Generate the users by device chart.
            window.ubdChart = new Chart(ubdCtx, {
                type: 'pie',
                data: ubdData,
                options: ubdOptions
            });
        });

        //quotation pie chart
        var quotationToPrepare = document.getElementById("quotationToPrepare").innerHTML;
        var quotationSend = document.getElementById("quotationSend").innerHTML;
        var quotationReject = document.getElementById("quotationReject").innerHTML;
        var quotationAccept = document.getElementById("quotationAccept").innerHTML;

        $(document).ready(function() {
            // Data
            var ubdData = {
                datasets: [{
                    hoverBorderColor: '#ffffff',
                    data: [quotationToPrepare, quotationSend, quotationReject],
                    backgroundColor: [
                        '#ffb400',
                        '#30bfc9',
                        'Red',
                    ],
                    datalabels: {
                        color: '#FFCE56'
                    }
                }],
                labels: ["To Prepare", "Waiting Response", "Rejected"]
            };

            // Options
            var ubdOptions = {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 25,
                        boxWidth: 20
                    }
                },
                cutoutPercentage: 0,
                // Uncomment the following line in order to disable the animations.
                // animation: false,
                tooltips: {
                    custom: false,
                    mode: 'index',
                    position: 'nearest'
                },
                datalabels: {
                    color: '#36A2EB'
                }
            };

            var ubdCtx = document.getElementById('quotationPie');

            // Generate the users by device chart.
            window.ubdChart = new Chart(ubdCtx, {
                type: 'pie',
                data: ubdData,
                options: ubdOptions
            });
        });



        //
        // Small Stats
        //

        var clientsData = [];
        var newJSData = [];
        var IPJSData = [];
        var CUJSData = [];
        var CFPJSData = [];



        // Datasets
        var boSmallStatsDatasets = [{
                backgroundColor: 'rgba(0, 184, 216, 0.1)',
                borderColor: 'rgb(0, 184, 216)',
                data: clientsData,
            },
            {
                backgroundColor: 'rgba(23,198,113,0.1)',
                borderColor: 'rgb(23,198,113)',
                data: newJSData
            },
            {
                backgroundColor: 'rgba(0, 184, 216, 0.1)',
                borderColor: 'rgb(0, 184, 216)',
                data: IPJSData
            },
            {
                backgroundColor: 'rgba(196, 22, 51,0.1)',
                borderColor: 'rgb(196, 22, 51)',
                data: CUJSData
            },
            {
                backgroundColor: 'rgba(0, 184, 216, 0.1)',
                borderColor: 'rgb(0, 184, 216)',
                data: CFPJSData
            }
        ];

        // Options
        function boSmallStatsOptions(max) {
            return {
                maintainAspectRatio: true,
                responsive: true,
                // Uncomment the following line in order to disable the animations.
                // animation: false,
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: false,
                    custom: false
                },
                elements: {
                    point: {
                        radius: 0
                    },
                    line: {
                        tension: 0.3
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: false,
                        scaleLabel: false,
                        ticks: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        gridLines: false,
                        scaleLabel: false,
                        ticks: {
                            display: false,
                            // Avoid getting the graph line cut of at the top of the canvas.
                            // Chart.js bug link: https://github.com/chartjs/Chart.js/issues/4790
                            suggestedMax: max
                        }
                    }],
                },
            };
        }

        // Generate the small charts
        boSmallStatsDatasets.map(function(el, index) {
            var chartOptions = boSmallStatsOptions(Math.max.apply(Math, el.data) + 1);
            var ctx = document.getElementsByClassName('blog-overview-stats-small-' + (index + 1));
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Label 1", "Label 2", "Label 3", "Label 4", "Label 5", "Label 6", "Label 7"],
                    datasets: [{
                        label: 'Today',
                        fill: 'start',
                        data: el.data,
                        backgroundColor: el.backgroundColor,
                        borderColor: el.borderColor,
                        borderWidth: 1.5,
                    }]
                },
                options: chartOptions
            });
        });

    };
</script>


@endsection