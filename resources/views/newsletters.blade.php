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

                        <form method="POST" action="{{ action('NewsletterController@store') }}" target="_self">
                            {{-- PROTECT FROM CROSS SITE SCRIPTING --}} @csrf
                            <button onclick="runCode();" type="button" href="" class="btn-block btn btn-success">Preview</button>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12 form-group input-group">
                                        <label>Template</label>
                                        <textarea onkeyup="runCode();" style="resize: none;" rows="15" name="sourceCode" id="sourceCode" class="form-control" rows="15"
                                            placeholder="Enter ..."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6" style="height: 200px">
                                    <label>Preview</label>
                                    <iframe style="border: 2px solid #400040; height: 315px; width: 100%;" class="rounded-sm" name="targetCode" id="targetCode">
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
                                <div class="input-group block">
                                    <input type="text" name="name" class="form-control" placeholder="Newsletter name">
                                </div>
                                <br>
                                <button type="submit" href="" class="btn-block btn btn-success">Add Newsletter</button>
                        </form>
                        </div>
                        <!-- /input-group -->
                    </div>
                    <!-- /.box-body -->
                    <!-- /.box -->
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
    </div>
    <!-- /.col -->
    {{-- </div> --}} {{-- USERS --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Newsletters list</h3>
            </div>
            <!-- /.box-header -->
            <div style="text-align: center">
                {{-- {{ $users->links() }} --}}
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Preview</th>
                        </tr>
                    </thead>
                    <tbody>
                            {{-- get the total count / the amount in each gorup then 
                                FOR THE SUB GROUP INSERTS
                                Model::count()
                                 --}}

                        {{-- <button onclick="getContent()" class="contentButton" id=" {{ $newsletter->id }}">Preview
                                </button> --}} {{-- INCREMENT newsletter --}} @foreach ($newsletters as $newsletter)
                        <tr>

                            <td>{{ $newsletter->id }}</td>
                            <td>{{ $newsletter->name }}</td>
                            <td>
                                <a id="{{ $newsletter->id }}" href="javascript:void(0)"  onclick="preview(this.id)">Preview</a>
                                <div data-id="{{ $newsletter->id }}" style="display: none"> {{ $newsletter->content }}</div>
                            </td>
                        </tr>
                        @endforeach {{-- {{ App\Role::find($user->role_id)->name }} --}}
                    </tbody>

                    {{-- DISPLAY PREVIEW --}}
                    <script>
                        function preview(id){
                            document.getElementById("sourceCode").innerHTML = $('[data-id="'+ id +'"]').html();
                            runCode();
                        }
                    </script>
                </table>
            </div>
        </div>
    </div>
</div>
@stop