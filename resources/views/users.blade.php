@extends('layouts.mainTemplate') 
@section('contentHeader') Users
@endsection
 
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><a href="#tab_1" data-toggle="tab">Add</a></li>
                <li><a href="#tab_2" data-toggle="tab">Modify</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="box-body">
                        
                    <form action="{{ action('UserController@store') }}" method="POST" target="_self">
                            @csrf
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <br>
                        <div>
                            <label for="selectId">Role: </label>
                            <select name="roleId" id="selectId">
                                <option value="2">Employee</option>
                                <option value="1">Admin</option>    
                            </select>
                            <div class="btn-group pull-right">
                                <button type="submit" href="" class="btn btn-success">Success</button>
                                <button type="button" class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                        </div>
                        <!-- /input-group -->
                    </div>
                    <!-- /.box-body -->
                    <!-- /.box -->
                </div>
                {{--
                <!-- /.tab-pane -->---------- --}}
                <div class="tab-pane" id="tab_2">
                    <div class="form-group">
                        <label for="exampleInputFile">CSV</label>
                        <input type="file" id="exampleInputFile">
                        <p class="help-block">Upload the file here accepted format is CSV</p>
                    </div>
                    <!-- /input-group -->
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>

{{-- USERS --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users list</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- INCREMENT ON ALL USERS --}} @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{ App\Role::find($user->role_id)->name }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>









@stop