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
        array("label" => "Oxygen", "symbol" => "O", "y" => 46.6),
        array("label" => "Silicon", "symbol" => "Si", "y" => 27.7),
        array("label" => "Aluminium", "symbol" => "Al", "y" => 13.9),
        array("label" => "Iron", "symbol" => "Fe", "y" => 5),
        array("label" => "Calcium", "symbol" => "Ca", "y" => 3.6),
        array("label" => "Sodium", "symbol" => "Na", "y" => 2.6),
        array("label" => "Magnesium", "symbol" => "Mg", "y" => 2.1),
        array("label" => "Others", "symbol" => "Others", "y" => 1.5),

    )


    ?>


    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer2", {
                theme: "light2",
                animationEnabled: true,
                title: {
                    text: "Company Profit"
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
    <div class="row mb-2">
        <div class="col-12 col-xl-12 ">
            <div class="row flex-grow">
                <div class="col-md-6 grid-margin ">
                    <div class="card" style="background:#337AC6;">
                        <div class="card-body">
                            <h5 style="color:antiquewhite; font-weight: bold;">Total Income</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin ">
                    <div class="card" style="background:#6EB2FA;">
                        <div class="card-body">
                            <h5 style="color:antiquewhite; font-weight: bold;">Total Invoice</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12 col-xl-12 ">
            <div class="row flex-grow">
                <div class="col-md-6 grid-margin ">
                    <div class="card" style="background:#AB5BFF;">
                        <div class="card-body">
                            <h5 style="color:antiquewhite; font-weight: bold;">Total Claim</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin ">
                    <div class="card" style="background:#3ED97B;">
                        <div class="card-body">
                            <h5 style="color:antiquewhite; font-weight: bold;">Net Profit</h5>
                        </div>
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


@endsection