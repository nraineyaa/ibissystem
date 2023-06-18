@extends('layouts.sideNav')
@section('content')

<!-- Small Stats Blocks -->

<?php

$counter = 7;
$tooltipClients = '';
//clients data

?>

<!-- Page Header -->
<div class="page-header row no-gutters pb-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0 d-flex">
        <h1 class="page-title ml-3">Worker Overview</h1>
    </div>
</div>

<span id="team1" hidden>{{$team1 ?? 0}}</span>
<span id="team2" hidden>{{$team2 ?? 0}}</span>
<span id="team3" hidden>{{$team3 ?? 0}}</span>

<span id="Available" hidden>{{$available ?? 0}}</span>
<span id="On-Site" hidden>{{$onsite ?? 0}}</span>
<span id="On-Leave" hidden>{{$onleave ?? 0}}</span>
<span id="quotationAccept" hidden>{{$quotationAccept ?? 0}}</span>

<div class="row">
    <div class="col-lg col-md-6 col-sm-6 mb-4">
        <div class="stats-small stats-small--1 card card-small">
            <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">

                    <div class="stats-small__data text-center">
                        <div class="d-flex ">
                            <span class="stats-small__label text-uppercase mt-auto mb-auto">Total Job Assigned</span>
                        </div>

                        <h6 class="stats-small__value count my-3">{{$totalJob}}</h6>
                    </div>
                </div>
                <canvas height="120" class="blog-overview-stats-small-1"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg col-md-4 col-sm-6 mb-4">
        <div class="stats-small stats-small--1 card card-small">
            <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                    <div class="stats-small__data text-center">
                        <div class="d-flex ">
                            <span class="stats-small__label text-uppercase mt-auto mb-auto">Total Job Accepted</span>
                        </div>


                        <h6 class="stats-small__value count my-3">{{$totalAccept}}</h6>
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
                            <span class="stats-small__label text-uppercase mt-auto mb-auto">Report Submitted</span>
                        </div>
                        <h6 class="stats-small__value count my-3">{{$totalReportSubmit}}</h6>
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
                            <span class="stats-small__label text-uppercase mt-auto mb-auto">Total Claim for {{$currentMonth}} </span>
                        </div>

                        <h6 class="stats-small__value count my-3">{{$totalClaims}}</h6>
                    </div>
                </div>
                <canvas height="120" class="blog-overview-stats-small-5"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- End Small Stats Blocks -->
<div class="row">
    <!-- Users By Device Stats -->
    <div class="col-md-4 col-sm-12 mb-4">
        <div class="card card-small h-100">
            <div class="card-header border-bottom">
                <h6 class="m-0">Attendance Report</h6>
            </div>
            <div class="card-body d-flex py-0">
                <canvas height="220" class="m-auto" id="quotationPie"></canvas>
            </div>

        </div>
    </div>
    <!-- End Users By Device Stats -->

    <div class="col-md-8 col-sm-12 mb-4">
        <div class="card card-small h-100">
            <div class="card-header border-bottom">
                <h6 class="m-0">Worker Policy</h6>
            </div>

            <div class="row" style="text-align: center; height:50%">

                <div class="col-md-6 col-sm-12 m-auto" style="text-align: center; height:auto">
                    <h6 class="stats-small__value count my-3" style="font-weight: 600px; font-size:40px"></h6>
                    <span class="stats-small__label text-uppercase" style="font-weight: bold; font-size:15px; color:red; ">Report must be submitted everyweek</span>
                    <span class="stats-small__label text-uppercase" style="font-weight: bold; font-size:15px; color:black; ">Working Hours : 8.00am - 5.00pm</span><br>
                    <span class="stats-small__label text-uppercase" style="font-weight: bold; font-size:15px; color:black; ">Overtime: Allowed maximum : 3 hours</span>

                </div>

            </div>

        </div>
    </div>


    <!-- End New Draft Component -->
    <!-- Discussions Component -->
    
</div>



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
        var available = document.getElementById("Available").innerHTML;
        var onsite = document.getElementById("On-Site").innerHTML;
        var onleave = document.getElementById("On-Leave").innerHTML;

        $(document).ready(function() {
            // Data
            var ubdData = {
                datasets: [{
                    hoverBorderColor: '#ffffff',
                    data: [available, onsite, onleave],
                    backgroundColor: [
                        '#ffb400',
                        '#30bfc9',
                        'Red',
                    ],
                    datalabels: {
                        color: '#FFCE56'
                    }
                }],
                labels: ["Available", "On-Site", "On-Leave"]
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

</body>
<!-- <div class="promo-popup animated">
    <a href="http://bit.ly/shards-dashboard-pro" class="pp-cta extra-action">
        <img src="https://dgc2qnsehk7ta.cloudfront.net/uploads/sd-blog-promo-2.jpg"> </a>
    <div class="pp-intro-bar"> Need More Templates?
        <span class="close">
            <i class="material-icons">close</i>
        </span>
        <span class="up">
            <i class="material-icons">keyboard_arrow_up</i>
        </span>
    </div>
    <div class="pp-inner-content">
        <h2>Shards Dashboard Pro</h2>
        <p>A premium & modern Bootstrap 4 admin dashboard template pack.</p>
        <a class="pp-cta extra-action" href="http://bit.ly/shards-dashboard-pro">Download</a>
    </div>
</div> -->


@endsection