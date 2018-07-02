@extends('layouts.errors')
@section('topnavbar','Error 403')
@section('body-class','nav-md')

@section('content')
<div class="col-md-12">
    <div class="col-middle">
        <div class="text-center text-center">
            <h1 class="error-number">403</h1>
            <h2>Lo siento pero esta acción no esta autorizada </h2>
            <p>Esta acción que intenta realizar no esta autorizada para su usuario.</p>
            <div class="mid_center">
                <a href="{{ url()->previous() }}">Volver a la página anterior</a>
            </div>
        </div>
    </div>
</div>
@endsection
