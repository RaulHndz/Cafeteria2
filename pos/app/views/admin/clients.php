<div class="title">Administraci&oacute;n de Clientes
    <button class="btn btn-default right" onclick="_add()">Añadir</button>
</div>
<div class="clear"></div>
<div class="table-responsive">
    <?php if($clients): ?>
    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Documento</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="wrapper_recibos">
        <?php foreach ($clients as $client): ?>
            <tr>
                <td>
                    <a href="#" onclick="viewProduct('<?php echo $client->codigo; ?>')"><?php echo $client->codigo; ?></a>
                </td>
                <td><?php echo $client->nombre; ?></td>
                <td><?php echo $client->telefono; ?></td>
                <td><?php echo $client->documento; ?></td>
                <td><?php echo $client->estado; ?></td>
                <td align="center"><a href="#" onclick="_directEdit('<?php echo $client->codigo; ?>')" class="link-edit" title="Editar"></a></td>
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
            <a href="<?php echo base_url(); ?>admin/creditlimit">
                <span for="new" class="label">Creditos</span>
                <div name="new" id="new" class="fab-mini">
                    <img src="<?php echo $assets_uri; ?>img/ic_folder_open_white_18dp.png" alt="Rec." />
                </div>
            </a>
        </div>
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
        var _url = base_url + 'ajax/get_client';
        $.ajax({url: _url, data : {codigo: _codigo}, type: 'post', dataType: 'json'}).done(function(data){

            _product_code = data.codigo;

            $('#vw_codigo').text(data.codigo);
            $('#vw_nombre').text(data.nombre);
            $('#vw_telefono').text(data.telefono);
            $('#vw_direccion').text(data.direccion);
            $('#vw_doctype').text(data.tipo_doc);
            $('#vw_doc').text(data.documento);
            $('#vw_etado').text(data.estado);

            $('#view_product').modal('show');
        }).fail(function(){
            alert('Error');
        });
    }

    function _edit()
    {
        var _url = base_url + 'ajax/edit_client';
        $.ajax({url: _url, data : {codigo: _product_code}, type: 'post', dataType: 'json'}).done(function(data){

            _product_code = data.codigo;

            var _action = base_url + 'procesator/updateclient';
            $('#procesor').attr('action', _action);

            $('#sv_codigo').val(data.codigo);
            $('#sv_nombre').val(data.nombre);
            $('#sv_telefono').val(data.telefono);
            $('#sv_direccion').val(data.direccion);
            $('#sv_doctype').val(data.tipo_documento_codigo);
            $('#sv_doc').val(data.documento);
            $('#sv_etado').val(data.estado);

            $('#view_product').modal('hide');
            $('#save_product').modal('show');
        }).fail(function(){
            alert('Error');
        });
    }

    function _add()
    {
        document.getElementById("procesor").reset();

        var _action = base_url + 'procesator/saveclient';
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
                <h4 class="modal-title" id="vw_nombre">Datos del Cliente</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-condenced table-bordered">
                        <tr><th>Codigo</th><td><span id="vw_codigo"></span></td></tr>
                        <tr><th>Nombre</th><td><span id="vw_nombre"></span></td></tr>
                        <tr><th>Telefono</th><td><span id="vw_telefono"></span></td></tr>
                        <tr><th>Direccion</th><td><span id="vw_direccion"></span></td></tr>
                        <tr><th>Tipo Documento</th><td><span id="vw_doctype"></span></td></tr>
                        <tr><th>Documento</th><td><span id="vw_doc"></span></td></tr>
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
                <h4 class="modal-title">Nuevo Cliente</h4>
            </div>
            <form id="procesor" action="<?php echo base_url(); ?>procesator/saveclient" method="post">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-condenced table-bordered">
                            <input name="codigo" id="sv_codigo" type="hidden">
                            <tr><th>Nombre</th><td><input name="nombre" id="sv_nombre" type="text" class="form-control"></td></tr>
                            <tr><th>Telefono</th><td><input name="telefono" id="sv_telefono" type="text" class="form-control"></td></tr>
                            <tr><th>Direccion</th><td><input name="direccion" id="sv_direccion" type="text" class="form-control"></td></tr>
                            <tr>
                                <th>Tipo Documento</th>
                                <td>
                                    <select name="doctype" id="sv_doctype" class="form-control">
                                        <?php foreach ($doctypes as $item): ?>
                                            <option value="<?php echo $item->codigo; ?>"><?php echo $item->nombre; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr><th>Documento</th><td><input name="documento" id="sv_doc" type="text" class="form-control"></td></tr>
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