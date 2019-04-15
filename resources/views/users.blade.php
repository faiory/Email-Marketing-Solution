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
                <li><a href="#tab_2" data-toggle="tab">Modify</a></li>
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
                    <div class="form-group">
                        {{--
                        <form action="{{ action('UserController@find') }}" method="POST" target="_self"> --}} {{-- PROTECT FROM CROSS SITE SCRIPTING --}} @csrf {{-- </form> --}} {{-- <label for="exampleInputFile">CSV</label>
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
                                    <input type="email" name="" class="form-control userEmail" placeholder="Email" value="{{ $user->email }}">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select class="userRole" name="" class="form-control" id="sel1">
                                        {{-- <option value="2">Employee</option>
                                        <option value="1">Admin</option> --}}
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
</script>
@stop