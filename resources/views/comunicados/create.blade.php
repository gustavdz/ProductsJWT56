@extends('layouts.app')
@section('topnavbar','Comunicado Nuevo')
@section('body-class','nav-md ')
@section('notification'){{ Session::has('notification') ? 'data-notification=true' : '' }} data-notification-type='{{ Session::get('notification')['alert_type']}}' data-notification-title='{{ Session::get('notification')['title']}}' data-notification-message='{{ Session::get('notification')['message'] }}'@endsection
@section('content')
<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Enviar Nuevo Comunicado</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                        <span class="section">Información del Comunicado</span>
                    <form class="form-horizontal" method="post" role="form" action="{{url('/comunicados/store')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label col-md-3 col-sm-3 col-xs-12">Título <span class="required">*</span></label>
                            <div  class="col-md-6 col-sm-6 col-xs-12 ">
                                <input id="title" data-validate-length-range="2" type="text" value="{{ old('title') }}" class="form-control col-md-7 col-xs-12" name="title"  required="required" >
                                @if ($errors->has('title'))<span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>@endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('detail') ? ' has-error' : '' }}">
                            <label for="detail" class="control-label col-md-3 col-sm-3 col-xs-12">Detalle <span class="required">*</span></label>
                            <div  class="col-md-6 col-sm-6 col-xs-12">
                                <textarea  id="detail" class="form-control" name="detail" required="required" >{{ old('detail') }}</textarea>
                                @if ($errors->has('detail'))<span class="help-block"><strong>{{ $errors->first('detail') }}</strong></span>@endif
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                   <i class="fa fa-send"></i> Enviar
                                </button>
                                <a href="{{ url('/') }}" style="margin-right: 10px" type="button" class="btn btn-default">
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
