@extends('layouts.mainTemplate')
@section('contentHeader') Schedules
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Schedule</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="box-body">
                        {{-- IF ANY ERRORS --}} @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span> @endforeach
                        </div>
                        @endif
                        <form action="{{ action('ScheduleController@store') }}" method="POST" target="_self">
                            {{-- PROTECT FROM CROSS SITE SCRIPTING --}} @csrf
                            <div class="col-md-12">
                                <div class="form-group col-md-4">
                                    <label for="datetimepicker9">Select Date:</label>
                                    <div class='input-group date' id='datetimepicker9'>
                                        <input type='text' name="execution_time" class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <div class="mdl-tooltip" data-mdl-for="datetimepicker9">
                                        Schedule execution cannot be on the same day as creation
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="sel1">Subgroup:</label>
                                    <select name="subgroup_id" class="form-control" id="sel1">
                                        @foreach ($subgroups as $subgroup)
                                        <option value="{{ $subgroup->id }}">{{ $subgroup->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="sel2">Newsletter:</label>
                                    <select name="newsletter_id" class="form-control" id="sel2">
                                        @foreach ($newsletters as $newsletter)
                                        <option value="{{ $newsletter->id }}">{{ $newsletter->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="input-group col-md-12">
                                        {{-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> --}}
                                        <input id="schedulenameTxt" type="text" name="name" class="form-control"
                                            placeholder="Name..">
                                    </div>

                                    <div class="mdl-tooltip" data-mdl-for="schedulenameTxt">
                                        The name should be unique
                                    </div>
                                </div>
                                {{-- btn-block --}}
                                <div class="form-group col-md-12">
                                    <button type="submit" href="" class="col-md-12 btn btn-success">Add
                                        schedule</button>
                                </div>
                            </div>
                        </form>
                        {{-- END OF BOX BODY --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- SCHEDULES --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div>
            <div style="text-align: center">
            </div>
            <div class="box-body">
                <div style="text-align: center">
                    {{ $schedules->links() }}
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Executed</th>
                            <th>Newsletter</th>
                            <th>Subgroup name</th>
                            <th>Execution time</th>
                            <th>Created at</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                        <tr id="{{ $schedule->id }}">
                            <td>{{ $schedule->id }} </td>
                            {{-- <td>{{ $schedule->name }} </td> --}}
                            <td>
                                <div class="input-group">
                                    <input type="text" name="" class="form-control scheduleName" placeholder="name"
                                        value="{{ $schedule->name }}">
                                </div>
                            </td>
                            <td>{{ $schedule->executed }} </td>
                            <td>{{ $schedule->newsletter->name }}</td>
                            <td>{{ $schedule->subgroup->name }}</td>
                            <td>{{ $schedule->execution_time}}</td>
                            <td>{{ $schedule->created_at }}</td>
                            </td>
                            <td>
                                <button class="updateBtn">Update</button>
                            </td>
                            <td>
                                <button class="deleteBtn">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<form action="{{ action('ScheduleController@modify') }}" method="POST" target="_self" style="display: none">
    {{-- PROTECT FROM CROSS SITE SCRIPTING --}} @csrf
    <input id="scheduleName" type="text" name="name" value="" hidden>
    <input id="scheduleId" type="text" name="id" value="" hidden>
    <input id="submitFormBtn" type="submit" value="updateRecord">
</form>

<form action="{{ action('ScheduleController@delete') }}" method="POST" target="_self" style="display: none">
    {{-- PROTECT FROM CROSS SITE SCRIPTING --}}
    @csrf
    <input id="scheduleIdDelete" type="text" name="id" value="" hidden>
    <input id="deleteFormBtn" type="submit" value="Delete">
</form>

<script>
    $(".updateBtn").click(function (){
        var scheduleId = $(this).closest( "tr" ).attr('id');
        var scheduleName = $(this).closest("tr").find(".scheduleName").val();

        $("#scheduleName").val(scheduleName);
        $("#scheduleId").val(scheduleId);
        console.log($("#scheduleId").val());
        console.log($("#scheduleName").val())
        $("#submitFormBtn").trigger("click");    
    });
    
    $(".deleteBtn").click(function (){
        var scheduleId = $(this).closest( "tr" ).attr('id');
        if (confirm('Are you sure you want to delete Schedule with id ' + scheduleId + "?")) {
            $("#scheduleIdDelete").val(scheduleId);   
            $("#deleteFormBtn").trigger("click");    
        }
    });    
</script>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker9').datetimepicker({
            viewMode: 'years',
            format: 'YYYY-MM-DD HH:mm:ss',
            // DELETE THIS WHEN GOING LIVE
            minDate:  '{{ now()->addMinutes(3) }}'
            // minDate:  '{{ now()->addDays(1) }}'
        });
    });

</script>

@stop