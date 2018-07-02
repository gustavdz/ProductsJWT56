@extends('layouts.errors')
@section('topnavbar','Error 404')
@section('body-class','nav-md')

@section('content')
<div class="col-md-12">
    <div class="col-middle">
        <div class="text-center text-center">
            <h1 class="error-number">404</h1>
            <h2>Lo siento pero no podemos encontrar esta página</h2>
            <p>Esta página que estas buscando no existe.
            </p>
            <div class="mid_center">
                <a href="{{ url()->previous() }}">Volver a la página anterior</a>
            </div>
        </div>
    </div>
</div>
@endsection
