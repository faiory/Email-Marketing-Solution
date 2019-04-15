
{{--
<!DOCTYPE HTML>
<html>

<head>
    <style>
        textarea,
        iframe {
            border: 2px solid #400040;
            height: 600px;
            width: 100%;
        }
    </style>
</head>

<body>
    <table width="100%" height="100%">
        <tr>
            <th>
                <table width="100%" height="100%" border="0" cellspacing="5" cellpadding="5">
                    <tr>
                        <td width="50%" scope="col"> </td>
                        <td width="50%" scope="col" align="left">
                            <center><input onclick="runCode();" type="button" value="Run Code!"></center>
                        </td>
                    </tr>
                    <td>
                        <form>
                            <b>Paste Your Code here!</b>
                            <textarea name="sourceCode" id="sourceCode">
</textarea>
                        </form>
                    </td>

                    <td><b>Output</b>
                        <iframe name="targetCode" id="targetCode"> </iframe> </td>
                </table>
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
        </tr>
        </th>
    </table>
</body>

</html> --}} {{--
<table style="width: 100%; border: 0; cellspacing: 0; cellpadding: 0;">
    <tr>
        <td width="50%" scope="col">
            &nbsp;
        </td>
        <td width="50%" scope="col" style="align: left">
            <input value="run code" type="button" onclick="runCode();">
        </td>
        <td>
            <form></form>
            <strong>code</strong>
            <textarea name="sourceCode" id="sourceCode" cols="30" rows="10">
                    <html>
                        <head>
                            <title>hello</title>
                        </head>
                        <body>
                            <h1>
                                hey
                            </h1>
                        </body>
                    </html>
                </textarea>
        </td>
        <td>
            <strong>output</strong><iframe name="targetCode" id="targetCode"></iframe></td>
        </td>
    </tr>
</table>
<script>
    function runCode(){
            var content = document.getElementById("sourceCode").value;
            var iframe = document.getElementById("targetCode");
            iframe = (iframe.contentWindow)?iframe.contentWindow.document:(iframe.contentDocument)?iframe.contentDocument.document: iframe.contentDocument;
            iframe.document.open();
            iframe.document.write(content);
            iframe.document.close();
            return false;
        }
        runCode();

</script> --}} {{-- --}} {{-- 
@extends('app.blade.php') 
@section('content')
<div class='row'>
    <div class='col-md-6'>
        <!-- Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Randomly Generated Tasks</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @foreach($tasks as $task)
                <h5>
                    {{ $task['name'] }}
                    <small class="label label-{{$task['color']}} pull-right">{{$task['progress']}}%</small>
                </h5>
                <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-{{$task['color']}}" style="width: {{$task['progress']}}%"></div>
                </div>
                @endforeach

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <form action='#'>
                    <input type='text' placeholder='New task' class='form-control input-sm' />
                </form>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class='col-md-6'>
        <!-- Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Second Box</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                A separate section to add any kind of widget. Feel free to explore all of AdminLTE widgets by visiting the demo page on
                <a href="https://almsaeedstudio.com">Almsaeed Studio</a>.
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->

</div>
<!-- /.row -->
@endsection
 --}}