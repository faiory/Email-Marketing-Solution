<body>
    <div>
        <table cellspacing="0" cellpadding="0" width="615" align="center" style="font-family:Helvetica;font-size:12px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px">
            <tbody>
                <tr>
                    <td height="65"></td>
                </tr>
                <tr>
                    <td height="100"></td>
                </tr>
                <tr>
                    <td style="font-family:AvenirNext-Medium,Helvetica,Arial,sans-serif;font-size:22px;color:rgb(66,66,66);line-height:30px">Welcome, {{ $client->email }}</td>
                </tr>
                <tr>
                    <td height="30"></td>
                </tr>
                <tr>
                    <td style="font-family:AvenirNext-UltraLight,Helvetica,Arial,sans-serif;font-size:22px;font-weight:300;color:rgb(108,108,108);line-height:36px">
                        Thank you for subscribing to our newletter. It is great to have you onboard with our newsletter. This service will notify
                        you of our latest services and promotions and might even provide you with the service combination that you need
                    </td>
                </tr>
                <tr>
                    <td height="30"></td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td height="30"></td>
                </tr>
                <tr>
                    <td height="70"></td>
                </tr>
                <tr>
                    <td style="border-top-width:1px;border-top-style:solid;border-top-color:rgb(224,224,224)">
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td height="35"></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;font-family:AvenirNext-UltraLight,Helvetica,Arial,sans-serif;font-size:19px;color:rgb(108,108,108);line-height:30px">
                                        If you wish to unsubscribed click here -> <span></span>
                                        <a href="unsubscribe/{{ $client->sub_token }}" style="color:rgb(0,191,145);text-decoration:none" target="_blank">Unsubscribe</a>
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
</body>