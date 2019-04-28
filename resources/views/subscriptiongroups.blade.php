@extends('layouts.mainTemplate') 
@section('contentHeader') Subgroups
@endsection

@section('content')
{{-- SUBGROUPS --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Subgroup list</h3>
            </div>
            <div style="text-align: center">
                {{-- {{ $subgroups->links() }} --}}
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Subgroup name</th>
                            <th>Creation date</th>
                            <th>Subscriptions</th>
                            <th>Total clients</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                        {{-- {{ $subgroup->id }} --}}
                        <tr id="">
                            <td>
                                {{-- {{ $subgroup->id }} --}}
                            </td>
                            <td>
                                {{-- {{ $client->subgroup->name }} --}}
                            </td>
                            <td>
                                {{-- {{ $client->subgroup->name }} --}}
                            </td>
                            <td>
                                {{-- {{ $client->status->name }} --}}
                            </td>
                            <td>
                                {{-- {{ $client->created_at }} --}}
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
    // $(".updateBtn").click(function (){
    //     var clientId = $(this).closest( "tr" ).attr('id');
    //     var clientEmail = $(this).closest("tr").find(".clientEmail").val();

    //     window.location = 'clients/' + clientId + "/" + clientEmail;
    // });
    // $(".deleteBtn").click(function (){
    //     var clientId = $(this).closest( "tr" ).attr('id');
    //     if (confirm('Are you sure you want to delete client with id ' + clientId)) {
    //         window.location = 'clients/delete/' + clientId;
    //     }
    // });
</script>
@stop