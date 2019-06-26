@extends('layouts.mainTemplate') 
@section('contentHeader') Subgroups
@endsection
 
@section('content') {{-- SUBGROUPS --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                {{-- IF ANY ERRORS --}} @if ($errors->any())
                <br />
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span> @endforeach
                </div>
                @endif
            </div>

            <div style="text-align: center">
                {{ $subgroups->links() }}
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Subgroup name</th>
                            <th>Subscriptions</th>
                            <th>Total clients</th>
                            <th>Creation date</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subgroups as $subgroup)

                        <tr id="{{ $subgroup->id }}">
                            <td>
                                {{ $subgroup->id }}
                            </td>
                            <td>
                                <div class="input-group">
                                    <input class="subgroupName" value="{{ $subgroup->name }}" type="text" name="subgroupName" class="form-control" placeholder="Name...">
                                </div>
                            </td>
                            <td>
                                {{ App\Client::where('subgroup_id', $subgroup->id)->where('status_id', 1)->count() }}
                            </td>
                            <td>
                                {{ App\Client::where('subgroup_id', $subgroup->id)->count() }}
                            </td>
                            <td>
                                {{ $subgroup->created_at }}
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
<form action="{{ action('SubgroupController@modify') }}" method="POST" target="_self" style="display: none">
    {{-- PROTECT FROM CROSS SITE SCRIPTING --}} @csrf
    <input id="subgroupName" type="text" name="name" value="" hidden>
    <input id="subgroupId" type="text" name="id" value="" hidden>
    <input id="submitFormBtn" type="submit" value="updateRecord">
</form>

<form action="{{ action('SubgroupController@delete') }}" method="POST" target="_self" style="display: none">
    {{-- PROTECT FROM CROSS SITE SCRIPTING --}}
     @csrf
    <input id="subgroupIdDelete" type="text" name="id" value="" hidden>
    <input id="deleteFormBtn" type="submit" value="Delete">
</form>

<script>
    $(".updateBtn").click(function (){
        var subgroupId = $(this).closest( "tr" ).attr('id');
        var subgroupName = $(this).closest("tr").find(".subgroupName").val();
        console.log(subgroupId + " " + subgroupName);
        $("#subgroupName").val(subgroupName);
        $("#subgroupId").val(subgroupId);
        $("#submitFormBtn").trigger("click");
    });
    
    $(".deleteBtn").click(function (){
        var subgroupId = $(this).closest( "tr" ).attr('id');

        if (confirm('Are you sure you want to delete Subgroup with id ' + subgroupId + ', All clients within this subgroup will be deleted')) {
            $("#subgroupIdDelete").val(subgroupId);
            $("#deleteFormBtn").trigger("click");
        }
    });
    
    
    
    // $("#subgroupName").val($("#"));
    // $("#submitFormBtn").trigger("click");

</script>









@stop