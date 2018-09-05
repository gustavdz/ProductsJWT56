@extends('layouts.app')
@section('topnavbar','Proforma Nueva')
@section('body-class','nav-md')
@section('style')
    <style>
        #scrollable-dropdown-menu .tt-dropdown-menu {
            max-height: 150px;
            overflow-y: auto;
        }
    </style>
    <!-- typeahead-->
    <link href="{{asset('css/jquery.typeahead.min.css')}}" rel="stylesheet">

@endsection
@section('modal')
    @include('includes.modal_product')
@endsection
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
                    <h2>Información del Documento</h2>
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
                                            <label for="types">Tipo de Documento *</label>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Detalle de Productos o Servicios</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-responsive table-full-width table-striped table-condensed" id="products">
                                <thead>
                                <th width="10%">&nbsp;</th>
                                <th width="10%">Cantidad</th>
                                <th width="40%">Producto</th>
                                <th width="15%">Precio</th>
                                <th width="10%">IVA</th>
                                <th width="15%">Total</th>
                                </thead>
                                <tbody id="producto_tbody_detalle">
                                <tr id="producto_tr_1">
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="delete_row(1)"><i class="far fa-trash-alt"></i> </button>
                                    </td>
                                    <td><input type="number" id="producto_cant_1" name="producto_cant_1" class="form-control" value="1" onchange="calculate_total(1);" /> </td>
                                    <td>
                                        <div class="typeahead__container">
                                            <div class="typeahead__field">
                                                <div class="typeahead__query">
                                                    <input type="text" autocomplete="off" id="producto_name_1" name="producto_name_1" class="form-control js-typeahead" placeholder="Ingrese el nombre del producto" />
                                                    <input type="hidden" id="producto_id_1" name="producto_id_1" />
                                                </div>
                                                <div class="typeahead__button">
                                                    <button onclick="busquedaProductos(1)" type="button" class="btn btn-primary ">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="number" id="producto_price_1" name="producto_price_1" class="form-control" placeholder="0.00" min="0" pattern="^\d+(?:\.\d{1,2})?$" step=".25" onchange="setTwoNumberDecimal(this);calculate_total(1);" aria-label="Amount (to the nearest dollar)" readonly />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <select class="form-control" id="producto_iva_1" name="producto_iva_1">
                                                <option value="0">0%</option>
                                                <option value="12" selected>12%</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="number" id="producto_total_1" name="producto_total_1" class="form-control" placeholder="0.00" min="0" max="100" pattern="^\d+(?:\.\d{1,2})?$" step=".25" aria-label="Amount (to the nearest dollar)" readonly/>
                                        </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                            <button class="btn btn-sm btn-primary" type="button" onclick="agrega_detalle()"><i class="fa fa-plus"></i> Agregar detalle</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="observations">Observaciones</label>
                                <textarea id="observations" class="form-control" name="observations" rows="5" ></textarea>
                            </div>
                        </div>


                        <div class="col-md-offset-3 col-md-3">
                            <div class="form-group">
                                <label for="subtotal12">Subtotal 12%</label>
                                <input type="text" class="form-control" name="subtotal12" id="subtotal12" readonly />
                            </div>
                            <div class="form-group ">
                                <label for="subtotal0">Subtotal 0%</label>
                                <input type="text" class="form-control" name="subtotal0" id="subtotal0" readonly />
                            </div>
                            <div class="form-group ">
                                <label for="dscto">Descuento</label>
                                <input type="text" class="form-control" name="dscto" id="dscto" readonly />
                            </div>
                            <div class="form-group ">
                                <label for="iva">IVA</label>
                                <input type="text" class="form-control" name="iva" id="iva" readonly />
                            </div>
                            <div class="form-group ">
                                <label for="ice">ICE</label>
                                <input type="text" class="form-control" name="ice" id="ice" readonly />
                            </div>
                            <div class="form-group ">
                                <label for="total" class="control-label">Total</label>
                                <input type="text" class="form-control" name="total" id="total" readonly />
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ">
            <div class="pull-right">
                <a type="button" href="{{url()->previous()}}" class="btn btn-default  btn-fill " >Cancelar</a>
                <button type="submit" class="btn btn-primary  btn-fill " >Guardar</button>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        ini_typeahead("#producto_name_1");
    });

    function setTwoNumberDecimal(objeto) {
        objeto.value = parseFloat(objeto.value).toFixed(2);
    }

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

    function agrega_detalle(){

        $('#products > tbody:last-child')
            .append('<tr id="producto_tr_'+row_count+'">' +
                '<td class="text-center">\n' +
                '                                        <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="delete_row('+row_count+')"><i class="far fa-trash-alt"></i> </button>\n' +
                '                                    </td><td><input type="number" id="producto_cant_'+row_count+'" name="producto_cant_'+row_count+'" class="form-control" value="1" onchange="calculate_total('+row_count+');" /> </td><td>\n' +
                '                                        <div class="typeahead__container">\n' +
                '                                            <div class="typeahead__field">\n' +
                '                                                <div class="typeahead__query">\n' +
                '                                                    <input type="text" autocomplete="off" id="producto_name_'+row_count+'" name="producto_name_'+row_count+'" class="form-control js-typeahead" placeholder="Ingrese el nombre del producto" />\n' +
                '                                                    <input type="hidden" id="producto_id_'+row_count+'" name="producto_id_'+row_count+'" />\n' +
                '                                                </div>\n' +
                '                                                <div class="typeahead__button">\n' +
                '                                                    <button onclick="busquedaProductos('+row_count+')" type="button" class="btn btn-primary ">\n' +
                '                                                        <i class="fa fa-plus"></i>\n' +
                '                                                    </button>\n' +
                '                                                </div>\n' +
                '                                            </div>\n' +
                '                                        </div>\n' +
                '                                    </td><td>\n' +
                '                                        <div class="input-group">\n' +
                '                                            <span class="input-group-addon">$</span>\n' +
                '                                            <input type="number" id="producto_price_'+row_count+'" name="producto_price_'+row_count+'" class="form-control" placeholder="0.00" min="0" pattern="^\\d+(?:\\.\\d{1,2})?$" step=".25" onchange="setTwoNumberDecimal(this); calculate_total('+row_count+');" aria-label="Amount (to the nearest dollar)" readonly />\n' +
                '                                        </div>\n' +
                '                                    </td>\n' +
                '                                    <td>\n' +
                '                                        <div class="input-group">\n' +
                '                                            <select class="form-control" id="producto_iva_'+row_count+'" name="producto_iva_'+row_count+'">\n' +
                '                                                <option value="0">0%</option>\n' +
                '                                                <option value="12" selected>12%</option>\n' +
                '                                            </select>\n' +
                '                                        </div>\n' +
                '                                    </td>\n' +
                '                                    <td>\n' +
                '                                        <div class="input-group">\n' +
                '                                            <span class="input-group-addon">$</span>\n' +
                '                                            <input type="number" id="producto_total_'+row_count+'" name="producto_total_'+row_count+'" class="form-control" placeholder="0.00" min="0" max="100" pattern="^\\d+(?:\\.\\d{1,2})?$" step=".25" aria-label="Amount (to the nearest dollar)" readonly/>\n' +
                '                                        </div>\n' +
                '                                    </td></tr>');

        //var row_count= $('#products tbody tr').length + 1;
        var row_count = parseInt($('#producto_tbody_detalle').children().last().attr('id').replace("producto_tr_","")) + 1;
        ini_typeahead("#producto_name_"+row_count);
    }

    function busquedaProductos(row_id)
    {
        $("#nameproduct").val("");
        $("#detailproduct").val("");
        $("#priceproduct").val("");
        $('#modalProducto').modal('show');
        guardar_producto(row_id);
    }
    function guardar_producto(row_id){
        $("#GuardarModal").on('click', function() {
            $.ajax({
                url:'{{ url('/products/storejson') }}',
                type: 'POST',
                data: {"_token":"{{csrf_token()}}","name":$("#nameproduct").val(),"detail":$("#detailproduct").val(),"price":$("#priceproduct").val()},
                success: function(data){
                    $("#producto_name_"+row_id).val($("#nameproduct").val());
                    $("#producto_price_"+row_id).val($("#priceproduct").val());
                    $("#producto_price_"+row_id).prop('readonly', false);
                    $("#producto_name_"+row_id).prop('readonly', true);
                    $("#producto_id_"+row_id).val(data.id);
                    $('#modalProducto').modal('hide');
                }
            });
        });
    }


    function ini_typeahead(input){
        var str="";
        var inp ="";
        var inpid ="";
        var inpcant ="";
        var row_index ="";
        var inptotal = "";
        var inpdscto = "";
        $.typeahead({
            input: input,
            order: "asc",
            display: ["name","separator","detail"],
            source: {
                ajax: {
                    type: "GET",
                    url: "/products_json",
                }
            },
            callback: {
                onClickAfter: function (node, query, result,a,item,event) {
                    console.log( result.id );
                    str = this.node[0]['id'];
                    inp = str.replace('name','price');
                    inpid = inp.replace('price','id');
                    inpcant = inp.replace('price','cant');
                    inptotal = inp.replace('price','total');
                    inpdscto = inp.replace('price','dscto');
                    row_index = inp.replace('producto_price_','');
                    console.log( this.node[0]['id'] );
                    console.log( inp );
                    console.log( inpcant );
                    console.log( row_index );
                    $('#'+inp).val(result.price);
                    $('#'+inpid).val(result.id);
                    $('#'+inp).prop('readonly', false);
                    $('#'+str).prop('readonly', true);
                    $('#'+inptotal).val(result.price * $('#'+inpcant).val());
                    setTwoNumberDecimal(document.getElementById(inptotal));
                },
                onCancel: function(){
                    $('#'+inp).val("");
                    $('#'+inpid).val("");
                    $('#'+inptotal).val("");
                    $('#'+inpcant).val("1");
                    $('#'+inpdscto).val("");
                    $('#'+inp).prop('readonly', true);
                    $('#'+str).prop('readonly', false);
                }
            }
        });
    }
    function delete_row(id){
        $('#producto_tr_'+id).remove();
    }
    function calculate_total(id){
        var total_rows=0;
        $("#producto_total_"+id).val($("#producto_cant_"+id).val() * $("#producto_price_"+id).val());
        setTwoNumberDecimal(document.getElementById('producto_total_'+id));
        total_rows = count_rows('producto_tbody_detalle');

    }
    function count_rows(tbody){
        return $('#'+tbody).children().length;
    }
</script>
@endsection