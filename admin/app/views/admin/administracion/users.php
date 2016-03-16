<div class="title">Administraci&oacute;n de Usuarios
    <button class="btn btn-default right" onclick="_add()">Añadir</button>
</div>
<div class="clear"></div>
<div class="table-responsive">
    <?php if($usuarios): ?>
    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="wrapper_recibos">
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td>
                    <a href="#" onclick="viewProduct('<?php echo $usuario->codigo; ?>')"><?php echo $usuario->codigo; ?></a>
                </td>
                <td><?php echo $usuario->nombre; ?></td>
                <td><?php echo $usuario->usuario; ?></td>
                <td><?php echo $usuario->estado; ?></td>
                <td align="center"><a href="#" onclick="_directEdit('<?php echo $usuario->codigo; ?>')" class="link-edit" title="Editar"></a></td>
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
            <span for="new" class="label">Usuarios</span>
            <a href="<?php echo base_url(); ?>admin/users">
                <div name="new" id="new" class="fab-mini">
                    <img src="<?php echo $assets_uri; ?>img/bt_compose2_1x.png" alt="Rec." />
                </div>
            </a>
        </div>

        <!--div class="fab-container">
            <span for="new" class="label">Cajas</span>
            <a href="<?php echo base_url(); ?>admin/cajas">
                <div name="new" id="new" class="fab-mini">
                    <img src="<?php echo $assets_uri; ?>img/bt_compose2_1x.png" alt="Rec." />
                </div>
            </a>
        </div-->

        <!--div class="fab-container">
            <span for="new" class="label">Sucursales</span>
            <a href="<?php echo base_url(); ?>admin/tiendas">
                <div name="new" id="new" class="fab-mini">
                    <img src="<?php echo $assets_uri; ?>img/bt_compose2_1x.png" alt="Rec." />
                </div>
            </a>
        </div-->

        <div class="fab-container">
            <span for="new" class="label">Cajeros</span>
            <a href="<?php echo base_url(); ?>admin/cajeros">
                <div name="new" id="new" class="fab-mini">
                    <img src="<?php echo $assets_uri; ?>img/bt_compose2_1x.png" alt="Rec." />
                </div>
            </a>
        </div>

        <!--div class="fab-container">
            <span for="new" class="label">Formas de Pago</span>
            <a href="<?php echo base_url(); ?>admin/tipo_pagos">
                <div name="new" id="new" class="fab-mini">
                    <img src="<?php echo $assets_uri; ?>img/bt_compose2_1x.png" alt="Rec." />
                </div>
            </a>
        </div-->

        <div class="fab-container">
            <span for="new" class="label">Proveedores</span>
            <a href="<?php echo base_url(); ?>admin/proveedores">
                <div name="new" id="new" class="fab-mini">
                    <img src="<?php echo $assets_uri; ?>img/bt_compose2_1x.png" alt="Rec." />
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
        var _url = base_url + 'ajax/get_usuario';
        $.ajax({url: _url, data : {codigo: _codigo}, type: 'post', dataType: 'json'}).done(function(data){

            _product_code = data.codigo;

            $('#vw_codigo').text(data.codigo);
            $('#vw_nombre').text(data.nombre);
            $('#vw_usuario').text(data.usuario);
            $('#vw_tipo').text(data.tipo);
            $('#vw_estado').text(data.estado);

            $('#view_product').modal('show');
        }).fail(function(){
            alert('Error');
        });
    }

    function _edit()
    {
        var _url = base_url + 'ajax/edit_usuario';
        $.ajax({url: _url, data : {codigo: _product_code}, type: 'post', dataType: 'json'}).done(function(data){

            _product_code = data.codigo;

            var _action = base_url + 'procesator/updateusuario';
            $('#procesor').attr('action', _action);

            $('#sv_codigo').val(data.codigo);
            $('#sv_nombre').val(data.nombre);
            $('#sv_usuario').val(data.usuario);
            $('#sv_clave').val('********');
            $('#sv_tipo').val(data.tipo);
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

        var _action = base_url + 'procesator/saveusuario';
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
                <h4 class="modal-title">Datos del Usuario</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-condenced table-bordered">
                        <tr><th>Codigo</th><td><span id="vw_codigo"></span></td></tr>
                        <tr><th>Nombre</th><td><span id="vw_nombre"></span></td></tr>
                        <tr><th>Usuario</th><td><span id="vw_usuario"></span></td></tr>
                        <tr><th>Tipo</th><td><span id="vw_tipo"></span></td></tr>
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
                <h4 class="modal-title">Nuevo Usuario</h4>
            </div>
            <form id="procesor" action="<?php echo base_url(); ?>procesator/saveusuario" method="post">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-condenced table-bordered">
                            <input name="codigo" id="sv_codigo" type="hidden">
                            <tr><th>Nombre</th><td><input name="nombre" id="sv_nombre" type="text" class="form-control"></td></tr>
                            <tr><th>Usuario</th><td><input name="usuario" id="sv_usuario" type="text" class="form-control"></td></tr>
                            <tr><th>Clave</th><td><input name="clave" id="sv_clave" type="password" class="form-control"></td></tr>
                            <tr>
                                <th>Tipo</th>
                                <td>
                                    <select name="tipo" id="sv_tipo" class="form-control">
                                        <option value="CAJERO">CAJERO</option>
                                        <option value="ADMINISTRADOR">ADMINISTRADOR</option>
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