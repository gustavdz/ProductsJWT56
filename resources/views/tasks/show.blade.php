@extends('layouts.app')
@section('topnavbar','Tareas')
@section('body-class','nav-md  footer_fixed')
@section('notification'){{ Session::has('notification') ? 'data-notification=true' : '' }} data-notification-type='{{ Session::get('notification')['alert_type']}}' data-notification-title='{{ Session::get('notification')['title']}}' data-notification-message='{{ Session::get('notification')['message'] }}'@endsection
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
                <form method="get" action="{{ url('/proyectos/'.$proyecto_id.'/tasks') }}">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                          <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="row x_title">
                        <div class="col-md-6">
                            <a style="margin-left: 1%" href="{{ url('/proyectos/') }}" type="button"  class=" btn btn-warning btn-sm btn-fill">
                                <i class="fa fa-arrow-left"></i> Volver
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a style="margin-left: 1%" href="{{ url('/proyectos/'.$proyecto_id.'/tasks/create') }}" type="button"  class="pull-right btn btn-primary btn-sm btn-fill">
                                <i class="fa fa-plus"></i> Nueva
                            </a>
                        </div>

                        <div class="clearfix"></div>

                    </div>
                    <div class="x_content">

                        <p>Listado de tareas para el proyecto</p>

                        <!-- start project list -->
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Título</th>
                                <th>Detalle</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td>
                                        <a>{{ $task->title }}</a>
                                    </td>
                                    <td>
                                        <a>{{ $task->detail }} </a>
                                    </td>
                                    <td>

                                        <span class="label label-{{ $task->EstadoEtiqueta }}">{{ $task->EstadoDescripcion}}</span>
                                    </td>
                                    <td>
                                        <form method="post"  role="form" action="{{url('/proyectos/'.$proyecto_id.'/tasks/'.$task->id.'/delete')}}">
                                            {{csrf_field()}}
                                            @if($task->complete)
                                                <a  href="{{url('/proyectos/'.$proyecto_id.'/tasks/'.$task->id.'/incomplete')}}"   class="btn btn-warning btn-xs"><i class="fa fa-undo"></i> Pendiente </a>
                                            @else
                                                <a  href="{{url('/proyectos/'.$proyecto_id.'/tasks/'.$task->id.'/complete')}}"   class="btn btn-success btn-xs"><i class="fa fa-check"></i> Completar </a>
                                            @endif
                                            <a  href="{{url('/proyectos/'.$proyecto_id.'/tasks/'.$task->id.'/edit')}}"   class="btn btn-dark btn-xs"><i class="fa fa-edit"></i> Editar </a>
                                            <button id="delete" type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Eliminar </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                        <!-- end project list -->
                        {{ $tasks->links() }}
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