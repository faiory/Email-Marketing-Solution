<head>
    @include('includes.head')
</head>
<div class="alert alert-danger">
    @foreach ($errors as $error)
    <span>{{ $error }}</span> <br /> @endforeach
</div>