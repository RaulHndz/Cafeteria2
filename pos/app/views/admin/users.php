<div class="title">

    <div class="row">
        <div class="col-lg-2">
            Usuarios
        </div>
        <div class="col-lg-4 right">
            <div class="input-group">
                <input id="search-box" type="search" class="form-control" placeholder="Buscar">
                <span class="input-group-btn">
                    <a href="#" onclick="recSearch()" role="button" class="btn btn-default">
                        <img src="<?php echo $assets_uri; ?>img/ic_search_grey600_18dp.png" alt="Buscar" />
                    </a>
                </span>
            </div>
        </div>
    </div>

</div>
<div class="clear"></div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th><img src="<?php echo $assets_uri; ?>img/ic_delete_black_24dp.png" alt="Incativar" /></th>
            </tr>
        </thead>
        <tbody id="wrapper_recibos">
            <tr>
                <td>
                    <a href="#" data-toggle="modal" data-target="#vercliente">juanp</a>
                </td>
                <td>Juan Alexander Perez</td>
                <td>27-17-2014</td>
                <td><a href="#" class="link-delete" title="Desactivar"></a></td>
            </tr>
            <tr>
                <td>
                    <a href="#" data-toggle="modal" data-target="#vercliente">juanp1</a>
                </td>
                <td>Juan Alexander Perez</td>
                <td>27-17-2014</td>
                <td><a href="#" class="link-delete" title="Desactivar"></a></td>
            </tr>
            <tr>
                <td>
                    <a href="#" data-toggle="modal" data-target="#vercliente">juanp2</a>
                </td>
                <td>Juan Alexander Perez</td>
                <td>27-17-2014</td>
                <td><a href="#" class="link-delete" title="Desactivar"></a></td>
            </tr>
            <tr>
                <td>
                    <a href="#" data-toggle="modal" data-target="#vercliente">juanp3</a>
                </td>
                <td>Juan Alexander Perez</td>
                <td>27-17-2014</td>
                <td><a href="#" class="link-delete" title="Desactivar"></a></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="fab-area">
    <div class="fab-mini-box">
        <div class="fab-container">
            <span for="new" class="label">Nuevo Usuario</span>
            <a href="<?php echo base_url(); ?>admin/new_page">
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

<!-- Modal de Visualizacion -->
<div id="vercliente" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    Detalles del empleado
                </h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                            <tr>
                                <th>Usuario</th>
                                <td>juanp</td>
                            </tr>
                            <tr>
                                <th>Nombre</th>
                                <td>Juan Alexander Perez</td>
                            </tr>
                            <tr>
                                <th>Tipo</th>
                                <td>Administrador</td>
                            </tr>
                            <tr>
                                <th>Fecha de creaci&oacute;n</th>
                                <td>27-04-2014</td>
                            </tr>
                            <tr>
                                <th>Contrase&ntilde;a</th>
                                <td>********</td>
                            </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <a rol="button" href="#" class="btn btn-default" >Editar</a>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="EnviarAnulacion()">Aceptar</button>
            </div>
        </div>
    </div>
</div>