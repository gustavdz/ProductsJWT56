@extends('layouts.errors')
@section('topnavbar','Error 500')
@section('body-class','nav-md')

@section('content')
<div class="col-md-12">
    <div class="col-middle">
        <div class="text-center text-center">
            <h1 class="error-number">500</h1>
            <h2>Internal Server Error</h2>
            <p>Hacemos seguimiento a estos errores automáticamente, pero si los errores persisten por favor contáctenos.</p>
            <div class="mid_center">
                <a href="/">Volver al inicio</a>
            </div>
        </div>
    </div>
</div>
@endsection
