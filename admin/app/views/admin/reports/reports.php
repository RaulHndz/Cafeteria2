<div class="title">
    <div class="row">
        <div class="col-lg-6">
            Creditos: $<?php echo $total_credito; ?> | 
            Sin creditos: $<?php echo $total_no_credito; ?>
        </div>
        <form class="form-inline col-lg-5 right" action="<?php echo base_url() . 'admin/reports' ?>" method="post">
            <div class="form-group col-lg-4">
                <select name="month" class="form-control" id="month" placeholder="Mes">
                    <option <?php echo ($month == 1) ? 'selected' : '' ; ?> value="1">Enero</option>
                    <option <?php echo ($month == 2) ? 'selected' : '' ; ?> value="2">Febrero</option>
                    <option <?php echo ($month == 3) ? 'selected' : '' ; ?> value="3">Marzo</option>
                    <option <?php echo ($month == 4) ? 'selected' : '' ; ?> value="4">Abril</option>
                    <option <?php echo ($month == 5) ? 'selected' : '' ; ?> value="5">Mayo</option>
                    <option <?php echo ($month == 6) ? 'selected' : '' ; ?> value="6">Junio</option>
                    <option <?php echo ($month == 7) ? 'selected' : '' ; ?> value="7">Julio</option>
                    <option <?php echo ($month == 8) ? 'selected' : '' ; ?> value="8">Agosto</option>
                    <option <?php echo ($month == 9) ? 'selected' : '' ; ?> value="9">Septiembre</option>
                    <option <?php echo ($month == 10) ? 'selected' : '' ; ?> value="10">Octubre</option>
                    <option <?php echo ($month == 11) ? 'selected' : '' ; ?> value="11">Noviembre</option>
                    <option <?php echo ($month == 12) ? 'selected' : '' ; ?> value="12">Diciembre</option>
                </select>
            </div>
            <div class="form-group col-lg-3">
                <select name="year" class="form-control" id="year" placeholder="Año">
                    <option <?php echo ($year == '2015') ? 'selected' : '' ; ?> value="2015">2015</option>
                </select>
            </div>
            <div class="form-group col-lg-3">
                <button type="submit" class="btn btn-default">Ver</button>
            </div>
        </form>
    </div>
</div>

<?php if($cierres): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-condensed table-hover">
            <thead>
                <tr>
                    <th>Caja</th>
                    <th>Fecha Apertura</th>
                    <th>Fecha Cierre</th>
                    <th>Usuario</th>
                    <th>Monto</th>
                    <th style="text-align:center"></th>
                </tr>
            </thead>
            <tbody id="wrapper_products">
            <?php foreach ($cierres as $cierre): ?>
                <tr>
                    <td><?php echo $cierre->caja; ?></td>
                    <td><?php echo $cierre->fecha_apertura; ?></td>
                    <td><?php echo $cierre->fechas_cierre; ?></td>
                    <td><?php echo $cierre->usuario; ?></td>
                    <td><?php echo $cierre->monto; ?></td>
                    <td align="center"><a href="<?php echo base_url() . 'admin/facturas/' . $cierre->cierre; ?>" onclick="" title="Ver">Ver</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div style="height: 200px"></div>
    <center><span>No se encontraron registros</span></center>
<?php endif; ?>