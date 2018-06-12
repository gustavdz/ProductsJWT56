@extends('layouts.app')
@section('topnavbar','Proyectos')
@section('body-class','nav-md  footer_fixed')
@section('notification'){{ Session::has('notification') ? 'data-notification=true' : '' }} data-notification-type='{{ Session::get('notification')['alert_type']}}' data-notification-title='{{ Session::get('notification')['title']}}' data-notification-message='{{ Session::get('notification')['message'] }}'@endsection
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-left top_search">
                    <div class="input-group">
                        <h3>Proyectos</h3>
                    </div>
                </div>
            </div>

            <div class="title_right">
                <form method="get" action="{{ url('/proyectos') }}">
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
                    <div class="x_title">
                        <h2>Proyectos</h2>
                        <a style="margin-left: 1%" href="{{ url('/proyectos/create') }}" type="button"  class=" btn btn-primary btn-sm btn-fill ">
                            <i class="fa fa-plus"></i> Nuevo
                        </a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <p>Listado de proyectos con sus respectivos departamentos asociados</p>

                        <!-- start project list -->
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Cliente</th>
                                <th>Progreso</th>
                                <th>Fecha Inicio - Fecha Fin</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($proyectos as $proyecto)
                                <tr>
                                    <td>{{ $proyecto->id }}</td>
                                    <td>
                                        <a>{{ $proyecto->title }}</a>
                                        <br />
                                        <small>Creado {{ $proyecto->created_at }}</small>
                                    </td>
                                    <td>
                                        <a>{{ $proyecto->client->name }} {{ $proyecto->client->last_name }}</a>
                                        <br />
                                        <small>Email: {{ $proyecto->client->email }}</small>
                                        <br />
                                        <small>Teléfono: {{ $proyecto->client->phone }}</small>
                                    </td>
                                    <td class="project_progress">
                                        <div class="progress progress_sm">
                                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="0"></div>
                                        </div>
                                        <small>0% Completado</small>
                                    </td>
                                    <td>
                                        <div id="" style=" cursor: pointer; ">
                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                            <span>{{ $proyecto->fecha_inicio }} - {{ $proyecto->fecha_fin }}  </span>
                                        </div>
                                    </td>
                                    <td>

                                        <span class="label label-{{ $proyecto->EstadoEtiqueta }}">{{ $proyecto->EstadoDescripcion}}</span>
                                    </td>
                                    <td>
                                        <form method="post"  role="form" action="{{url('/proyectos/'.$proyecto->id.'/delete')}}">
                                            {{csrf_field()}}
                                            <a  href="{{url('/proyectos/'.$proyecto->id.'/ver')}}" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Ver </a>
                                            <a  href="{{url('/proyectos/'.$proyecto->id.'/edit')}}"   class="btn btn-dark btn-xs"><i class="fa fa-edit"></i> Editar </a>
                                            <button id="delete" type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Eliminar </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="{{url('/proformas/'.$proyecto->id.'/delete')}}">
                                            {{csrf_field()}}
                                            <a href="{{url('/proyectos/'.$proyecto->id.'/iniciar')}}"  class="btn btn-primary btn-xs"><i class="fa fa-flag-checkered"></i> Iniciar </a>
                                            <a href="{{url('/proyectos/'.$proyecto->id.'/resultados')}}" class="btn btn-warning btn-xs"><i class="fa fa-paperclip"></i> E. Resultados </a>
                                            <a href="{{url('/proyectos/'.$proyecto->id.'/proformas')}}"  class="btn btn-success btn-xs"><i class="fa fa-money"></i> Cotizaciones </a>
                                            <a href="{{url('/proyectos/'.$proyecto->id.'/terminar')}}"  class="btn btn-danger btn-xs"><i class="fa fa-power-off"></i> Terminar </a>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                        <!-- end project list -->
                        {{ $proyectos->links() }}
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