@extends('layouts.app')
@section('topnavbar','Editar Proyecto')
@section('body-class','nav-md  footer_fixed')

@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-left top_search">
                <div class="input-group">
                    <h3>Tareas</h3>
                </div>
            </div>
        </div>
        <div class="title_right">
            &nbsp
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Actualizar Tarea</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal" method="post" role="form" action="{{url('/proyectos/'.$task->proyectos_id.'/tasks/'.$task->id.'/update')}}">
                        {{ csrf_field() }}
                        <input id="proyecto_id" type="hidden"  class="form-control" name="proyecto_id" value="{{ old('proyecto_id',$task->proyectos_id) }}">
                        <input id="complete" type="hidden"  class="form-control" name="complete" value="{{ old('complete',$task->complete) }}">
                        <input id="complete_date" type="hidden"  class="form-control" name="complete_date" value="{{ old('complete_date',$task->complete_date) }}">

                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label col-md-3 col-sm-3 col-xs-12">Título <span class="required">*</span></label>
                            <div  class="col-md-6 col-sm-6 col-xs-12 ">
                                <input id="title" data-validate-length-range="2" type="text" value="{{ old('title',$task->title) }}" class="form-control col-md-7 col-xs-12" name="title"  required="required" >
                                @if ($errors->has('title'))<span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>@endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('detail') ? ' has-error' : '' }}">
                            <label for="detail" class="control-label col-md-3 col-sm-3 col-xs-12">Detalle </label>
                            <div  class="col-md-6 col-sm-6 col-xs-12">
                                <textarea  id="detail" class="form-control" name="detail">{{ old('detail',$task->detail) }}</textarea>
                                @if ($errors->has('detail'))<span class="help-block"><strong>{{ $errors->first('detail') }}</strong></span>@endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('hours') ? ' has-error' : '' }}">
                            <label for="hours" class="control-label col-md-3 col-sm-3 col-xs-12">Horas</label>
                            <div  class="col-md-6 col-sm-6 col-xs-12 ">
                                <input id="hours" type="number" value="{{ old('hours',$task->hours) }}" class="form-control col-md-7 col-xs-12" name="hours">
                                @if ($errors->has('hours'))<span class="help-block"><strong>{{ $errors->first('hours') }}</strong></span>@endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('points') ? ' has-error' : '' }}">
                            <label for="points" class="control-label col-md-3 col-sm-3 col-xs-12">Valoración</label>
                            <div  class="col-md-6 col-sm-6 col-xs-12 ">
                                <input id="points" type="number" value="{{ old('points',$task->points) }}" class="form-control col-md-7 col-xs-12" name="points">
                                @if ($errors->has('points'))<span class="help-block"><strong>{{ $errors->first('points') }}</strong></span>@endif
                            </div>
                        </div>
                        <hr />
                        <div class="row ">
                            <div class="col-md-12 ">
                                <div class="pull-right">
                                    <a type="button" href="{{url('/proyectos/'.$task->proyectos_id.'/tasks/')}}" class="btn btn-default  btn-fill " >Cancelar</a>
                                    <button type="submit" class="btn btn-primary  btn-fill " >Guardar</button>
                                </div>

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
<script>
</script>
@endsection