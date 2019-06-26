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
                <li><a href="#tab_3" data-toggle="tab">Import</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    {{-- IF ANY ERRORS --}} @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span> @endforeach
                    </div>
                    @endif

                    @if(Session::has('messageE'))
                    <div class="alert alert-danger">
                        <p>{{ Session::get('messageE') }}</p>
                    </div>
                    @endif



                    @if(Session::has('message'))
                    <div class="alert alert-success">
                        <p>{{ Session::get('message') }}</p>
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
                        <button type="submit" id="clientAddSubmitBtn" href="" class="btn-block btn btn-success">Add
                            Client</button>

                        <div class="mdl-tooltip" data-mdl-for="clientAddSubmitBtn">
                            Adding client will automatically assign it to a subgroup
                        </div>

                    </form>
                </div>
                <div class="tab-pane" id="tab_2">
                    {{-- SEARCH BY EMAIL --}}
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" id="emailSearch" name="emailSearch" class="form-control"
                            placeholder="Email">
                    </div>

                    <script type="text/javascript">
                        $('#emailSearch').on('keyup',function(){
                            $value=$(this).val();
                            $.ajax({
                                type : 'get',
                                url : '{{URL::to('clients/search')}}',
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

                    <div class="box-header">
                        <h3 class="box-title">Search results</h3>
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
                            <tbody id="searchResults">
                                {{-- INCREMENT SEARCHED CLIENTS HERE --}}
                            </tbody>
                            <div class="mdl-tooltip" data-mdl-for="searchResults">
                                Showing first 10 records for better performance
                            </div>
                        </table>
                    </div>
                </div>

                <div class="tab-pane" id="tab_3">
                    <form action="{{ action('ClientController@upload') }}" method="POST" target="_self"
                        enctype='multipart/form-data'>
                        {{-- PROTECT FROM CROSS SITE SCRIPTING --}} @csrf
                        <div class="form-group">
                            <label for="clientsFile">CSV</label>
                            <input name="clientsFile" type="file" id="clientsFile">

                            <p class="help-block">Upload the file here. Accepted format is CSV containing only emails in
                                the first column</p>
                            <input name="importBtn" type="submit" id="importBtn" href=""
                                class="btn-block btn btn-success" value="Import" />
                            {{-- <input type='submit' name='importBtn' value='Import'> --}}

                            <div class="mdl-tooltip" data-mdl-for="importBtn">
                                Imports will be validated and repetitions will be removed
                            </div>
                        </div>
                    </form>
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
            <div style="text-align: center">
                {{ $clients->links() }}
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
                                    <input type="email" name="" class="form-control clientEmail" placeholder="Email"
                                        value="{{ $client->email }}">
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
<form action="{{ action('ClientController@modify') }}" method="POST" target="_self" style="display: none">
        {{-- PROTECT FROM CROSS SITE SCRIPTING --}} @csrf
        <input id="clientEmail" type="text" name="email" value="" hidden>
        <input id="clientId" type="text" name="id" value="" hidden>
        <input id="submitFormBtn" type="submit" value="updateRecord">
    </form>
    
    <form action="{{ action('ClientController@delete') }}" method="POST" target="_self" style="display: none">
        {{-- PROTECT FROM CROSS SITE SCRIPTING --}}
        @csrf
        <input id="clientIdDelete" type="text" name="id" value="" hidden>
        <input id="deleteFormBtn" type="submit" value="Delete">
    </form>
    <script>
        $(".updateBtn").click(function (){
        var clientId = $(this).closest( "tr" ).attr('id');
        var clientEmail = $(this).closest("tr").find(".clientEmail").val();
        
        $("#clientEmail").val(clientEmail);
        $("#clientId").val(clientId);
        $("#submitFormBtn").trigger("click");
    });    
       
    $(".deleteBtn").click(function (){    
        var clientIdDelete = $(this).closest( "tr" ).attr('id');
        $("#clientIdDelete").val(clientIdDelete);
        $("#deleteFormBtn").trigger("click"); 
    });
    
    $('#searchResults').on('click', '.updateBtn', function() {
        var clientId = $(this).closest( "tr" ).attr('id');
        var clientEmail = $(this).closest("tr").find(".clientEmail").val();
        
        $("#clientEmail").val(clientEmail);
        $("#clientId").val(clientId);
        // console.log(clientEmail + clientId)
        $("#submitFormBtn").trigger("click");
    });

    $('#searchResults').on('click', '.deleteBtn', function() { 
        var clientIdDelete = $(this).closest( "tr" ).attr('id');
        $("#clientIdDelete").val(clientIdDelete);
        $("#deleteFormBtn").trigger("click"); 
    });
    </script>
@stop