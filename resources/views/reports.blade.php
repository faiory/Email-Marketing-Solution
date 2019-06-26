@php use App\User; use App\Client; use App\Newsletter; use App\Schedule;use App\Status; use Carbon\Carbon; use App\Subgroup;

@endphp 
@extends('layouts.mainTemplate') 
@section('contentHeader') Reports
<script src="bower_components/chart.js/Chart.js"></script>





@stop 
@section('content')

<?php
$clientsCount = Client::count(); 
$UnsubscribedClients = Client::where('status_id', Status::where('name', 'Unsubscribed')->first()->id)
->whereBetween('updated_at', [$dateQuery, $dateQuery2])
->get();
$UnsubscribedClientsCount = Client::where('status_id', Status::where('name', 'Unsubscribed')->first()->id)
->whereBetween('updated_at', [$dateQuery, $dateQuery2])
->count();
$subscribedClientsCount = Client::where('status_id', Status::where('name', 'Subscribed')->first()->id)
->whereBetween('updated_at', [$dateQuery, $dateQuery2])
->count();
$subgroupsCount = Subgroup::whereBetween('updated_at', [$dateQuery, $dateQuery2])
->count();
$newslettersCount = Subgroup::whereBetween('updated_at', [$dateQuery, $dateQuery2])
->count();
// SCHEDULES
$doneScheduleCount = Schedule::where('executed', 'Yes')
->whereBetween('updated_at', [$dateQuery, $dateQuery2])
->count();
$scheduleCount = Schedule::where('executed', 'No')
->whereBetween('updated_at', [$dateQuery, $dateQuery2])
->count();
$subscriptionsCount = Client::where('status_id', Status::where('name', 'Subscribed')->first()->id)
->whereBetween('updated_at', [$dateQuery, $dateQuery2])
->count();
$unsubscriptionsCount = Client::where('status_id', Status::where('name', 'Unsubscribed')->first()->id)
->whereBetween('updated_at', [$dateQuery, $dateQuery2])
->count();
$adminsCount = User::where('role_id', 1)
->whereBetween('updated_at', [$dateQuery, $dateQuery2])
->count();
$employeesCount = User::where('role_id', 2)
->whereBetween('updated_at', [$dateQuery, $dateQuery2])
->count();
$newsletterCount = Newsletter::count(); $schedules = Schedule::All(); 
?>

    <div class="row">
        <div class="container-fluid center">
            <div class="col-md-12">
                <div class="box box-danger col-md-12">
                    <div class="box-header with-border">
                        <h3 class="box-title">Options</h3>
                        <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group col-md-12">

                            <form action="{{ action('ReportController@applyDate') }}" method="POST" target="_self">
                                {{-- PROTECT FROM CROSS SITE SCRIPTING --}} @csrf
                                <div class="form-group col-md-6">
                                    <label for="datetimepicker9">Select Date:</label>
                                    <div class='input-group date' id='datetimepicker9'>
                                        <input type='text' name="dateQuery" class="form-control" />
                                        <span class="input-group-addon">            
                                    <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <div class="mdl-tooltip" data-mdl-for="datetimepicker9">
                                        Range start date
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="datetimepicker1">Select Date:</label>
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' name="dateQuery2" class="form-control" />
                                        <span class="input-group-addon">            
                                        <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <div class="mdl-tooltip" data-mdl-for="datetimepicker1">
                                        Range end date
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="submit" class="col-md-12 btn btn-success">Generate</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-danger col-md-12">
                    <div class="box-header with-border">
                        <h3 class="box-title">Clients: @php echo $subscribedClientsCount + $UnsubscribedClientsCount 
@endphp
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        @if ($subscribedClientsCount == 0 && $UnsubscribedClientsCount == 0) No Subscribers for this date range! @endif
                        <canvas id="pieChart" style="height:250px"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-danger col-md-12">
                    <div class="box-header with-border">
                        <h3 class="box-title">Users: @php echo $adminsCount + $employeesCount 
@endphp
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        @if ($adminsCount == 0 && $employeesCount == 0) No employees for this date range! @endif
                        <canvas id="pieChart2" style="height:250px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-danger col-md-12">
                    <div class="box-header with-border">
                        <h3 class="box-title">Schedules: @php echo $doneScheduleCount + $scheduleCount @endphp
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        @if ($adminsCount == 0 && $employeesCount == 0) No employees for this date range! @endif
                        <canvas id="pieChart3" style="height:250px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-danger col-md-12">
                    <div class="box-header with-border">
                        <h3 class="box-title">Subgroups: {{$subgroupsCount}}, Newsletters: {{ $newslettersCount }}
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        @if ($adminsCount == 0 && $employeesCount == 0) No employees for this date range! @endif
                        <canvas id="pieChart4" style="height:250px"></canvas>
                    </div>
                </div>
            </div>

            {{-- UNSUBSCRIBERS --}}
            <div class="col-md-12">
                <div class="box">
                    <table class="table table-bordered table-striped">
                        <thead id="unsubsHead">
                            <tr>
                                <th>Id</th>
                                <th>Email</th>
                                <th>Subgroup</th>
                                <th>Unsubscribed at</th>
                            </tr>
                        </thead>
                        <div class="mdl-tooltip" data-mdl-for="unsubsHead">
                            Total unsubscribed {{$UnsubscribedClientsCount}}
                        </div>
                        <tbody>
                            @foreach ($UnsubscribedClients as $client)
                            <tr id="{{ $client->id }}">
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->subgroup->name }}</td>
                                <td>{{ $client->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
    <script>

    </script>

    <script>
        $(document).ready(function() {

        
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieChartCanvas2 = $('#pieChart2').get(0).getContext('2d')
        var pieChartCanvas3 = $('#pieChart3').get(0).getContext('2d')
        var pieChartCanvas4 = $('#pieChart4').get(0).getContext('2d')
    
        var pieChart = new Chart(pieChartCanvas);
        var pieChart2 = new Chart(pieChartCanvas2);
        var pieChart3 = new Chart(pieChartCanvas3);
        var pieChart4 = new Chart(pieChartCanvas4);
        var PieData = [
        {
            value    :  {{ $subscriptionsCount }} ,
            color    : '#f56954',
            highlight: '#f56954',
            label    : 'Subscribes'
        },
        {
            value    : {{$unsubscriptionsCount}},
            color    : '#00a65a',
            highlight: '#00a65a',
            label    : 'Unsubscribes'
        }
    ]
        
        var PieData2 = [
        {
            value    :  {{ $adminsCount }} ,
            color    : '#f56954',
            highlight: '#f56954',
            label    : 'Admins'
        },
        {
            value    : {{ $employeesCount }},
            color    : '#00a65a',
            highlight: '#00a65a',
            label    : 'Employees'
        }
    ]
    var PieData3 = [
        {
            value    :  {{ $doneScheduleCount }} ,
            color    : '#f56954',
            highlight: '#f56954',
            label    : 'Sent'
        },
        {
            value    : {{ $scheduleCount }},
            color    : '#00a65a',
            highlight: '#00a65a',
            label    : 'Pending'
        }
    ]
    var PieData4 = [
        {
            value    :  {{ $subgroupsCount }} ,
            color    : '#f56954',
            highlight: '#f56954',
            label    : 'Subgroups'
        },
        {
            value    : {{ $newslettersCount }},
            color    : '#00a65a',
            highlight: '#00a65a',
            label    : 'Newsletters'
        }
    ]
var pieOptions     = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    //String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    //Number - The width of each segment stroke
    segmentStrokeWidth   : 2,
    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 0, // This is 0 for Pie charts
    //Number - Amount of animation steps
    animationSteps       : 100,
    //String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : true,
    //String - A legend template
    legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
}
// 
pieChart.Doughnut(PieData, pieOptions)        
pieChart2.Doughnut(PieData2, pieOptions)
pieChart3.Doughnut(PieData3, pieOptions)        
pieChart4.Doughnut(PieData4, pieOptions)

    });
    </script>
    <script type="text/javascript">
        $(function () {
        $('#datetimepicker9').datetimepicker({
            viewMode: 'months',
            format: 'YYYY-MM-DD H:mm:ss',
            defaultDate: "{{$dateQuery}}",
        });
        $('#datetimepicker1').datetimepicker({
            viewMode: 'months',
            format: 'YYYY-MM-DD H:mm:ss',
            defaultDate: "{{$dateQuery2}}",
        });
    });
    </script>




    
@stop