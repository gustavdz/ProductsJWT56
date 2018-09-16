@extends('layouts.errors')
@section('topnavbar','Error 419')
@section('body-class','nav-md')

@section('content')
<div class="col-md-12">
    <div class="col-middle">
        <div class="text-center text-center">
            <h1 class="error-number">419</h1>
            <h2>La página ha expirado debido a inactividad.</h2>
            <p>Por motivos de seguridad debe iniciar sesión nuevamente.
            </p>
            <div class="mid_center">
                <a href="{{ url('/') }}">Iniciar sesión</a>
            </div>
        </div>
    </div>
</div>
@endsection
