@extends('layouts.app')
@section('topnavbar','Comunicados')
@section('body-class','nav-md footer_fixed')
@section('notification')@endsection
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Comunicados </h3>
        </div>
        <div class="title_right">
            <form method="get" action="{{ url('/comunicados') }}">
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
                    <h2>Comunicados Recibidos</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if($comunicados->count()>0)
                    <div class="row">
                        <div class="col-sm-3 mail_list_column">
                            @if(Auth::user()->admin)<button id="compose" class="btn btn-sm btn-success btn-block" type="button">COMPOSE</button>@endif
                                @foreach($comunicados as $index => $comunicado)
                                    <a href="javascript:cargar_comunicado({{$comunicado->id}},'lista_{{$comunicado->id}}');">
                                        <div class="mail_list">
                                            <div class="left" id="lista_{{$comunicado->id}}">
                                                @if($comunicado->read)<i class="far fa-circle"></i>
                                                @else
                                                    <i class="fa fa-circle"></i>
                                                @endif
                                            </div>
                                            <div class="right">
                                                <h3>{{$comunicado->title}}<small>{{$comunicado->created_at}}</small></h3>
                                                <p>{{str_limit($comunicado->detail,$limit=65,$end='... Ver más')}}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                                {{$comunicados->links()}}
                        </div>
                        <!-- /MAIL LIST -->
                        <!-- CONTENT MAIL -->
                        <div class="col-sm-9 mail_view" id="comunicado_contenido">
                            <div class="inbox-body">
                                <div class="mail_heading row">
                                    <div class="col-md-12">
                                        <p class="date"> Haga clic en el comunicado que desea leer.</p>
                                    </div>
                                    <div class="col-md-8">
                                        <h4 style="margin-top: -5px">&nbsp;</h4>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <p class="date"> &nbsp;</p>
                                    </div>
                                </div>
                                <div class="sender-info">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong>&nbsp;</strong>
                                            <span>&nbsp;</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="view-mail">
                                    <br>
                                    <p>
                                        &nbsp;
                                    </p>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <!-- /CONTENT MAIL -->
                    </div>
                    @else
                        <div class="row">
                            <div class="col-sm-3 mail_list_column">
                                @if(Auth::user()->admin)<a class="btn btn-sm btn-success btn-block" href="comunicados/create" >Nuevo comunicado</a>@endif
                                    <a href="#">
                                        <div class="mail_list">
                                            <div class="left">

                                            </div>
                                            <div class="right">
                                                <h3><small><i class="fa fa-warning"></i> 0 comunicados</small></h3>
                                                <p></p>
                                            </div>
                                        </div>
                                    </a>
                            </div>
                            <div class="col-sm-9 mail_view">
                                No existen comunicados para mostrar
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        function cargar_comunicado(Id,div_lista){
            var request = $.ajax({
            url: "comunicados/"+Id,
            method: "GET",
            data: { id : Id },
            dataType: "html",
            });
            request.done(function( msg ) {
                $( "#comunicado_contenido" ).html( msg );
                $( "#"+div_lista ).html( '<i class="far fa-circle"></i>' );
            });
            request.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });
        }
        $( document ).ajaxSend(function( event, request, settings ) {
            $( "#comunicado_contenido" ).html('<i class="fas fa-spinner fa-spin" style="font-size:24px"></i>');
        });
    </script>
@endsection