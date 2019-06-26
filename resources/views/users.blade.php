@extends('layouts.mainTemplate')
@section('contentHeader') Users
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Add</a></li>
                <li><a href="#tab_2" data-toggle="tab">Search</a></li>
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

                        <form action="{{ action('UserController@store') }}" method="POST" target="_self">
                            {{-- PROTECT FROM CROSS SITE SCRIPTING --}} @csrf
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="sel1">Select Role:</label>
                                <select name="roleId" class="form-control" id="sel1">
                                    <option value="2">Employee</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                            <button type="submit" href="" class="btn-block btn btn-success">Add User</button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2">
                    {{-- SEARCH CODE --}}
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" id="emailSearch" name="emailSearch" class="form-control"
                                placeholder="Search by email here">
                        </div>
                    </div>
                    <script type="text/javascript">
                        $('#emailSearch').on('keyup',function(){
                            $value=$(this).val();
                            $.ajax({
                                type : 'get',
                                url : '{{URL::to('users/search')}}',
                                data:{'search':$value},
                                success:function(data){
                                    $('#searchResults').html(data);
                                }
                            });
                        });
                    </script>
                    <script type="text/javascript">
                        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
                    </script>
                    <div>
                        <div class="box-header">
                            <h3 class="box-title">Users list</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="searchResults">
                                </tbody>
                            </table>
                        </div>
                        {{--
                        <form action="{{ action('UserController@find') }}" method="POST" target="_self"> --}}
                        {{-- PROTECT FROM CROSS SITE SCRIPTING --}} @csrf {{-- </form> --}} {{-- <label for="exampleInputFile">CSV</label>
                        <input type="file" id="exampleInputFile">
                        <p class="help-block">Upload the file here accepted format is CSV</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- USERS --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users list</h3>
            </div>
            <!-- /.box-header -->
            <div style="text-align: center">
                {{ $users->links() }}
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- INCREMENT USERS --}} @foreach ($users as $user)
                        <tr id="{{ $user->id }}">
                            <td>{{ $user->id }}</td>
                            <td>
                                <div class="input-group">
                                    <input type="email" name="" class="form-control userEmail" placeholder="Email"
                                        value="{{ $user->email }}">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select class="userRole" name="" class="form-control" id="sel1">
                                        @if ($user->role_id == 1)
                                        <option value="1">Admin</option>
                                        <option value="2">Employee</option>
                                        @else
                                        <option value="2">Employee</option>
                                        <option value="1">Admin</option>
                                        @endif
                                    </select>
                                </div>
                                {{-- {{ $user->Role->name }} --}}
                            </td>
                            <td>
                                <button class="updateBtn">Update</button>
                            </td>
                            <td>
                                <button class="deleteBtn">Delete</button>
                            </td>
                        </tr>
                        {{-- {{ App\Role::find($user->role_id)->name }} --}} @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form action="{{ action('UserController@modify') }}" method="POST" target="_self" style="display: none">
    {{-- PROTECT FROM CROSS SITE SCRIPTING --}} @csrf
    <input id="userEmail" type="text" name="email" value="" hidden>
    <input id="userId" type="text" name="id" value="" hidden>
    <input id="userRole" type="text" name="role_id" value="" hidden>
    <input id="submitFormBtn" type="submit" value="updateRecord">
</form>

<form action="{{ action('UserController@delete') }}" method="POST" target="_self" style="display: none">
    {{-- PROTECT FROM CROSS SITE SCRIPTING --}}
    @csrf
    <input id="userIdDelete" type="text" name="id" value="" hidden>
    <input id="deleteFormBtn" type="submit" value="Delete">
</form>


<script>
    $(".updateBtn").click(function (){
                var userId = $(this).closest( "tr" ).attr('id');
                var userEmail = $(this).closest("tr").find(".userEmail").val();
                var userRole = $(this).closest("tr").find(".userRole").val();
                
                $("#userEmail").val(userEmail);
                $("#userRole").val(userRole);
                $("#userId").val(userId);
                $("#submitFormBtn").trigger("click");    
            });
            
            $(".deleteBtn").click(function (){
                var userId = $(this).closest( "tr" ).attr('id');
                if (confirm('Are you sure you want to delete User with id ' + userId + "?")) {
                    $("#userIdDelete").val(userId);   
                    $("#deleteFormBtn").trigger("click");
                }
            });

            $('#searchResults').on('click', '.updateBtn', function() {
                var userId = $(this).closest( "tr" ).attr('id');
                var userEmail = $(this).closest("tr").find(".userEmail").val();
                var userRole = $(this).closest("tr").find(".userRole").val();
                
                $("#userEmail").val(userEmail);
                $("#userRole").val(userRole);
                $("#userId").val(userId);
                $("#submitFormBtn").trigger("click");    
            });
            
            $('#searchResults').on('click', '.deleteBtn', function() { 
                var userId = $(this).closest( "tr" ).attr('id');
                if (confirm('Are you sure you want to delete User with id ' + userId + "?")) {
                    $("#userIdDelete").val(userId);   
                    $("#deleteFormBtn").trigger("click");
                }
            });
</script>

{{-- 
<script>
    $(".updateBtn").click(function (){
        var userId = $(this).closest( "tr" ).attr('id');
        var userEmail = $(this).closest("tr").find(".userEmail").val();
        var userRole = $(this).closest("tr").find(".userRole").val();
        window.location = 'users/' + userId + "/" + userEmail + "/" + userRole;
    });
    
    $(".deleteBtn").click(function (){
        var userId = $(this).closest( "tr" ).attr('id');
        if (confirm('Are you sure you want to delete user with id ' + userId)) {
            window.location = 'users/delete/' + userId;
        }
    });
    
    $('#searchResults').on('click', '.updateBtn', function() {
        var userId = $(this).closest( "tr" ).attr('id');
        var userEmail = $(this).closest("tr").find(".userEmail").val();
        var userRole = $(this).closest("tr").find(".userRole").val();
        window.location = 'users/' + userId + "/" + userEmail + "/" + userRole;
    });
    $('#searchResults').on('click', '.deleteBtn', function() { 
        var userId = $(this).closest( "tr" ).attr('id');
        if (confirm('Are you sure you want to delete user with id ' + userId)) {
            window.location = 'users/delete/' + userId;
        }
    });

</script> --}}

@stop