{{-- TODO  WELCOME CLIENT EMAIL TEMPLATE--}}

{!! $newsletter->content !!}
<br />

<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
<div class="col-md-12">
    <table cellspacing="0" cellpadding="0" width="615" align="center" style="font-family:Helvetica;font-size:12px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px; border-width:1px;border-style:solid;border-color:rgb(224,224,224); width: 100%">
        <tbody>
            <tr>
                <td style="border-top-width:1px;border-top-style:solid;border-top-color:rgb(224,224,224)">
                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tbody>
                            <tr>
                                <td height="35"></td>
                            </tr>
                            <tr>
                                {{-- CHANGE THE LINK TO INCLUDE HTTP etc --}}
                                <td style="text-align:center;font-family:AvenirNext-UltraLight,Helvetica,Arial,sans-serif;font-size:19px;color:rgb(108,108,108);line-height:30px">
                                    If you have not subscribed click here to unsubscribe-> <span></span>
                                    
                                    {{-- ADD IP ADDRESS OF THE PORTAL BEFORE SLASH--}}
                                    <a href="/unsubscribe/{{ $client->sub_token }}" style="color:rgb(0,191,145);text-decoration:none" target="_blank">Unsubscribe</a>
                                </td>
                            </tr>
                            <tr>
                                <td height="35"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
</div>