@php
use App\Newsletter;    
@endphp

@extends('layouts.mainTemplate')
@section('contentHeader') Newsletters
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Add</a></li>
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

                        <form method="POST" action="{{ action('NewsletterController@store') }}" target="_self">
                            {{-- PROTECT FROM CROSS SITE SCRIPTING --}} @csrf
                            <button onclick="runCode();" type="button" href=""
                                class="btn-block btn btn-success">Preview</button>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12 form-group input-group">
                                        <label>Template</label>
                                        <textarea onkeyup="runCode();" style="resize: none;" rows="15" name="content"
                                            id="sourceCode" class="form-control" rows="15"
                                            placeholder="Enter ..."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6" style="height: 200px">
                                    <label>Preview</label>
                                    <iframe style="border: 2px solid #400040; height: 315px; width: 100%;"
                                        class="rounded-sm" name="targetCode" id="targetCode">
                                    </iframe>
                                </div>
                            </div>
                            {{-- DISPLAY THE CONTENT --}}
                            <script>
                                function runCode() {
                                        var content = document.getElementById('sourceCode').value;
                                        var iframe = document.getElementById('targetCode');
                                        iframe = (iframe.contentWindow)?iframe.contentWindow:(iframe.contentDocument)? iframe.contentDocument.document: 
                                        iframe.contentDocument;
                                        iframe.document.open();
                                        iframe.document.write(content);
                                        iframe.document.close();
                                        return false;
                                    }
                                    runCode();
                            </script>
                            <div>
                                <br>
                                <div class="input-group block col-md-12">
                                    <input id="newsletterNameTxt" type="text" name="name" class="form-control" placeholder="Newsletter name">
                                </div>
                                <br>
                                <button type="submit" href="" class="btn-block btn btn-success">Add Newsletter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-md-12">
        <div class="box">
                <div class="input-group block col-md-12">
                        <button id="btnUpdate" class="col-md-12 btn-block btn btn-danger">Update Newsletter</button>
                        </div>
            <div class="box-header">
                <h3 class="box-title">Newsletters list</h3>
            </div>
            <!-- /.box-header -->
            <div style="text-align: center">
                {{ $newsletters->links() }}
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Preview</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($newsletters as $newsletter)
                        <tr id="{{ $newsletter->id }}">
                            <td>{{ $newsletter->id }}</td>
                        <td class="newsletterName" id="{{$newsletter->name}}">
                            {{ $newsletter->name }}        
                        </td>
                            
                        <td>
                            <button class="previewButton">
                                Preview
                            </button>        
                            <div data-id="{{ $newsletter->id }}" style="display: none"> {{ $newsletter->content }}        
                            </div>
                            
                        </td>
                        <td>
                            <button class="btnDelete">
                                Delete
                            </button>
                        </td>
                        </tr>
                        @endforeach {{-- {{ App\Role::find($user->role_id)->name }} --}}
                    </tbody>
                    <form action="{{ action('NewsletterController@modify') }}" method="POST" target="_self" style="display: none">
                            {{-- PROTECT FROM CROSS SITE SCRIPTING --}} @csrf
                            <input id="formNewsletterName" type="text" name="name" value="" hidden>
                            <input id="formNewsletterId" type="text" name="id" value="" hidden>
                            <input id="formContent" type="text" name="content" value="" hidden>
                            <input id="submitFormBtn" type="submit" value="" hidden>
                    </form>
                    <form action="{{ action('NewsletterController@delete') }}" method="POST" target="_self" style="display: none">
                        {{-- PROTECT FROM CROSS SITE SCRIPTING --}} @csrf
                        <input id="deleteId" type="text" name="id" value="" hidden>
                        <input id="deleteFormBtn" type="submit" value="" hidden>
                    </form>

                    {{-- DISPLAY PREVIEW --}}
                    <script>
                        function preview(id){
                            document.getElementById("sourceCode").innerHTML = $('[data-id="'+ id +'"]').html();
                            runCode();
                        }
                        $(".previewButton").click(function (){
                            document.getElementById("sourceCode").value ='';
                            var newsletterId = $(this).closest( "tr" ).attr('id');
                            preview(newsletterId);

                            var newsletterName = $(this).closest("tr").find(".newsletterName").attr('id');
                            $("#newsletterNameTxt").val(newsletterName);
                            $("#formNewsletterId").val(newsletterId);
                        });
                        
                        $("#btnUpdate").click(function (){
                            var newsletterName = $("#newsletterNameTxt").val();
                            var content = document.getElementById("sourceCode").value;
                            $("#formNewsletterName").val(newsletterName);
                            $("#formContent").val(content);
                            $("#submitFormBtn").trigger("click");
                        });
                        
                        // DELETE NEWSLETTER
                        $(".btnDelete").click(function (){
                            var newsletterId = $(this).closest( "tr" ).attr('id');
                            if (confirm('Are you sure you want to delete Newsletter with id ' + newsletterId + "? This will delete associated schedules.")) {
                                $("#deleteId").val(newsletterId);   
                                $("#deleteFormBtn").trigger("click");
                            }
                        });

                    </script>
                </table>
            </div>
        </div>
    </div>
</div>
@stop