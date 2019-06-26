@php use App\User; use App\Client; use App\Newsletter; use App\Schedule; use Carbon\Carbon; use App\Subgroup;
@endphp 
@extends('layouts.mainTemplate')

@section('contentHeader') Dashboard
<script src="bower_components/chart.js/Chart.js"></script>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.js"></script>







@stop 
@section('content') @php $clientsCount = App\Client::count(); $subgroupsCount = App\Subgroup::count(); $schedulesCount = App\Schedule::count(); $unsubscriptionsCount
= App\Client::where('status_id', App\Status::where('name', 'Unsubscribed')->first()->id)->count(); $subscriptionsCount =
$clientsCount - $unsubscriptionsCount; $usersCount = User::count(); $newsletterCount = App\Newsletter::count(); $schedules
= Schedule::All(); 
@endphp @php 



if ($schedules->count() > 0) {
    foreach ($schedules as $key => $schedule) { $color = "red"; if ($schedule->executed == "Yes")
    { $color = 'green'; } $jsonevents[$key] = [ 'title' => $schedule->name, 'start' => Carbon::parse($schedule->execution_time)->toDateString(),
    'allDay' => true, 'backgroundColor' => $color ]; } 
    $encoded = json_encode($jsonevents);    
}



// var_dump($encoded); //     
@endphp

<div class="row">
    <div class="container-fluid center">
        <div class="col-md-9">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Schedules</h3>
                    <div class="box-tools pull-right">
                        <button type="button" id="refreshCallendar" class="btn btn-box-tool"><i class="fa fa-refresh"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div id='calendar1'></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            {{-- collapsed-box --}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Legend</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <p class="text-success">Executed</p>
                    <p class="text-danger">Pending</p>
                </div>
            </div>

            <div class="box box-danger col-md-12 collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $subscriptionsCount }} Subscribes</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="pieChart" style="height:250px"></canvas>
                </div>
            </div>
            <div class="box box-danger collapsed-box col-md-12">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $usersCount }} Users</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="pieChart" style="height:250px"></canvas>
                </div>
            </div>
            <div class="box box-danger collapsed-box col-md-12">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $newsletterCount }} Newsletters</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="pieChart" style="height:250px"></canvas>
                </div>
            </div>
            <div class="box box-danger collapsed-box col-md-12">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $schedulesCount }} Schedules</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="pieChart" style="height:250px"></canvas>
                </div>
            </div>
            <div class="box box-danger collapsed-box col-md-12">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $subgroupsCount }} Subgroups</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <canvas id="pieChart" style="height:250px"></canvas>
                    </div>
                </div>
        </div>
    </div>
</div>
<script>

</script>

<script>
    function renderCalendar(){
            $('#calendar1').fullCalendar(
                {
                    header: {
                        left: 'prev,next,today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    }
                    <?php echo (!isset($encoded) || is_null($encoded)) ? '' : ", events: $encoded"; ?>
                }
            );    
        }
    
    $(document).ready(function() {
        renderCalendar();
    });        
</script>




<script>
    // window.onLoad = function() {
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
    {
        value    :  {{ $subscriptionsCount }} ,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Subscribes'
    },
    {
        value    : {{ $unsubscriptionsCount }},
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'Unsubscribes'
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
    percentageInnerCutout: 10, // This is 0 for Pie charts
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
//Create pie or douhnut chart
// You can switch between pie and douhnut using the method below.
pieChart.Doughnut(PieData, pieOptions)
// }

</script>























@stop