@extends('layouts.mainTemplate') 
@section('contentHeader') Clients
@endsection
 
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Add</a></li>
                <li><a href="#tab_2" data-toggle="tab">Search</a></li>
                <li><a href="#tab_3" data-toggle="tab">Import/Export</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    {{-- IF ANY ERRORS --}} @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span> @endforeach
                    </div>
                    @endif
                    <form action="{{ action('ClientController@store') }}" method="POST" target="_self">
                        {{-- PROTECT FROM CROSS SITE SCRIPTING --}} @csrf
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <br> {{-- email _^_ --}}
                        <div class="form-group">
                            <label for="sel1">Status:</label>
                            <select name="status_id" class="form-control" id="sel1">
                            @foreach ($statuses as $status)
                            <option value="{{ $status->id }} ">{{ $status->name }}</option>    
                            @endforeach 
                        </select>
                        </div>
                        {{-- Status _^_ --}}
                        <button type="submit" href="" class="btn-block btn btn-success">Add Client</button>
                    </form>
                </div>
                <div class="tab-pane" id="tab_2">

                    {{-- SEARCH BY EMAIL --}}
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="emailSearch" class="form-control" placeholder="Email">
                    </div>
                </div>

                <div class="tab-pane" id="tab_3">
                    <div class="form-group">
                        <label for="clientsFile">CSV</label>
                        <input type="file" id="clientsFile">
                        <p class="help-block">Upload the file here. Accepted format is CSV</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CLIENTS --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Clients list</h3>
            </div>
            <!-- /.box-header -->
            <div style="text-align: center">
                {{-- {{ $clients->links() }} --}}
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                            <th>Subgroup</th>
                            <th>Status</th>
                            <th>Subscribed/Unsubscribed at</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                        <tr id="{{ $client->id }}">
                            <td>{{ $client->id }}</td>
                            <td>
                                <div class="input-group">
                                    <input type="email" name="" class="form-control userEmail" placeholder="Email" value="{{ $client->email }}">
                                </div>
                            </td>
                            <td>
                                {{ $client->subgroup->name }}
                            </td>
                            <td>
                                {{ $client->status->name }}
                            </td>
                            <td>
                                {{ $client->created_at }}
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
<script>
    $(".updateBtn").click(function (){
        var clientId = $(this).closest( "tr" ).attr('id');
        var clientEmail = $(this).closest("tr").find(".clientEmail").val();

        window.location = 'clients/' + clientId + "/" + clientEmail;
    });
    $(".deleteBtn").click(function (){
        var clientId = $(this).closest( "tr" ).attr('id');
        if (confirm('Are you sure you want to delete client with id ' + clientId)) {
            window.location = 'clients/delete/' + clientId;
        }
    });
</script>
@stop