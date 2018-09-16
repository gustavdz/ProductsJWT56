@extends('layouts.app')
@section('topnavbar','Editar Cliente')
@section('body-class','nav-md ')
@section('content')
<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Editar Cliente</h2>
                    <!--<ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>-->
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>Formulario de registro de informacion de cliente - <?php echo date("d-M-Y");?></p>
                    <span class="section">Información de Cliente</span>
                    <div class="row">
                        <div class="center col-md-3 text-center">
                            <form class="form-horizontal" method="post" role="form" action="{{url('/clients/edit_picture/'.$clients->id)}}" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-8">
                                        <img src="{{ $clients->profilepicture_filename}}" alt="..." class="img-circle img-responsive"><br>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="item form-group {{ $errors->has('profilepicture_filename') ? ' has-error' : '' }}">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input id="profilepicture_filename" class="form-control col-md-7 col-xs-12" name="profilepicture_filename" type="file">
                                                @if ($errors->has('profilepicture_filename'))<span class="help-block"><strong>{{ $errors->first('profilepicture_filename') }}</strong></span>@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-6 text-center center">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-camera"></i> Guardar Foto</button>
                                    </div>
                                </div>
                                {{ csrf_field() }}
                            </form>
                        </div>
                        <div class="col-md-9">
                            <form class="form-horizontal" method="post" role="form" action="{{url('/clients/edit/'.$clients->id)}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">

                                    <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Nombres <span class="required">*</span></label>

                                    <div  class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input id="name" data-validate-length-range="2" type="text" value="{{ $clients->name}}" class="form-control col-md-7 col-xs-12" name="name"  required="required" >
                                        @if ($errors->has('name'))<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>@endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="last_name" class="control-label col-md-3 col-sm-3 col-xs-12">Apellidos <span class="required">*</span></label>
                                    <div  class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="last_name" data-validate-length-range="2" value="{{ $clients->last_name }}" type="text" class="form-control col-md-7 col-xs-12" name="last_name"  required="required" >
                                        @if ($errors->has('last_name'))<span class="help-block"><strong>{{ $errors->first('last_name') }}</strong></span>@endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('company') ? ' has-error' : '' }}">
                                    <label for="company" class="control-label col-md-3 col-sm-3 col-xs-12">Razón Social o Empresa</label>
                                    <div  class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="company" value="{{ $clients->company }}" type="text" class="form-control col-md-7 col-xs-12" name="company" >
                                        @if ($errors->has('company'))<span class="help-block"><strong>{{ $errors->first('company') }}</strong></span>@endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                                    <div  class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="email" type="text" class="form-control col-md-7 col-xs-12" value="{{ $clients->email }}" name="email" required="required" >
                                        @if ($errors->has('email'))<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>@endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('tipo_id') ? ' has-error' : '' }}">
                                    <label for="tipo_id" class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de identificación <span class="required">*</span></label>
                                    <div  class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="tipo_id" name="tipo_id" class="form-control">
                                            <option value="CI" @if($clients->tipo_id == 'CI') selected @endif>Cédula</option>
                                            <option value="RUC" @if($clients->tipo_id == 'RUC') selected @endif>RUC</option>
                                            <option value="PAS" @if($clients->tipo_id == 'PAS') selected @endif>Pasaporte</option>
                                            <option value="PLC" @if($clients->tipo_id == 'PLC') selected @endif>Placa</option>
                                        </select>
                                        @if ($errors->has('tipo_id'))<span class="help-block"><strong>{{ $errors->first('tipo_id') }}</strong></span>@endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('dni') ? ' has-error' : '' }}">
                                    <label for="dni" class="control-label col-md-3 col-sm-3 col-xs-12">DNI/CI <span class="required">*</span></label>
                                    <div  class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="dni" type="text" class="form-control col-md-7 col-xs-12" value="{{ $clients->dni }}" name="dni" required="required" >
                                        @if ($errors->has('dni'))<span class="help-block"><strong>{{ $errors->first('dni') }}</strong></span>@endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label for="phone" class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono <span class="required">*</span></label>
                                    <div  class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="phone" type="text" class="form-control col-md-7 col-xs-12" value="{{ $clients->phone }}" name="phone" required="required" >
                                        @if ($errors->has('phone'))<span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>@endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Dirección <span class="required">*</span></label>
                                    <div  class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  id="address" class="form-control" name="address" required="required" >{{ $clients->address }}</textarea>
                                        @if ($errors->has('address'))<span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>@endif
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">
                                            Guardar
                                        </button>
                                        <a href="{{ url('/clients') }}" style="margin-right: 10px" type="button" class="btn btn-default">
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
    </div>
</div>
@endsection
