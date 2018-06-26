@extends('layouts.app')
@section('topnavbar','Proyecto Detalle')
@section('body-class','nav-md  footer_fixed')

@section('content')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{$proyecto->title}}</h3>
            <a style="margin-left: 1%" href="{{ url('/proyectos/') }}" type="button"  class=" btn btn-warning btn-sm btn-fill">
                <i class="fa fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row" style="margin-bottom: 45px;">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Detalle del Proyecto</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <ul class="stats-overview">
                            <li>
                                <span class="name"> Tareas Creadas </span>
                                <span class="value text-success"> {{$proyecto->tasks()->count()}} </span>
                            </li>
                            <li>
                                <span class="name"> Total de Ingresos </span>
                                <span class="value text-success"> $ 2000 </span>
                            </li>
                            <li class="hidden-phone">
                                <span class="name"> Duración estimada del proyecto </span>
                                <span class="value text-success">  @if($proyecto->fecha_fin){{$proyecto->fecha_fin->diffInDays($proyecto->fecha_inicio)}} @if($proyecto->fecha_fin->diffInDays($proyecto->fecha_inicio) > 1)días @else día @endif @else 0 días @endif </span>
                            </li>
                        </ul>
                        <br />
                        <div id="mainb" style="height:350px;"></div>
                        <div>
                            <h4>Tareas del proyecto</h4>
                            <!-- end of user messages -->
                            <ul class="messages">
                                @foreach($proyecto->tasks()->get() as $task)
                                <li>
                                    <img src="{{ asset(Auth::user()->profilepicture_filename) }}" class="avatar" alt="Avatar">
                                    <div class="message_date">
                                        <h3 class="date text-info">{{$task->created_at->format('d')}}</h3>
                                        <p class="month">{{$task->created_at->format('M')}}</p>
                                    </div>
                                    <div class="message_wrapper">
                                        <h4 class="heading" style="@if($task->complete) text-decoration:line-through; @endif">{{$task->title}}</h4>
                                        <blockquote class="message" style="@if($task->complete) text-decoration:line-through; @endif">{{$task->detail}}</blockquote>
                                        <br />

                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <!-- end of user messages -->
                        </div>
                    </div>

                    <!-- start project-detail sidebar -->
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <section class="panel">
                            <div class="x_title">
                                <h2>Descripción del Proyecto</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <p>{{$proyecto->detail}}</p>
                                <br />
                                <div class="project_detail">
                                    <p class="title">Cliente</p>
                                    <p>{{ $proyecto->client->name }} {{ $proyecto->client->last_name }}</p>
                                </div>
                                <br />
                                <div class="text-left mtop20">
                                    <a href="{{url('/proyectos/'.$proyecto->id.'/iniciar')}}"  class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Iniciar"><i class="fa fa-flag-checkered"></i></a>
                                    <a href="{{url('/proyectos/'.$proyecto->id.'/resultados')}}" class="btn btn-warning btn-sm"  data-toggle="tooltip" data-placement="top" title="Estado de Resultado"><i class="fa fa-balance-scale"></i></a>
                                    <a href="{{url('/proyectos/'.$proyecto->id.'/proformas')}}"  class="btn btn-success btn-sm"  data-toggle="tooltip" data-placement="top" title="Cotizaciones"><i class="fa fa-money"></i></a>
                                </div>
                            </div>

                        </section>

                    </div>
                    <!-- end project-detail sidebar -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection