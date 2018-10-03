@extends('layouts.app')
@section('topnavbar')
    Proforma Detalle #{{str_pad($proform->id,5,0,STR_PAD_LEFT)}}
@endsection
@section('body-class','nav-md')
@section('style')
    <style>
        @media print
        {
            @page {size: A4 portrait;  max-height:100%;  max-width:100%;}

            .no-print, .no-print *
            {
                display: none !important;
            }
        }

        .overlay {
            background-color:#EFEFEF;
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 1000;
            top: 0px;
            left: 0px;
            opacity: .5; /* in FireFox */
            filter: alpha(opacity=50); /* in IE */
        }
    </style>

@endsection
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left no-print">
                <h3>Proforma #{{str_pad($proform->id,5,0,STR_PAD_LEFT)}}</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Proforma para el proyecto: {{$proform->proyecto->title}}</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <section class="content invoice">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-xs-12 invoice-header">
                                    <h1>
                                        <i class="fa fa-globe"></i> Proforma - {{$proform->Type}}
                                        <small class="pull-right">Fecha de creación: {{$proform->fecha_creacion->toDateString()}}</small>
                                    </h1>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    @if($proform->types == 'C')
                                        De
                                        @else
                                        Para
                                    @endif
                                    <address>
                                        <strong>{{$proform->user->name}}</strong>
                                        <br>{{$proform->user->empresas->direccion_matriz}}
                                        <br>Teléfono: {{$proform->user->empresas->telefono}}
                                        <br>Email: {{$proform->user->email}}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    @if($proform->types == 'P')
                                        De
                                    @else
                                        Para
                                    @endif
                                    <address>
                                        <strong>{{$proform->client->name}} {{$proform->client->lastname}}</strong>
                                        <br>{{$proform->client->address}}
                                        <br>Teléfono: {{$proform->client->phone}}
                                        <br>Email: {{$proform->client->email}}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">

                                    <br>
                                    <b>Invoice #{{str_pad($proform->id,5,0,STR_PAD_LEFT)}}</b>
                                    <br>
                                    <b>Proyecto ID:</b> {{$proform->proyecto_id}}
                                    <br>
                                    <b>Fecha de vigencia:</b> {{$proform->fecha_creacion->addDays($proform->duration)->toDateString()}}

                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-xs-12 table">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th width="10%">Cantidad</th>
                                            <th width="30%">Producto</th>
                                            <th width="15%">Precio Unitario</th>
                                            <th width="15%">Subtotal</th>
                                            <th width="15%">Descuento</th>
                                            <th width="15%">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($proform->proformDetail as $detalle)
                                        <tr>
                                            <td>{{$detalle->quantity}}</td>
                                            <td>{{$detalle->product->name}} {{$detalle->product->detail}}</td>
                                            <td>{{$detalle->price}}</td>
                                            <td>${{$detalle->price * $detalle->quantity}}</td>
                                            <td>${{number_format(($detalle->descuento/100)*($detalle->price * $detalle->quantity),2)}}</td>
                                            <td>${{$detalle->total}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-xs-6">
                                    <p> <span class="lead"><strong>Forma de pago:</strong></span></p>
                                    <p class="lead">{{$proform->paidform}}</p>
                                    <p class="lead"><strong>Observaciones</strong></p>
                                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                        {{$proform->observations}}
                                    </p>
                                </div>
                                <!-- /.col -->
                                <div class="col-xs-6">
                                    <p class="lead">Monto al {{\Carbon\Carbon::today()->toDateString()}}</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th>Subtotal 12%:</th>
                                                <td>$ {{number_format($proform->subtotal12,2,'.',',')}}</td>
                                            </tr>
                                            <tr>
                                                <th>Subtotal 0%:</th>
                                                <td>$ {{number_format($proform->subtotal0,2,'.',',')}}</td>
                                            </tr>
                                            <tr>
                                                <th>Descuento:</th>
                                                <td>$ {{number_format($proform->descuento,2,'.',',')}}</td>
                                            </tr>
                                            <tr>
                                                <th>IVA (12%)</th>
                                                <td>$ {{number_format($proform->total_iva,2,'.',',')}}</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>$ {{number_format($proform->total,2,'.',',')}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-xs-12">
                                    <form method="post" id="frm_action" enctype="multipart/form-data" action="{{url('/proyectos/'.$proform->proyecto->id.'/proforms/'.$proform->id.'/sendSRI')}}">
                                        {{ csrf_field() }}
                                        <button type="button" class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                        <button class="btn btn-primary pull-right" onclick="submit_form('aprobar');"><i class="fa fa-thumbs-up"></i> Aprobar</button>
                                        @if($proform->types =='C')
                                            @switch($proform->status_sri)
                                                @case ('AUTORIZADO')
                                                @break
                                                @case ('NO ENVIADA')
                                                    <button class="btn btn-success pull-right" onclick="disableScreen();submit_form('send');"><i class="fa fa-send"></i> Facturar</button>
                                                @break
                                                @default
                                                    <button class="btn btn-success pull-right" onclick="disableScreen();submit_form('resend');"><i class="fa fa-send"></i> Obetner Estado</button>
                                            @endswitch

                                        @endif
                                        <button class="btn btn-danger pull-right" onclick="submit_form('cancel');"><i class="fa fa-ban"></i> Rechazar</button>
                                        <a class="btn btn-warning pull-left" href="{{url()->previous()}}"><i class="fa fa-arrow-left"></i> Volver</a>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    function submit_form(option) {
        switch(option){
            case 'aprobar':
                document.forms.frm_action.action='aprobar';
                document.forms.frm_action.submit();
                break;
            case 'send':
                document.forms.frm_action.action='sendSRI';
                document.forms.frm_action.submit();
                break;
            case 'resend':
                document.forms.frm_action.action='resendSRI';
                document.forms.frm_action.submit();
                break;
            case 'cancel':
                document.forms.frm_action.action='cancel';
                document.forms.frm_action.submit();
                break;
            default:
                document.forms.frm_action.action='send';
                document.forms.frm_action.submit();
                break;
        }
    }

    function disableScreen() {
        // creates <div class="overlay"></div> and
        // adds it to the DOM
        var div= document.createElement("div");
        div.className += "overlay";
        document.body.appendChild(div);
    }
</script>
@endsection