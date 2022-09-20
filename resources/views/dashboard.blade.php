@extends('layouts.app')

@section('content')

    <div class="col-md-12">

        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="icon-layers pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Total Members</h6>
                    <h2 class="m-b-20" data-plugin="counterup">{{ $formatMembers }}</h2>
                </div>
            </div>
            <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="icon-rocket pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Registered Members</h6>
                    <h2 class="m-b-20" data-plugin="counterup">{{ $formatRegistered }}</h2>
                </div>
            </div>

            <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="icon-paypal pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Male Members</h6>
                    <h2 class="m-b-20"><span data-plugin="counterup">{{ $formatMale }}</span></h2>
                </div>
            </div>

            <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="icon-chart pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Female Members</h6>
                    <h2 class="m-b-20"><span data-plugin="counterup">{{ $formatFemale }}</span></h2>
                </div>
            </div>

            <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                <div class="card-box tilebox-one">
                    <i class="icon-chart pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20"> Pending Messages</h6>
                    <h2 class="m-b-20"><span data-plugin="counterup" class="text-warning">
                            {{ $pending }}</span>
                    </h2>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                <div class="card-box tilebox-one">
                    <i class="icon-chart pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Sent Messages</h6>
                    <h2 class="m-b-20">
                        <span data-plugin="counterup" class="text-success"> {{ $formatMessages }}</span>
                    </h2>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                <div class="card-box tilebox-one">
                    <i class="icon-chart pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Available SMS Units</h6>
                    <h2 class="m-b-20">
                         <span data-plugin="counterup" class="text-primary">{{$availableUnits}}</span>
                    </h2>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card-box tilebox-one">
                    <i class="icon-paypal pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Total Incomes</h6>
                    <h2 class="m-b-20"><span data-plugin="counterup" class="text-primary">{{ $formatIncomes }}</span></h2>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card-box tilebox-one">
                    <i class="icon-paypal pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Total Expenses</h6>
                    <h2 class="m-b-20"><span data-plugin="counterup" class="text-primary">{{ $formatExpenses }}</span></h2>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card-box tilebox-one">
                <canvas id="gender_chart" width="400" height="180"></canvas>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card-box tilebox-one">
                    <canvas id="finance_chart" width="400" height="180"></canvas>
                </div>
            </div>

            <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                <div class="card-box tilebox-one">
                    <canvas id="zone_chart" width="400" height="180"></canvas>
                </div>
            </div>

            <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                <div class="card-box tilebox-one">
                    <canvas id="group_chart" width="400" height="180"></canvas>
                </div>
            </div>

            <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                <div class="card-box tilebox-one">
                    <canvas id="sms_chart" width="400" height="180"></canvas>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card-box tilebox-one">
                <table id="zonetable" class="table table-striped">
                    <thead class="thead-default" style="text-transform: uppercase;">
                    <th>MEMBERS PER ZONE</th>
                    <tr>
                        <th>Zone Name</th>
                        <th>Number</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($zone as $zone  )
                        <tr>
                            <td>
                                {{$zone->zone_name}}
                            </td>
                            <td>
                                {{$zone->total}}
                            </td></tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card-box tilebox-one">
                <table id="grouptable" class="table  table-striped">
                    <thead class="thead-default" style="text-transform: uppercase;">
                    <th>MEMBERS PER GROUP</th>
                    <tr>
                        <th>Group Name</th>
                        <th>Number</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($group as $group)
                        <tr>
                            <td>
                                {{$group->name}}
                            </td>
                            <td>
                                {{$group->total}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#grouptable').dataTable({
                fnDrawCallback : function() {
                    if ($(this).find('.dataTables_empty').length == 1) {
                        $(this).parent().hide();
                    }
                }
            });

            $('#zonetable').dataTable({
                fnDrawCallback : function() {
                    if ($(this).find('.dataTables_empty').length == 1) {
                        $(this).parent().hide();
                    }
                }
            });


            var ctx = document.getElementById('sms_chart').getContext('2d');

            let messages = JSON.parse('<?php echo json_encode($sms_data)?>');

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: messages.labels,
                    datasets: [{
                        label: 'Sent Messages',
                        data: messages.data,
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            var ctx = document.getElementById('zone_chart').getContext('2d');

            let zones = JSON.parse('<?php echo json_encode($zone_chart_data)?>');
            console.log(zones)

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: zones.labels,
                    datasets: [{
                        label: 'Members Per Zone',
                        data: zones.data,
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            var ctx = document.getElementById('group_chart').getContext('2d');

            let groups = JSON.parse('<?php echo json_encode($group_chart_data)?>');


            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: groups.labels,
                    datasets: [{
                        label: 'Members Per Group',
                        data: groups.data,
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            var chartDiv = $("#gender_chart");
            let males = JSON.parse('<?php echo json_encode($totalmale)?>');
            let females = JSON.parse('<?php echo json_encode($totalfemale)?>');
            var myChart = new Chart(chartDiv, {
                type: 'pie',
                data: {
                    labels: ["Males","Females"],
                    datasets: [
                        {
                            data: [males,females],
                            backgroundColor: [
                                "#3e95cd",
                                "#FF6384"
                            ]
                        }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Gender Pie-Chart'
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });
            var chartDiv = $("#finance_chart");
            let incomes = JSON.parse('<?php echo json_encode($totalincomes)?>');
            let expenses = JSON.parse('<?php echo json_encode($totalexpenses)?>');
            var myChart = new Chart(chartDiv, {
                type: 'pie',
                data: {
                    labels: ["Incomes","Expenses"],
                    datasets: [
                        {
                            data: [incomes,expenses],
                            backgroundColor: [
                                "#3e95cd",
                                "#FF6384"
                            ]
                        }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Finances Pie-Chart'
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });
        });




    </script>
@endsection