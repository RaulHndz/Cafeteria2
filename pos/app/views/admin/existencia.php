<div class="title">Consulta de Existencia
</div>
<div class="search">
	<!--<div class="form-group">
		<label></label>
		<div class="dropdown">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdow">Clasificaciones
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><a href="#">HTML</a></li>
				<li><a href="#">CSS</a></li>
				<li><a href="#">Javascript</a></li>
			</ul>
		</div>
	</div>-->
	<div class="navbar-form navbar-left" role="search">
		<div class="form-group"  style="width:500px !important;">
			<input type="search" class="form-control" id="txtBuscar" placeholder="Ingresar Datos..." style="width:500px !important;" >
		</div>
		<button class="btn btn-default" type="button" onclick="Search()">Buscar</button>
	</div>

</div>
<div class="clear"></div>
<div class="table-responsive">
	 <?php if($articulos): ?>
    <table class="table table-bordered table-condensed table-hover">
        <thead class="table-head">
            <tr>
                <th class="column-100">Codigo</th>
                <th>Nombre</th>
                <th class="column-100">Cod Barra</th>
                <th class="column-100">Tipo</th>
                <th class="column-100">Estado</th>
                <th class="column-100">Existencia</th>
                <th class="column-100">Precio</th>
            </tr>
        </thead>
        <tbody id="wrapper_recibos">
        	 <?php foreach ($articulos as $articulo): ?>
       		<tr>
                <td class="column-100"><?php echo $articulo->codigo; ?></td>
                <td><?php echo $articulo->nombre; ?></td>
                <td class="column-100"><?php echo $articulo->barra; ?></td>
                <td class="column-100"><?php echo $articulo->tipo; ?></td>
                <td class="column-100"><?php echo $articulo->estado; ?></td>
                <td class="column-100"><?php echo $articulo->cantidad; ?></td>
                <td class="column-100"><span>$</span><?php echo $articulo->precio; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
     <?php else: ?>
        <p>No se encontraron registros</p>
    <?php endif; ?>
   
</div>


<script>

$("#txtBuscar").keyup(function(event){
    if(event.keyCode == 13){
        Search();
    }
});


function Search()
{
    var _busqueda = $('#txtBuscar').val();
    
    var _url = "<?php echo base_url().'admin/existfiltro/'; ?>";
    $.ajax({
            url: _url,
            type: 'post',
            dataType: 'json',
            data: {busqueda: _busqueda}
    }).done(function(data){

            $('#wrapper_recibos').html('');
            
            
            $(data.articulos).each(function(){

                
                $('#wrapper_recibos').append(   '<tr>  <td class="column-100">'+this.codigo+'</td>'+
                                                    '<td>'+this.nombre+'</td>'+
                                                    '<td class="column-100">'+this.barra+'</td>'+
                                                    '<td class="column-100">'+this.tipo+'</td>'+
                                                    '<td class="column-100">'+this.estado+'</td>'+
                                                    '<td class="column-100">'+this.cantidad+'</td>'+
                                                    '<td class="column-100">$'+this.precio+'</td>'+
                                                '</tr>');
                   

            });

            
    }).fail(function(){

        alert('Error');

    });
}
</script>