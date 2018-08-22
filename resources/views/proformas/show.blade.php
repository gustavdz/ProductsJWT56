@extends('layouts.app')
@section('topnavbar','Proformas')
@section('body-class','nav-md  footer_fixed')
@section('notification'){{ Session::has('notification') ? 'data-notification=true' : '' }} data-notification-type='{{ Session::get('notification')['alert_type']}}' data-notification-title='{{ Session::get('notification')['title']}}' data-notification-message='{{ Session::get('notification')['message'] }}'@endsection
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-left top_search">
                    <div class="input-group">
                        <h3>Proformas</h3>
                    </div>
                </div>
            </div>

            <div class="title_right">
                <form method="get" action="{{ url('/proforms') }}">
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
                        <h2>Proformas</h2>
                        <a style="margin-left: 1%" href="{{ url('/proyectos/'.$proyecto_id.'/proforms/create') }}" type="button"  class=" btn btn-primary btn-sm btn-fill ">
                            <i class="fa fa-plus"></i> Nuevo
                        </a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <p>Listado de proyectos con sus respectivos departamentos asociados</p>

                        <!-- start project list -->
                        <div class="col-md-12">
                            <table id="datatable-responsive" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipo</th>
                                    <th>Cliente</th>
                                    <th>Observación</th>
                                    <th>Duración</th>
                                    <th>Forma de Pago</th>
                                    <th>Fecha Creación</th>
                                    <th>Opciones</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($proformas as $proforma)
                                    <tr>
                                        <td>{{ $proforma->id }}</td>
                                        <td>{{ $proforma->type }}</td>
                                        <td>{{ $proforma->company }} - {{ $proforma->DNI }}
                                            <br><small>{{$proforma->client->name}} {{$proforma->client->lastname}}</small>
                                            <br><small>{{$proforma->client->email}} {{$proforma->client->phone}}</small>
                                        </td>
                                        <td>{{ str_limit($proforma->observations,25,'...') }}</td>
                                        <td>{{ $proforma->duration }}</td>
                                        <td>{{ $proforma->paidform }}</td>
                                        <td>{{ $proforma->created_at }}</td>
                                        <td>
                                            <a href="{{url('/proyectos/'.$proyecto_id.'/proforms/'.$proforma->id.'/ver')}}"  class="btn btn-success btn-xs"  data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i> Ver</a>
                                            <a href="{{url('/proyectos/'.$proyecto_id.'/proforms/'.$proforma->id.'/eliminar')}}"  class="btn btn-danger btn-xs"  data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i> Eliminar</a>
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                            <!-- end project list -->
                            {{ $proformas->links() }}
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