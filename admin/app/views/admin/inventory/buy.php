<script>
function retrieveProducts(event)
{
    var _q = $('#producto').val();
    if (_q != '') {
        var _url = base_url + 'ajax/buy_get_products/';
        $.ajax({url:_url, data:{q:_q}, type:'post', dataType: 'json'}).done(function (data) {
            $('#sugestions').show();
            $('#sugestions').html("");
            $('#sugestions').html('<ul class="sugestion-list">');
            $(data).each(function () {
                var value = this.codigo;
                var display = this.nombre;
                $('#sugestions').append('<li class="sugestion" data-value="' + value + '" data-display="' + display + '" onclick="selectProduct(this)">' + display + '</li>');
            });
            $('#sugestions').append('<ul class="sugestion-list">');
        }).fail(function () { clearProduct(); });
    }
    else
    {
        clearProduct();
    }
}

function clearProduct()
{
    $('#product_code').val('');
    $('#sugestions').hide();
    $('#sugestions').html("");
}

function selectProduct(client)
{
    $('#producto').val($(client).attr('data-display'));
    $('#product_code').val($(client).attr('data-value'));
    $('#sugestions').hide();
}

function _add()
{
    clearProduct();
    $('#producto').val('');
    $('#cantidad').val('');
    $('#save_product').modal('show');
}
</script>
<div class="title">
    <div class="row">
        <div class="col-lg-2">
            <a class="back-button" href="<?php echo base_url() . 'admin/buys/' . $compra_codigo; ?>">Volver</a>
        </div>
        <form class="form-inline col-lg-6 right" role="search">
            <div class="form-group col-lg-3">
                <select name="proveedor" class="form-control" id="proveedor" placeholder="Proveedor">
                    <?php foreach ($providers as $provider): ?>
                        <option value="<?php echo $provider->codigo; ?>"><?php echo $provider->nombre; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-lg-6">
                <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion de la compra">
            </div>
            <div class="form-group col-lg-3">
                <a href="#" onclick="_add()" class="btn btn-default">A&ntilde;adir</a>
            </div>
        </form>
    </div>
</div>

<div class="clear"></div>

<?php if($buy): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-condensed table-hover">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th style="text-align:center"></th>
                </tr>
            </thead>
            <tbody id="wrapper_products">
            <?php foreach ($buy as $product): ?>
                <tr>
                    <td><?php echo $product->producto; ?></td>
                    <td><?php echo $product->cantidad; ?></td>
                    <td align="center"><a href="#" onclick="_delete('<?php echo $product->codigo; ?>')" class="link-delete" title="Borrar"></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div style="height: 200px"></div>
    <center><span>No se encontraron registros</span></center>
<?php endif; ?>
<div class="toolbar align-right align-parent-bottom">
    <a href="<?php echo base_url() . 'procesator/delete_buy/' . $compra_codigo; ?>" role="button" class="btn btn-danger">Borrar</a>
    <button type="submit" class="btn btn-primary" onclick="_save()">Guardar</button>
    <input type="hidden" id="compra_code" name="compra_code" value="<?php echo $compra_codigo; ?>">
</div>

<script>
function _saveProduct()
{
    var _prd = $('#product_code').val();
    var _cnt = $('#cantidad').val();
    var _buy = $('#compra_code').val();

    if(_prd != '' && _cnt != '')
    {
        var _url = base_url + 'ajax/buy_save_product/';
        $.ajax({url:_url, data: {product: _prd, quantity: _cnt, buy: _buy}, dataType: 'json', type:'post'}).done(function(data){
            $('#save_product').modal('hide');
            //fillTable(data);
            document.location.reload(true);
        }).fail(function(){alert('Error #43546')});
    }
    else
    {
        alert('Rellene todos los campos');
    }
}

function _delete(codigo)
{
    var _buy = $('#compra_code').val();

    if(codigo != '')
    {
        var _url = base_url + 'ajax/buy_delete_product/';
        $.ajax({url:_url, data: {product: codigo, buy: _buy}, dataType: 'json', type:'post'}).always(function(data){
            //fillTable(data);
            document.location.reload(true);
        });
        
    }
    else
    {
        alert('Rellene todos los campos');
    }
}

function _save()
{
    var _buy = $('#compra_code').val();
    var _prov = $('#proveedor').val();
    var _desc = $('#descripcion').val();

    if(_buy != '' && _prov != '' && _desc != '')
    {
        var _url = base_url + 'ajax/buy_save_data/';
        $.ajax({url:_url, data: {buy: _buy, provider: _prov, descpt: _desc}, dataType: 'json', type:'post'});
        document.location = base_url + 'admin/buys';
    }
    else
    {
        alert('Rellene todos los campos');
    }
}

function fillTable(data)
{
    $('#wrapper_products').html('');
    $(data).each(function(){
        var item = '';
        item += '<tr>';
        item += '<td>' + this.producto + '</td><td>' + this.cantidad + '</td>';
        item += '<td style="text-align:center"><a href="#" onclick="_delete(\'' + this.codigo + '\')" class="link-delete" title="Borrar"></a></td>';
        item += '</tr>';

        $('#wrapper_products').append(item);
    });
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
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-condenced table-bordered">
                        <input name="codigo" id="sv_codigo" type="hidden">
                        <tr><th>Producto</th>
                        <td>
                            <input name="producto" id="producto" type="text" onkeyup="retrieveProducts()" class="form-control">
                            <div class="search-sugestion-modal" id="sugestions"></div>
                        </td></tr>
                        <tr><th>Cantidad</th><td><input name="cantidad" id="cantidad" type="number" step="any" class="form-control"></td></tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <input type="hidden" id="product_code" name="product_code">
                <button type="submit" onclick="_saveProduct()" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
    </div>
</div>