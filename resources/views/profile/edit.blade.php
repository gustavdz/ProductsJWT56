@extends('layouts.app')
@section('topnavbar','Editar Cliente')
@section('body-class','nav-md ')
@section('notification'){{ Session::has('notification') ? 'data-notification=true' : '' }} data-notification-type='{{ Session::get('notification')['alert_type']}}' data-notification-title='{{ Session::get('notification')['title']}}' data-notification-message='{{ Session::get('notification')['message'] }}'@endsection
@section('content')
<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Editar Usuario</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <span class="section">Información del Usuario</span>
                    <div class="row">
                        <div class="center col-md-3 text-center">
                            <form class="form-horizontal" method="post" role="form" action="{{url('/profile/edit_picture')}}" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-8">
                                        <img src="{{ $user->profilepicture_filename}}" alt="..." class="img-circle img-responsive"><br>
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

                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Datos de la cuenta</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="col-xs-3">
                                        <!-- required for floating -->
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs tabs-left">
                                            <li class="active"><a href="#profile" data-toggle="tab">Información de Usuario</a>
                                            </li>
                                            <li><a href="#empresa" data-toggle="tab">Empresa</a>
                                            </li>
                                            <li><a href="#digital_sign" data-toggle="tab">Firma Digital</a>
                                            </li>
                                            <li><a href="#password" data-toggle="tab">Password</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-xs-9">
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="profile">
                                                <p class="lead">Datos del usuario</p>

                                                <form class="form-horizontal" method="post" role="form" action="{{url('/profile/edit')}}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">

                                                        <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Nombre <span class="required">*</span></label>

                                                        <div  class="col-md-6 col-sm-6 col-xs-12 ">
                                                            <input id="name" data-validate-length-range="2" type="text" value="{{ $user->name}}" class="form-control col-md-7 col-xs-12" name="name"  required="required" >
                                                            @if ($errors->has('name'))<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>@endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                                                        <label for="username" class="control-label col-md-3 col-sm-3 col-xs-12">Username <span class="required">*</span></label>
                                                        <div  class="col-md-6 col-sm-6 col-xs-12">
                                                            <input id="username" data-validate-length-range="2" value="{{ $user->username }}" type="text" class="form-control col-md-7 col-xs-12" name="username"  required="required" >
                                                            @if ($errors->has('username'))<span class="help-block"><strong>{{ $errors->first('username') }}</strong></span>@endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                        <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                                                        <div  class="col-md-6 col-sm-6 col-xs-12">
                                                            <input id="email" type="email" class="form-control col-md-7 col-xs-12" value="{{ $user->email }}" name="email" required="required" >
                                                            @if ($errors->has('email'))<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>@endif
                                                        </div>
                                                    </div>
                                                    <div class="ln_solid"></div>
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-md-offset-3">
                                                            <button type="submit" class="btn btn-primary">
                                                                Guardar
                                                            </button>
                                                            <a href="{{ url('/home') }}" style="margin-right: 10px" type="button" class="btn btn-default">
                                                                Cancelar
                                                            </a>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                            <div class="tab-pane" id="empresa">
                                                <p class="lead">Datos del emisor de factura</p>
                                                <form class="form-horizontal" method="post" role="form" action="{{url('/empresas/'.$empresa['action'].'/'.$empresa['id'])}}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="form-group {{ $errors->has('ruc_empresa') ? ' has-error' : '' }}">
                                                        <label for="ruc_empresa" class="control-label col-md-3 col-sm-3 col-xs-12">RUC <span class="required">*</span></label>
                                                        <div  class="col-md-6 col-sm-6 col-xs-12">
                                                            <input id="ruc_empresa" data-validate-length-range="3" value="{{ $empresa['ruc_empresa'] }}" type="text" class="form-control col-md-7 col-xs-12" name="ruc_empresa"  required="required" >
                                                            @if ($errors->has('ruc_empresa'))<span class="help-block"><strong>{{ $errors->first('ruc_empresa') }}</strong></span>@endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('razon_social') ? ' has-error' : '' }}">
                                                        <label for="razon_social" class="control-label col-md-3 col-sm-3 col-xs-12">Razón Social <span class="required">*</span></label>
                                                        <div  class="col-md-6 col-sm-6 col-xs-12 ">
                                                            <input id="razon_social" data-validate-length-range="3" type="text" value="{{ $empresa['razon_social']}}" class="form-control col-md-7 col-xs-12" name="razon_social"  required="required" >
                                                            @if ($errors->has('razon_social'))<span class="help-block"><strong>{{ $errors->first('razon_social') }}</strong></span>@endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('nombre_comercial') ? ' has-error' : '' }}">
                                                        <label for="nombre_comercial" class="control-label col-md-3 col-sm-3 col-xs-12">Nombre Comercial <span class="required">*</span></label>
                                                        <div  class="col-md-6 col-sm-6 col-xs-12">
                                                            <input id="nombre_comercial" data-validate-length-range="3" value="{{ $empresa['nombre_comercial']}}" type="text" class="form-control col-md-7 col-xs-12" name="nombre_comercial"  required="required" >
                                                            @if ($errors->has('nombre_comercial'))<span class="help-block"><strong>{{ $errors->first('nombre_comercial') }}</strong></span>@endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('direccion_matriz') ? ' has-error' : '' }}">
                                                        <label for="direccion_matriz" class="control-label col-md-3 col-sm-3 col-xs-12">Dirección de matriz <span class="required">*</span></label>
                                                        <div  class="col-md-6 col-sm-6 col-xs-12">
                                                            <textarea id="direccion_matriz" name="direccion_matriz" class="form-control" required="required">{{ $empresa['direccion_matriz']}}</textarea>
                                                            @if ($errors->has('direccion_matriz'))<span class="help-block"><strong>{{ $errors->first('direccion_matriz') }}</strong></span>@endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('direccion_sucursal') ? ' has-error' : '' }}">
                                                        <label for="direccion_sucursal" class="control-label col-md-3 col-sm-3 col-xs-12">Dirección de la sucursal <span class="required">*</span></label>
                                                        <div  class="col-md-6 col-sm-6 col-xs-12">
                                                            <textarea id="direccion_sucursal" name="direccion_sucursal" class="form-control" required="required">{{ $empresa['direccion_sucursal'] }}</textarea>
                                                            @if ($errors->has('direccion_sucursal'))<span class="help-block"><strong>{{ $errors->first('direccion_sucursal') }}</strong></span>@endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('telefono') ? ' has-error' : '' }}">
                                                        <label for="telefono" class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono <span class="required">*</span></label>
                                                        <div  class="col-md-6 col-sm-6 col-xs-12">
                                                            <input id="telefono" data-validate-length-range="3" value="{{ $empresa['telefono'] }}" type="text" class="form-control col-md-7 col-xs-12" name="telefono"  required="required" >
                                                            @if ($errors->has('telefono'))<span class="help-block"><strong>{{ $errors->first('telefono') }}</strong></span>@endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group {{ $errors->has('logo') ? ' has-error' : '' }}">
                                                        <label for="logo" class="control-label col-md-3 col-sm-3 col-xs-12">Logo <span class="required">*</span></label>
                                                        <div  class="col-md-6 col-sm-6 col-xs-12">
                                                            <input id="logo" type="file" class="form-control col-md-7 col-xs-12" name="logo" >
                                                            @if ($errors->has('logo'))<span class="help-block"><strong>{{ $errors->first('logo') }}</strong></span>@endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        @if($empresa['logo']!= 'error')<label class="control-label col-md-8"><img src="{{ $empresa['logo']}}" width="50%"></label>
                                                        @else
                                                            <label class="control-label col-md-8">No ha cargado logo de empresa</label>
                                                        @endif

                                                    </div>

                                                    <div class="ln_solid"></div>
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-md-offset-3">
                                                            <button type="submit" class="btn btn-primary">
                                                                Guardar
                                                            </button>
                                                            <a href="{{ url('/home') }}" style="margin-right: 10px" type="button" class="btn btn-default">
                                                                Cancelar
                                                            </a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="digital_sign">
                                                <p class="lead">Firma Digital</p>
                                                <form class="form-horizontal" method="post" role="form" action="{{url('/profile/edit_p12')}}" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-offset-2 col-md-8">
                                                            <p>Certificado cargado: {{ $user->p12_filename}}</p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="item form-group {{ $errors->has('p12_filename') ? ' has-error' : '' }}">
                                                                <label for="p12_filename" class="control-label col-md-3 col-sm-3 col-xs-12">Certificado digital .p12 <span class="required">*</span></label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <input id="p12_filename" class="form-control col-md-7 col-xs-12" name="p12_filename" type="file">
                                                                    @if ($errors->has('p12_filename'))<span class="help-block"><strong>{{ $errors->first('p12_filename') }}</strong></span>@endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group {{ $errors->has('p12_password') ? ' has-error' : '' }}">
                                                                <label for="p12_password" class="control-label col-md-3 col-sm-3 col-xs-12">Password del Certificado <span class="required">*</span></label>
                                                                <div  class="col-md-6 col-sm-6 col-xs-12">
                                                                    <input id="p12_password" data-validate-length-range="2" type="password" class="form-control col-md-7 col-xs-12" name="p12_password"  required="required">
                                                                    @if ($errors->has('p12_password'))<span class="help-block"><strong>{{ $errors->first('p12_password') }}</strong></span>@endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="ln_solid"></div>
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-md-offset-3">
                                                                <button type="submit" class="btn btn-primary">
                                                                    Guardar
                                                                </button>
                                                                <a href="{{ url('/home') }}" style="margin-right: 10px" type="button" class="btn btn-default">
                                                                    Cancelar
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{ csrf_field() }}
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="password">
                                                <p class="lead">Actualización de contraseña</p>
                                                <form class="form-horizontal" method="post" role="form" action="{{url('/profile/edit_password')}}" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                                                <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña <span class="required">*</span></label>
                                                                <div  class="col-md-6 col-sm-6 col-xs-12">
                                                                    <input id="password" data-validate-length-range="6" type="password" class="form-control col-md-7 col-xs-12" name="password"  required="required">
                                                                    @if ($errors->has('password'))<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>@endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                                <label for="password_confirmation" class="control-label col-md-3 col-sm-3 col-xs-12">Confirmación de contraseña <span class="required">*</span></label>
                                                                <div  class="col-md-6 col-sm-6 col-xs-12">
                                                                    <input id="password_confirmation" data-validate-length-range="6" type="password" class="form-control col-md-7 col-xs-12" name="password_confirmation"  required="required">
                                                                    @if ($errors->has('password_confirmation'))<span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>@endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="ln_solid"></div>
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-md-offset-3">
                                                                <button type="submit" class="btn btn-primary">
                                                                    Guardar
                                                                </button>
                                                                <a href="{{ url('/home') }}" style="margin-right: 10px" type="button" class="btn btn-default">
                                                                    Cancelar
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{ csrf_field() }}
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    @if (session()->has('notification'))
        <script>
            (function(){
                if (!document.body.dataset.notification)
                    return false;
                new PNotify({
                    title: document.body.dataset.notificationTitle,
                    text: document.body.dataset.notificationMessage,
                    type: document.body.dataset.notificationType,
                    styling: 'bootstrap3'
                });
            })();
        </script>
    @endif
@endsection

