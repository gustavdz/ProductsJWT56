@extends('layouts.app')
@section('topnavbar','Usuarios')
@section('body-class','nav-md  footer_fixed')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Resetear Usuario</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <p>Formulario de reseteo de contraseña de usuarios </p>

                        <form class="form-horizontal" method="post" role="form" action="{{url('/password/email')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">

                                <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>

                                <div  class="col-md-6 col-sm-6 col-xs-12 ">
                                    <input id="email" type="email" readonly value="{{ $user->email }}" class="form-control col-md-7 col-xs-12" name="email"  required="required" >

                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        Resetear Password
                                    </button>
                                    <a href="{{ url('/users') }}" style="margin-right: 10px" type="button" class="btn btn-default">
                                        Cancelar
                                    </a>
                                </div>
                            </div>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')@endsection