@extends('layouts.app')
@section('topnavbar','Proforma Nueva')
@section('body-class','nav-md  footer_fixed')

@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-left top_search">
                <div class="input-group">
                    <h3>Proforma</h3>
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
                    <h2>Crear Nueva Proforma</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12 ">
                            <form class="" method="post" role="form" action="{{url('/proyectos/'.$proyecto->id.'/proforms/store')}}">
                                {{ csrf_field() }}
                                <input id="client_id" type="hidden"  class="form-control" name="client_id" value="{{ old('client_id') }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                            <label for="types">Tipo de Proforma *</label>
                                            <select name="types" id="types" class="form-control">
                                                <option value="C">Cliente</option>
                                                <option value="P">Proveedor</option>
                                            </select>
                                            @if ($errors->has('types'))<span class="help-block"><strong>{{ $errors->first('types') }}</strong></span>@endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('cliente') ? ' has-error' : '' }}">
                                            <label for="cliente">Cliente *</label>
                                            <div class="input-group">
                                                <input id="cliente" type="text" class="form-control" name="cliente" value="{{ old('cliente') }}" readonly>
                                                <span class="input-group-btn {{ $errors->has('cliente') ? ' has-error' : '' }}">
                                                    <button class="btn btn-primary"  onclick="busquedaClientes()" type="button">Buscar</button>
                                                </span>
                                            </div>
                                            @if ($errors->has('cliente'))<span class="help-block"><strong>{{ $errors->first('cliente') }}</strong></span>@endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('duration') ? ' has-error' : '' }}">
                                            <label for="duration">Duración *</label>

                                            <input id="duration" type="number" class="form-control" name="duration" value="{{ old('duration') }}">

                                            @if ($errors->has('duration'))<span class="help-block"><strong>{{ $errors->first('duration') }}</strong></span>@endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                            <label for="company">Empresa *</label>
                                            <input type="text" id="company" name="company" class="form-control"/>
                                            @if ($errors->has('company'))<span class="help-block"><strong>{{ $errors->first('company') }}</strong></span>@endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('DNI') ? ' has-error' : '' }}">
                                            <label for="DNI">DNI *</label>
                                            <input type="text" id="DNI" name="DNI" class="form-control"/>
                                            @if ($errors->has('DNI'))<span class="help-block"><strong>{{ $errors->first('DNI') }}</strong></span>@endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('paidform') ? ' has-error' : '' }}">
                                            <label for="paidform">Forma de pago *</label>

                                            <input id="paidform" type="text" class="form-control" name="paidform" value="{{ old('paidform') }}">

                                            @if ($errors->has('paidform'))<span class="help-block"><strong>{{ $errors->first('paidform') }}</strong></span>@endif
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
    function init_daterangepicker_rangedate() {

        if( typeof ($.fn.daterangepicker) === 'undefined'){ return; }
        console.log('init_daterangepicker_reservation');

        $('#rangedate').daterangepicker(null, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });

    }
    init_daterangepicker_rangedate();
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