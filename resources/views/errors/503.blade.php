@extends('layouts.errors')
@section('topnavbar','Error 503')
@section('body-class','nav-md')

@section('content')
    <div class="col-md-12">
        <div class="col-middle">
            <div class="text-center text-center">
                <h1 class="error-number">503</h1>
                <h2>Sitio en mantenimiento</h2>
                <p>Servicio no disponible por el momento. Intente de nuevo en unos minutos.</p>
            </div>
        </div>
    </div>
@endsection