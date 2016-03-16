<div class="title">
    <div class="row">
        <div class="col-lg-2">
            <button class="back-button" onclick="window.history.back()">Volver</button>
        </div>
    </div>
</div>

<?php if($facturas): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-condensed table-hover">
            <thead>
                <tr>
                    <th>Factura</th>
                    <th>Tipo Pago</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody id="wrapper_products">
            <?php foreach ($facturas as $factura): ?>
                <tr>
                    <td><?php echo $factura->documento; ?></td>
                    <td><?php echo $factura->pago; ?></td>
                    <td><?php echo $factura->cliente; ?></td>
                    <td><?php echo $factura->fecha; ?></td>
                    <td><?php echo $factura->monto; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div style="height: 200px"></div>
    <center><span>No se encontraron registros</span></center>
<?php endif; ?>