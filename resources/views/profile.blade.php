@extends('layouts.mainTemplate') 
@section('contentHeader') Profile
@endsection
 
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box-body">
            {{-- IF ANY ERRORS --}} @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <span>{{ $error }}</span> @endforeach
            </div>
            @endif

            <form action="{{ action('ProfileController@changePassword') }}" method="POST" target="_self">
                {{-- PROTECT FROM CROSS SITE SCRIPTING --}} @csrf
                <div class="col-md-12">
                    <div class="form-group col-md-4">
                        <h2 id="currentUserEmail">{{Auth::user()->email}}</h2>
                        <div class="mdl-tooltip" data-mdl-for="currentUserEmail">
                            To change your email contact the administrator
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="input-group col-md-12">
                            <input id="pass1" type="text" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <br />
                        <div class="input-group col-md-12">
                            <input id="pass2" type="text" name="password2" class="form-control" placeholder="Re-enter password" required>
                        </div>
                    </div>

                    {{-- btn-block --}}
                    <div class="form-group col-md-12">
                            <button id="changePasswordBtn" href="" class="col-md-12 btn btn-success">Change password</button>
                        <button id="changePasswordBtnSubmit" type="submit" href="" class="col-md-12 btn btn-success" hidden>Change password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $("#changePasswordBtn").click(function (){
        if ($("#pass1").val() != $("#pass2").val()) {
            alert("Passwords should match");
            return false;
        } else {
            $("#changePasswordBtnSubmit").trigger("click");
            // window.location = "{{ action('ProfileController@changePassword') }}";

        }
    });
</script>


@stop