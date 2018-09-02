<div class="modal fade" id="modalProducto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLab">Nuevo Producto</h4>
            </div>
            <form class="form-horizontal" enctype="multipart/form-data" id="form_product_modal" name="form_product_modal" method="post" role="form" action="{{url('/products/store')}}">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Nombre <span class="required">*</span></label>
                            <div  class="col-md-6 col-sm-6 col-xs-12 ">
                                <input id="nameproduct" data-validate-length-range="2" type="text" class="form-control col-md-7 col-xs-12" name="nameproduct" required="required" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="detail" class="control-label col-md-3 col-sm-3 col-xs-12">Descripción <span class="required">*</span></label>
                            <div  class="col-md-6 col-sm-6 col-xs-12">
                                <textarea  id="detailproduct" class="form-control" name="detailproduct" required="required" autocomplete="off"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="price" class="control-label col-md-3 col-sm-3 col-xs-12">Precio <span class="required">*</span></label>
                            <div  class="col-md-6 col-sm-6 col-xs-12">
                                <input id="priceproduct" type="number" class="form-control col-md-7 col-xs-12" name="priceproduct" min="0" step="any" required="required" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" id="GuardarModal"  class="btn btn-primary">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>