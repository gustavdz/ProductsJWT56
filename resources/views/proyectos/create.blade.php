@extends('layouts.app')
@section('topnavbar','Proyecto Nuevo')
@section('body-class','nav-md  footer_fixed')

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
            &nbsp;
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Agregar Nuevo Proyecto</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12 ">
                            <form class="" method="post" role="form" action="{{url('/proyectos/store')}}">
                                {{ csrf_field() }}
                                <input id="client_id" type="hidden"  class="form-control" name="client_id" value="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Nombre del Proyecto</label>
                                            <input id="title" type="text"  class="form-control" name="title"   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <div class="input-group">
                                                <input id="cliente" type="text"  class="form-control" name="cliente"  readonly required>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary"  onclick="busquedaClientes()" type="button">Buscar</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="detail">Descripcion</label>
                                            <textarea id="detail" class="form-control" name="detail" rows="5" ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formaPago">Forma de Pago</label>
                                            <textarea id="formaPago" class="form-control" name="formaPago" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label for="observations">Observaciones</label>
                                            <textarea id="observations" class="form-control" name="observations" rows="5" ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row ">
                                    <div class="col-md-12 ">
                                        <div class="pull-right">
                                            <a type="button" href="{{url('/proyectos')}}" class="btn btn-default  btn-fill " >Cancelar</a>
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
    function busquedaClientes()
    {
        $('#AceptarModal').addClass("clientesModal");
        var div='';
        $.ajax({
            url:'{{ url('/clients/modal') }}',
            type: 'GET',
            dataType: 'HTML',
            success: function(clientes){
                $('.modal-body').empty();
                $('#myModalLabel').text('Clientes');
                $.ajax({
                    url:'{{ url('/clients/verJson') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(columnas){
                        $('#tableClients').DataTable( {
                            "paging": true,
                            "bAutoWidth": true,
                            "select": true,
                            "ajax": {
                                "url" : "/clients/verJson",
                                "type" : "GET",
                                "dataSrc": ""
                            },
                            "columns" : [ {
                                "data" : "id"
                            }, {
                                "data": function(data){
                                    return data.name+' '+data.last_name;
                                }
                            }, {
                                "data" : "phone"
                            }, {
                                "data" : "email"
                            } ]


                        } );

                    }
                });

                $('.modal-body').append(clientes);
                $('.modalBase').modal('show');
            }
        });
    }
    $("#AceptarModal").on('click', function() {
        if ($("#AceptarModal").hasClass('clientesModal')) {

            var valuecliente = $("#tableClients tr.selected").find('td:nth-child(2)').html();
            var valueid = $("#tableClients tr.selected").find('td:first').html();

            $('#client_id').val(valueid);
            $('#cliente').val(valuecliente);
            $('#modalBase').modal('toggle');

        }
    });
</script>
@endsection