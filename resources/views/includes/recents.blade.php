@section('recents')
<aside class="control-sidebar control-sidebar-dark">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab">Feed</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <ul class="control-sidebar-menu">
                <li class="sidebar-item">
                    <span>Latest user: {{ App\User::orderby('created_at', 'desc')->first()->email }}</span>
                    <br>
                    <span>Time: {{ App\User::orderby('created_at', 'desc')->first()->created_at }}</span>
                    <hr />
                </li>

                <span>Last subscriber: {{ App\Client::orderby('created_at', 'desc')->where('status_id', 1)->first()->email }}</span>
                <br>
                <span>Time: {{ App\Client::orderby('created_at', 'desc')->where('status_id', 1)->first()->created_at }}</span>
                <br>
                <hr />
                
                
                <span>Last unsubscriber: {{ App\Client::orderby('created_at', 'desc')->where('status_id', 2)->first()->email }}</span>
                <br>
                <span>Time: {{ App\Client::orderby('created_at', 'desc')->where('status_id', 1)->first()->created_at }}</span>
                @php
                // $mytime = Carbon\Carbon::now();
                // echo $mytime->toDateTimeString();    
                @endphp
                
                <br>
                <hr />

                <span>Time: {{ App\Client::orderby('created_at', 'desc')->first()->created_at }}</span>
                <hr />
            </ul>
        </div>
    </div>
</aside>
<div class="control-sidebar-bg"></div>