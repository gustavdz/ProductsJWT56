@extends('layouts.app')
@section('topnavbar','Proforma Detalle')
@section('body-class','nav-md  footer_fixed')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
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
                                            <th style="width: 15%">Cantidad</th>
                                            <th style="width: 55%">Producto</th>
                                            <th style="width: 15%">Precio Unitario</th>
                                            <th style="width: 15%">Subtotal</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($proform->proformDetail as $detalle)
                                        <tr>
                                            <td>{{$detalle->quantity}}</td>
                                            <td>{{$detalle->product->name}}</td>
                                            <td>{{$detalle->price}}</td>
                                            <td>${{$detalle->price * $detalle->quantity}}</td>
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
                                    <p class="lead">Forma de pago:</p>
                                    {{$proform->paidform}}
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
                                                <th>Subtotal:</th>
                                                <td>$ {{number_format($proform->total,2,'.',',')}}</td>
                                            </tr>
                                            <tr>
                                                <th>IVA (12%)</th>
                                                <td>$ {{number_format($proform->total_iva,2,'.',',')}}</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>$ {{number_format($proform->total_iva + $proform->total,2,'.',',')}}</td>
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
                                    <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                    <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                                    <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
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

@endsection