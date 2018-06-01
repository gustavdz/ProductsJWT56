@extends('layouts.app')
@section('topnavbar','Producto Nuevo')
@section('body-class','nav-md ')
@section('content')

    <div class="">


        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Agregar Nuevo Producto</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                            <span class="section">Información de Producto</span>
                        <form class="form-horizontal" method="post" role="form" action="{{url('/products/store')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Nombre <span class="required">*</span></label>
                                <div  class="col-md-6 col-sm-6 col-xs-12 ">
                                    <input id="name" data-validate-length-range="2" type="text" value="{{ old('name') }}" class="form-control col-md-7 col-xs-12" name="name"  required="required" >
                                    @if ($errors->has('name'))<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>@endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('detail') ? ' has-error' : '' }}">
                                <label for="detail" class="control-label col-md-3 col-sm-3 col-xs-12">Descripción <span class="required">*</span></label>
                                <div  class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea  id="detail" class="form-control" name="detail" required="required" >{{ old('detail') }}</textarea>
                                    @if ($errors->has('detail'))<span class="help-block"><strong>{{ $errors->first('detail') }}</strong></span>@endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="control-label col-md-3 col-sm-3 col-xs-12">Precio <span class="required">*</span></label>
                                <div  class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="price" type="number" class="form-control col-md-7 col-xs-12" value="{{ old('price') }}" name="price" min="0" step="any" required="required" >
                                    @if ($errors->has('price'))<span class="help-block"><strong>{{ $errors->first('price') }}</strong></span>@endif
                                </div>
                            </div>

                            <div class="item form-group {{ $errors->has('picture_filename') ? ' has-error' : '' }}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="picture_filename">Imagen </span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="picture_filename" class="form-control col-md-7 col-xs-12"  name="picture_filename" type="file">
                                    @if ($errors->has('picture_filename'))<span class="help-block"><strong>{{ $errors->first('profilepicture_filename') }}</strong></span>@endif
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                    <a href="{{ url('/products') }}" style="margin-right: 10px" type="button" class="btn btn-default">
                                        Cancelar
                                    </a>
                                </div>
                            </div>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
