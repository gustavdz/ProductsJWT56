@component('mail::message')
# Nuevo Comprobante recibido

Estimado (a),

{{$info->receiver}}

Su comprobante, {{$info->factura}} ha sido generado con éxito y se encuentra disponible para su descarga y visualización.

También puede ingresar a <a href="{{config('app.url')}}">app.ecuabill.com</a> para consultar  todos sus documentos emitidos.


@component('mail::button', ['url' => config('app.url') ])
Ver todos mis comprobantes
@endcomponent

Saludos,<br>
## {{ config('app.name') }}
## Guayaquil - Ecuador
@endcomponent
