@extends('layouts.errors')
@section('topnavbar','Error 419')
@section('body-class','nav-md')

@section('content')
<div class="col-md-12">
    <div class="col-middle">
        <div class="text-center text-center">
            <h1 class="error-number">405</h1>
            <h2>La página esperaba parámetros para poder cargar.</h2>
            <p>Por motivos de seguridad debe debe regresar a la página anterior.
            </p>
            <div class="mid_center">
                <a href="{{ url()->previous() }}">Volver a la página anterior</a>
            </div>
        </div>
    </div>
</div>
@endsection
