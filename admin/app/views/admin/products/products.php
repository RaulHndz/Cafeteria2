<div class="title">Administraci&oacute;n Articulos
    <button class="btn btn-default right" onclick="_add()">Añadir</button>
</div>
<div class="clear"></div>
<div class="table-responsive">
    <?php if($products): ?>
    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Costo</th>
                <th>Categoria</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="wrapper_recibos">
        <?php foreach ($products as $product): ?>
            <tr>
                <td>
                    <a href="#" onclick="viewProduct('<?php echo $product->codigo; ?>')"><?php echo $product->codigo; ?></a>
                </td>
                <td><?php echo $product->nombre; ?></td>
                <td><?php echo $product->estado; ?></td>
                <td><?php echo $product->costo; ?></td>
                <td><?php echo $product->categoria; ?></td>
                <td align="center"><a href="#" onclick="_directEdit('<?php echo $product->codigo; ?>')" class="link-edit" title="Editar"></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>No se encontraron registros</p>
    <?php endif; ?>
</div>

<div class="fab-area">
    <div class="fab-mini-box">
        <div class="fab-container">
            <a href="<?php echo base_url(); ?>admin/categories">
                <span for="new" class="label">Categorias</span>
                <div name="new" id="new" class="fab-mini">
                    <img src="<?php echo $assets_uri; ?>img/ic_turned_in_white_18dp.png" alt="Rec." />
                </div>
            </a>
        </div>

        <!--div class="fab-container">
            <a href="<?php echo base_url(); ?>admin/cellars">
                <span for="new" class="label">Bodegas</span>
                <div name="new" id="new" class="fab-mini">
                    <img src="<?php echo $assets_uri; ?>img/ic_folder_open_white_18dp.png" alt="Rec." />
                </div>
            </a>
        </div-->
    </div>

    <div class="fab-normal" id="options">
        <img src="<?php echo $assets_uri; ?>img/bt_speed_dial_1x.png" alt="+" />
    </div>
</div>

<script>
    var _product_code = '';

    function _directEdit(_codigo)
    {
        _product_code = _codigo;
        _edit();
    }

    function viewProduct(_codigo)
    {
        var _url = base_url + 'ajax/get_product';
        $.ajax({url: _url, data : {codigo: _codigo}, type: 'post', dataType: 'json'}).done(function(data){

            _product_code = data.codigo;

            $('#vw_codigo').text(data.codigo);
            $('#vw_nombre').text(data.nombre);
            $('#vw_peso').text(data.peso);
            $('#vw_dimen').text(data.dimenciones);
            $('#vw_tipo').text(data.tipo);
            $('#vw_costo').text(data.costo);
            $('#vw_cate').text(data.categoria);
            $('#vw_fecha').text(data.fecha);
            $('#vw_estado').text(data.estado);

            $('#view_product').modal('show');
        }).fail(function(){
            alert('Error');
        });
    }

    function _edit()
    {
        var _url = base_url + 'ajax/edit_product';
        $.ajax({url: _url, data : {codigo: _product_code}, type: 'post', dataType: 'json'}).done(function(data){

            _product_code = data.codigo;

            var _action = base_url + 'procesator/updateproduct';
            $('#procesor').attr('action', _action);
            $('#sv_codigo').attr('readonly', 'true');

            $('#sv_codigo').val(data.codigo);
            $('#sv_nombre').val(data.nombre);
            $('#sv_peso').val(data.peso);
            $('#sv_dimen').val(data.dimenciones);
            $('#sv_tipo').val(data.tipo);
            $('#sv_costo').val(data.costo);
            $('#sv_cate').val(data.categoria_codigo);
            $('#sv_fecha').val(data.fecha);
            $('#sv_estado').val(data.estado);

            $('#view_product').modal('hide');
            $('#save_product').modal('show');
        }).fail(function(){
            alert('Error');
        });
    }

    function _add()
    {
        document.getElementById("procesor").reset();

        var _action = base_url + 'procesator/saveproduct';
        $('#procesor').attr('action', _action);
        $('#sv_codigo').removeAttr('readonly');

        $('#save_product').modal('show');
    }
</script>

<!-- Modal de Visualizacion -->
<div id="view_product" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="vw_nombre"></h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-condenced table-bordered">
                        <tr><th>Codigo</th><td><span id="vw_codigo"></span></td></tr>
                        <tr><th>Peso</th><td><span id="vw_peso"></span>oz.</td></tr>
                        <tr><th>Dimenciones</th><td><span id="vw_dimen"></span></td></tr>
                        <tr><th>Tipo</th><td><span id="vw_tipo"></span></td></tr>
                        <tr><th>Costo</th><td><span id="vw_costo"></span></td></tr>
                        <tr><th>Categoria</th><td><span id="vw_cate"></span></td></tr>
                        <tr><th>Fecha</th><td><span id="vw_fecha"></span></td></tr>
                        <tr><th>Estado</th><td><span id="vw_estado"></span></td></tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <a rol="button" href="#" class="btn btn-default" onclick="_edit()">Editar</a>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Añadir -->
<div id="save_product" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nuevo Producto</h4>
            </div>
            <form id="procesor" action="<?php echo base_url(); ?>procesator/saveproduct" method="post">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-condenced table-bordered">
                            <tr><th>Codigo</th><td><input name="codigo" id="sv_codigo" type="text" class="form-control"></td></tr>
                            <tr><th>Descripcion</th><td><input name="descripcion" id="sv_nombre" type="text" class="form-control"></td></tr>
                            <tr><th>Peso</th><td><input name="peso" id="sv_peso" type="text" class="form-control">oz.</td></tr>
                            <tr><th>Dimenciones</th><td><input name="dimen" id="sv_dimen" type="text" class="form-control"></td></tr>
                            <tr>
                                <th>Tipo</th>
                                <td>
                                    <select name="tipo" id="sv_tipo" class="form-control">
                                        <option value="Producto">Producto</option>
                                        <option value="Alimento">Alimento</option>
                                    </select>
                                </td>
                            </tr>
                            <tr><th>Costo</th><td><input name="costo" id="sv_costo" type="text" class="form-control"></td></tr>
                            <tr>
                                <th>Categoria</th>
                                <td>
                                    <select name="categoria" id="sv_cate" class="form-control">
                                        <?php foreach ($categories as $item): ?>
                                            <option value="<?php echo $item->codigo; ?>"><?php echo $item->nombre; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Estado</th>
                                <td>
                                    <select name="estado" id="sv_estado" class="form-control">
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>