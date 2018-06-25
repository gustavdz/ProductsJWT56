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
            &nbsp;
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
                    <div class="row">
                        <div class="col-md-12 ">

                            <form class="" method="post" role="form" action="{{url('/proyectos/'.$task->proyectos_id.'/tasks/'.$task->id.'/update')}}">
                                {{ csrf_field() }}
                                <input id="proyecto_id" type="hidden"  class="form-control" name="proyecto_id" value="{{ old('proyecto_id',$task->proyectos_id) }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                            <label for="title">Nombre del Proyecto *</label>
                                            <input id="title" type="text"  class="form-control" name="title" required value="{{ old('title',$task->title) }}">
                                            @if ($errors->has('title'))<span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>@endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('detail') ? ' has-error' : '' }}">
                                            <label for="detail">Descripcion *</label>
                                            <textarea id="detail" class="form-control" name="detail" rows="5" required>{{old('detail',$task->detail)}}</textarea>
                                            @if ($errors->has('detail'))<span class="help-block"><strong>{{ $errors->first('detail') }}</strong></span>@endif
                                        </div>
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
    </div>
</div>
@endsection

@section('scripts')
<script>
</script>
@endsection