@extends('layouts.app')
@section('topnavbar','Tarea Nueva')
@section('body-class','nav-md  footer_fixed')
@section('notification'){{ Session::has('notification') ? 'data-notification=true' : '' }} data-notification-type='{{ Session::get('notification')['alert_type']}}' data-notification-title='{{ Session::get('notification')['title']}}' data-notification-message='{{ Session::get('notification')['message'] }}'@endsection
@section('content')
    <div class="">
        <div class="row" style="margin-bottom: 45px;">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Nueva Tarea</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <span class="section">Información de la tarea</span>
                        <form class="form-horizontal" method="post" role="form" action="{{url('/proyectos/'.$proyecto_id.'/tasks/store')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="control-label col-md-3 col-sm-3 col-xs-12">Título <span class="required">*</span></label>
                                <div  class="col-md-6 col-sm-6 col-xs-12 ">
                                    <input id="title" data-validate-length-range="2" type="text" value="{{ old('title') }}" class="form-control col-md-7 col-xs-12" name="title"  required="required" >
                                    @if ($errors->has('title'))<span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>@endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('detail') ? ' has-error' : '' }}">
                                <label for="detail" class="control-label col-md-3 col-sm-3 col-xs-12">Detalle </label>
                                <div  class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea  id="detail" class="form-control" name="detail">{{ old('detail') }}</textarea>
                                    @if ($errors->has('detail'))<span class="help-block"><strong>{{ $errors->first('detail') }}</strong></span>@endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('hours') ? ' has-error' : '' }}">
                                <label for="hours" class="control-label col-md-3 col-sm-3 col-xs-12">Horas</label>
                                <div  class="col-md-6 col-sm-6 col-xs-12 ">
                                    <input id="hours" type="number" value="{{ old('hours') }}" class="form-control col-md-7 col-xs-12" name="hours">
                                    @if ($errors->has('hours'))<span class="help-block"><strong>{{ $errors->first('hours') }}</strong></span>@endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('points') ? ' has-error' : '' }}">
                                <label for="points" class="control-label col-md-3 col-sm-3 col-xs-12">Valoración</label>
                                <div  class="col-md-6 col-sm-6 col-xs-12 ">
                                    <input id="points" type="number" value="{{ old('points') }}" class="form-control col-md-7 col-xs-12" name="points">
                                    @if ($errors->has('points'))<span class="help-block"><strong>{{ $errors->first('points') }}</strong></span>@endif
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                    <a href="{{url('/proyectos/'.$proyecto_id.'/tasks/')}}" style="margin-right: 10px" type="button" class="btn btn-default">
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