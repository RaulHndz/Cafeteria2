<div class="title">
    Compras
    <a href="<?php echo base_url(); ?>admin/buy" class="btn btn-default right">Nueva</a>
</div>

<?php if($buys): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-condensed table-hover">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Proveedor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="wrapper_recibos">
            
            <?php foreach ($buys as $buy): ?>
                <tr>
                    <td><?php echo $buy->codigo; ?></td>
                    <td><?php echo $buy->descripcion; ?></td>
                    <td><?php echo $buy->proveedor; ?></td>
                    <td align="center" width="150px">
                        <a style="display: inline-block; margin-right: 10px" href="<?php echo base_url() . 'admin/buy/' . $buy->codigo; ?>" class="link-edit" title="Editar"></a>
                        <a style="display: inline-block; margin-left: 10px" href="<?php echo base_url() . 'procesator/process_buy/' . $buy->codigo; ?>" class="link-process" title="Procesar"></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div style="height: 200px"></div>
    <center><span>No se encontraron registros</span></center>
<?php endif; ?>    

<div class="fab-area">
    <div class="fab-mini-box">

        <div class="fab-container">
            <span for="new" class="label">Kardex</span>
            <a href="<?php echo base_url(); ?>admin/kardex">
                <div name="new" id="new" class="fab-mini">
                    <img src="<?php echo $assets_uri; ?>img/bt_compose2_1x.png" alt="Rec." />
                </div>
            </a>
        </div>

        <div class="fab-container">
            <span for="new" class="label">Compras</span>
            <a href="<?php echo base_url(); ?>admin/buys">
                <div name="new" id="new" class="fab-mini">
                    <img src="<?php echo $assets_uri; ?>img/bt_compose2_1x.png" alt="Rec." />
                </div>
            </a>
        </div>

        <div class="fab-container">
            <span for="new" class="label">Ajustes</span>
            <a href="<?php echo base_url(); ?>admin/adjust">
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
    function _add()
    {
        document.getElementById("procesor").reset();

        /*var _action = base_url + 'procesator/saveclient';
        $('#procesor').attr('action', _action);
        $('#sv_codigo').removeAttr('readonly');*/

        $('#save_product').modal('show');
    }
</script>

<!-- Modal de Añadir -->
<div id="save_product" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">A&ntilde;adir Producto</h4>
            </div>
            <form id="procesor" action="<?php echo base_url(); ?>procesator/saveclient" method="post">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-condenced table-bordered">
                            <input name="codigo" id="sv_codigo" type="hidden">
                            <tr><th>Producto</th><td><input name="producto" id="sv_nombre" type="text" class="form-control"></td></tr>
                            <tr><th>Cantidad</th><td><input name="cantidad" id="sv_telefono" type="number" step="any" class="form-control"></td></tr>
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