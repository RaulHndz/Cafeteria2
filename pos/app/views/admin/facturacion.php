<link href="<?php echo $assets_uri; ?>css/facturacion.css" rel="stylesheet" />
<div class="title">Facturaci&oacute;n</div>

<div class="container">
	<div class="fachead">

		<div class="form-horizontal">
		  
		  <div class="form-group">
		    <label for="txtEmpleado" class="col-lg-1 control-label negrita">Empleado:</label>
		    <div class="col-lg-2">
		      <input type="text" class="form-control" id="txtEmpleado" placeholder="Carnet" value="" >
		    </div>
		    <label for="txtNombre" class="col-lg-2 control-label negrita">Nombre:</label>
		    <div class="col-lg-5">
		      <input type="text" class="form-control" id="txtNombre" placeholder="Nombre" disabled>
		    </div>
		  </div>
		  

		</div>
		<div class="form-horizontal">
		  
		  <div class="form-group">
		    <label for="txtEstado" class="col-lg-1 control-label negrita">Estado:</label>
		    <div class="col-lg-2">
		      <input type="text" class="form-control" id="txtEstado" placeholder="Estado" disabled>
		    </div>
		    <label for="txtCredito" class="col-lg-2 control-label negrita">Credito: ($)</label>
		    <div class="col-lg-2"> 
		      <input type="text" class="form-control" id="txtCredito" placeholder="" disabled>
		    </div>
		    <div class="butoption">
		  		<button type="button" class="btn btn-danger" onclick="Limpiar()">Limpiar</button>
		  	</div>
		  	
		  </div>

		</div>

	</div>

	<hr>
	<div class="clear"></div>
	<div class="facbody">
		<div class="form-horizontal">
		  
		  <div class="form-group">
		    <label for="txtConsecutivo" class="col-lg-2 control-label negrita">Tipo de Pago:</label>
		    	   
		    <div class="col-lg-1">
		      	<input type="radio" name="rbtformapago" value="C" id="chkCredito"  disabled checked>Credito			
		    </div>
		    <div class="col-lg-1">
		      	<input type="radio" name="rbtformapago" value="E"  id="chkContado" disabled>Contado		
		    </div>
		    <div class="col-lg-1">
		      	<input type="checkbox" name="chkTicket"   id="chkTicket" checked="true" >Generar Ticket		
		    </div>
		    <strong>
			    <label for="txtTotal" class="col-lg-2 control-label negrita">Total a Pagar: ($)</label>
			    <div class="col-lg-2">
			      <input type="text" class="form-control" id="txtTotal" placeholder="" value="0.00" disabled>
			    </div>
		    </strong>
		    <div class="butoption">
		    	<button type="button" class="btn btn-success" id="btnPagar" disabled="" onclick="Pagar()">Pagar</button>
		  		<button type="button" class="btn btn-danger" id="btnBorrar" disabled="" onclick="Borrar()">Borrar</button>
		  	</div>
		  </div>

		</div>
	</div>
	<div class="facbodydet">
		<center>
			<div class="facbodydet_head">

					<div class="form-horizontal">				  
					  	<div class="form-group">
					    <label for="txtArticulo" class="col-lg-1 control-label">Articulo:</label>
					    <div class="col-lg-1">
					      <input type="text" class="form-control" id="txtArticulo" placeholder="Codigo" disabled>
					    </div>
						<div class="col-lg-3">
						  <input type="text" class="form-control" id="txtDescripcion" placeholder="Nombre Art" disabled>
						</div>
						<label for="txtPrecio" class="col-lg-2 control-label">Precio: ($)</label>
					    <div class="col-lg-1">
					      <input type="text" class="form-control" id="txtPrecio" placeholder="$" disabled>
					    </div>
					    <label for="txtCantidad" class="col-lg-1 control-label" >Cantidad:</label>
					    <div class="col-lg-1">
					      <input type="text" class="form-control" id="txtCantidad" placeholder="0" disabled onkeypress="return justNumbers(event);">
					    </div>
						<button type="button" class="btn btn-primary" id="btnAgregar" disabled><img src="<?php echo $assets_uri; ?>img/bt_speed_dial_1x.png" alt=""></button>
					    <button type="button" class="btn btn-default" id="btnBuscarart" onclick="Buscar()" disabled><img src="<?php echo $assets_uri; ?>img/ic_search_grey600_18dp.png" alt=""></button>
				  	</div>

			</div>
		</center>
		<div class="facbodydet_body">
			<table class="table table-bordered table-condensed table-hover" id="grdFactura">
		        <thead class="table-head" id="wrapper_master">
		            
		        </thead>
		        <tbody id="wrapper_recibos">
		       		            
		        </tbody>
		    </table>
		</div>
	</div>


</div>


<script>
	
	var codEmp = '';
	var precio = 0;
	var art = "";
	var existencia = 0;
	var descripcion = '';
	var contador = 0;
	var total = 0;



	$( document ).ready(function() {
		$('#divrecibo').hide();
    	$('#txtEmpleado').focus();
	});

	$("#txtEmpleado").keyup(function(event){
	    if(event.keyCode == 13){
	    	
	    	if ($('#txtEmpleado').val() != '') {
				BuscarEmpleado();
	    	}
	        
    	}
	});

	$("#txtArticulo").keyup(function(event){
	    if(event.keyCode == 13){

	    	if ($('#txtArticulo').val() != '') {
				BuscarArt();
	    	}
	        
	    }
	});

	$("#txtCantidad").keyup(function(event){
	    if(event.keyCode == 13){

	    	if ($('#txtCantidad').val() != '') {
				AgregarDetalle();
	    	}
	        
	        
	    }
	});

	$("#txtCantidad").keyup(function(event){
	    if(event.keyCode == 27){

	    $('#txtCantidad').val('');
	    $('#txtArticulo').val('');
		$('#txtDescripcion').val('');
		$('#txtPrecio').val('');
		$('#txtArticulo').focus();
	    $('#btnAgregar').attr('disabled','true');;
	        
	    }
	});

	$("#txtBuscarArt").keyup(function(event){

	    if(event.keyCode == 13){
			
			alert('');    	
	        	        
	    }
	});


    function justNumbers(e)
    {
	    var keynum = window.event ? window.event.keyCode : e.which;
	    if ((keynum == 8) || (keynum == 46))
	    return true;
	     
	    return /\d/.test(String.fromCharCode(keynum));
    }


	function ImprimirTicket(ticket_,tipopago_){

		if ($('#chkTicket').is(':checked')){
			
			var cliente_nombre = $('#txtEmpleado').val()+ ' ' + $('#txtNombre').val();
			var pago_ = total;
			var credito_ = $('#txtCredito').val();
			var credito_dist = $('#txtCredito').val();

			if (tipopago_ == "CREDITO") {
				credito_dist = credito_ - pago_; 
				credito_dist = Math.round(credito_dist * 100)/100;

			}	

			$.ajax({

			}).done(function (){


				$('#ticket_recibo').html(ticket_);
				$('#cliente_recibo').html(cliente_nombre);
				$('#tipopago_recibo').html(tipopago_);
				$('#total_recibo').html(pago_);
				$('#credito_recibo').html(credito_dist);


			});

			

			imprSelec();

			Limpiar();

		}else{
			Limpiar();
		}	

		
	
	}

 	function Pagar_contado(){


    	var pago = $('#txtPPago').val();

    	var vuelto_ = ((pago-total)*100)/100;


    	if (pago != "") {

    		if (vuelto_ >= 0) {

    			$('#view_pago_contado').modal('hide');
    	
		    	contador = 0;

		    	var cod_cierre_ = ("<?php echo $this->session->userdata('cierre') ?>");
		    	var forma_pago_ = 1;
		    	var total_p_ = total;

		    	var url_ = "<?php echo base_url().'admin/masterfac_guardar/'; ?>";


		    	$.ajax({
		    		url: url_,
		    		type: 'post',
		    		dataType: 'json',
		    		data: {codigoemp:codEmp, cod_cierre:cod_cierre_, forma_pago: forma_pago_, total_p:total_p_}
		    	}).done(function(data){

		    		var codfact_ = (data.codigo);
		    		Pago_detalle(codfact_);
		    		ImprimirTicket(codfact_,'CONTADO');

		    	}).fail(function(){

		    		alert('Error');

		    	});


		    	var vuelto = ((pago-total)*100)/100
		   


		    	
		    	alert('Gracias Por Su Compra!!! \n\n Vuelto: $'+vuelto);

    		}else{
    			alert('Ingresar un pago mayor o igual al monto total a pagar');
    		}

    	}else{
    		$('#txtPPago').focus();
    	}
	
    }

    function Pagar_credito(){

    	$('#view_pago').modal('hide');



    	var cod_cierre_ = ("<?php echo $this->session->userdata('cierre') ?>");
    	var forma_pago_ = 2;
    	var total_p_ = total;

    	var url_ = "<?php echo base_url().'admin/masterfac_guardar/'; ?>";


    	$.ajax({
    		url: url_,
    		type: 'post',
    		dataType: 'json',
    		data: {codigoemp:codEmp, cod_cierre:cod_cierre_, forma_pago: forma_pago_, total_p:total_p_}
    	}).done(function(data){

    		var codfact_ = (data.codigo);
			Pago_detalle(codfact_);
			ImprimirTicket(codfact_,'CREDITO');

    	}).fail(function(){

    		alert('Error');

    	});



    	
    }


    function Pago_detalle(codf){

    	
			$("#grdFactura tbody tr").each(function (index) 
	        {
	            var codart_, preciot_, canidadt_;
	            $(this).children("td").each(function (index2) 
	            {
	                switch (index2) 
	                {
	                    case 0: codart_ = $(this).text();
	                            break;
	                    case 3: preciot_ = $(this).text();
	                            break;
	                    case 2: canidadt_ = $(this).text();
	                            break;
	                }
	            })

	            var pre = preciot_.replace("$", "");
	            var url_2 = "<?php echo base_url().'admin/detfac_guardar/'; ?>";
		    	$.ajax({
		    		url: url_2,
		    		type: 'post',
		    		dataType: 'json',
		    		data: {codfact:codf, codart: codart_, preciof: pre ,cantidadf:canidadt_ }
		    	}).done(function(data){
	    			    		
		    	}).fail(function(){

		    		alert('Error');

		    	});
	        })

    }

	function Pagar(){

	
		if (total == 0) {

			alert('Ingresar Datos');

		}else{

			$('#txtPPago').val('');
			var clie = $('#txtEmpleado').val() + ' - ' + $('#txtNombre').val();
			$('#txtPEmpleado').val(clie);

			if ($('input:radio[name=rbtformapago]:checked').val() == 'C') {

				
				var cred = $('#txtCredito').val();
				
				if (Math.round((cred- total)*100)/100 >= 0) {

					
					var credr = Math.round((cred- total)*100)/100;


					
					$('#txtPDisponible').val('$'+cred);
					$('#txtRestante').val('$'+credr);
					$('#txtPTotal2').val('$'+total);


					$('#view_pago_contado').modal('hide');
					$('#view_pago').modal('show');
					$('#btn_PagarCredito').focus();

				}else{
					alert('No dispone de suficiente saldo');
				}
			}else{
					
					$('#txtPTotal').val('$'+total);
					$('#view_pago_contado').modal('show');
					$('#txtPPago').focus();
					$('#txtPPago').attr('min',total);
			}


			

		}

	}

	function Borrar(){
		$('#txtPrecio').val('');	
		$('#txtArticulo').val('');	
		$('#txtDescripcion').val('');	
		$('#txtCantidad').val('');	
		$('#wrapper_recibos').html('');	
		$('#txtTotal').val('0.00');
		$('#txtArticulo').focus();
		$('#wrapper_master').html('');
		contador= 0;
		total = 0;
	}

	function Buscar() {
		
		LlenarDetArt();
		$('#view_product').modal('show');

	}

	function Limpiar(){

		$('#txtEmpleado').removeAttr('disabled');
		$('#txtEmpleado').val('');
		$('#txtNombre').val('');
		$('#txtEstado').val('');
		$('#txtCredito').val('$');

		$('#chkCredito').attr('disabled','true');
		$('#chkContado').attr('disabled','true');

		$('#btnPagar').attr('disabled','true');
		$('#btnBorrar').attr('disabled','true');

		$('#txtArticulo').attr('disabled','true');		
		$('#txtCantidad').attr('disabled','true');
		$('#btnAgregar').attr('disabled','true');
		$('#btnBuscarart').attr('disabled','true');

		$('#txtEmpleado').focus();

 		$('#txtTotal').val('0.00');
		$('#txtArticulo').val('');	
		$('#txtDescripcion').val('');	
		$('#txtCantidad').val('');	
		$('#wrapper_master').html('');
		$('#wrapper_recibos').html('');	
		$('#txtPrecio').val('');
		contador = 0;
		total = 0;	
	}

	function BuscarEmpleado(){

		var idempleado_ = $('#txtEmpleado').val();
		var _url = "<?php echo base_url().'admin/detalleempleado/'; ?>";
	    $.ajax({
	            url: _url,
	            type: 'post',
	            dataType: 'json',
	            data: {idempleado: idempleado_}
	    }).done(function(data){

	    	if (data) {
	    		codEmp = data.codigo;

	    		$('#txtEmpleado').attr('disabled','');
	    		$('#txtNombre').val(data.nombre);
		    	$('#txtEstado').val(data.estado);
		    	$('#txtCredito').val(data.credito);

		    	if (data.estado != 'ACTIVO') {

		    		alert('El empleado se encuentra inactivo');
		    	}else{

		    		$('#chkCredito').removeAttr('disabled');
					$('#chkContado').removeAttr('disabled');

					$('#btnPagar').removeAttr('disabled');
					$('#btnBorrar').removeAttr('disabled');

					$('#txtArticulo').removeAttr('disabled');
					
					$('#btnBuscarart').removeAttr('disabled');

					$('#txtArticulo').focus();

		    	}

	    	}else{
	    		$('#txtEmpleado').val('');
	    		alert('Empleado No Existe');
	    	}




	    }).fail(function(){

	    	alert('Error');
	    });

	}

	function BuscarArt(){

		
		var idarticulo_ = $('#txtArticulo').val();
		var _url = "<?php echo base_url().'admin/detarticulo/'; ?>";
	    $.ajax({
	            url: _url,
	            type: 'post',
	            dataType: 'json',
	            data: {idarticulo: idarticulo_}
	    }).done(function(data){


	    	if (data) {

	    		art = data.codigo;
	    		precio = data.precio1;
	    		descripcion = data.nombre;


	    		$('#txtDescripcion').val(data.nombre);
	    		$('#txtPrecio').val(data.precio1);	
	    		$('#txtCantidad').removeAttr('disabled');
				$('#btnAgregar').removeAttr('disabled');
				$('#txtCantidad').focus();

	    	}else{
	    		alert('Articulo No Existe');
	    		$('#txtArticulo').focus();
	    		$('#txtArticulo').val('');
	    		$('#txtDescripcion').val('');
	    		$('#txtCantidad').val('');
	    		$('#txtPrecio').val('');
	    	}
		
		}).fail(function(){

			alert(error);
		});
	}

	function LimpiarLinea (argument,monto) {
		
		$('#'+argument).remove();
		total = total - monto;
		total = Math.round(total * 100)/100;
		$('#txtTotal').val(total);
		$('#txtArticulo').focus();

	}

	function AgregarDetalle(){

		var cant = $('#txtCantidad').val();

		if (cant != '' && cant != 0) {

			
			if (contador == 0) {

				$('#wrapper_master').html('');
				$('#wrapper_master').append('	<th class="column-100">Articulo</th>'+
								            '    <th>Nombre</th>'+
								            '    <th class="column-100">Cantidad</th>'+
								            '    <th class="column-100">Precio</th>'+
								            '    <th class="column-100">SubTotal</th>'+
								            '    <th class="column-50"></th>');

			}

			var monto_ = Math.round((cant*precio)*100)/100;

			$('#wrapper_recibos').append('	<tr id="'+contador+'">'+
								        '        <td class="column-100">'+art+'</td>'+
								        '        <td>'+descripcion+'</td>'+
								        '        <td class="column-100">'+Math.round(cant)+'</td>'+
								        '        <td class="column-100">$'+precio+'</td>'+
								        '        <td class="column-100">$'+Math.round((cant*precio)*100)/100+'</td>'+
								        '        <td class="column-100"><a class="btn" onclick="LimpiarLinea('+contador+','+monto_+')" ><img src="<?php echo $assets_uri; ?>img/ic_delete_black_24dp.png" alt=""></a></td>'+
										'	</tr>');


			/*

			<tr>
		                <th class="column-100">Articulo</th>
		                <th>Nombre</th>
		                <th class="column-100">Cantidad</th>
		                <th class="column-100">Precio</th>
		                <th class="column-100">SubTotal</th>
		                <th class="column-50"></th>
		    </tr>

			<tr>
		                <td class="column-100">Articulo</td>
		                <td>Nombre</td>
		                <td class="column-100">20</td>
		                <td class="column-100">$0.00</td>
		                <td class="column-100">$0.00</td>
		                <td class="column-100"><a href="#"><img src="<?php echo $assets_uri; ?>img/ic_delete_black_24dp.png" alt=""></a></td>

		            </tr>	

			*/


			/*********************/

			total += Math.round((cant*precio)*100)/100;
			total = Math.round(total * 100)/100;

	
			$('#txtTotal').val(total);
			$('#txtArticulo').val('');
			$('#txtArticulo').focus();
			$('#txtPrecio').val('');
			$('#txtCantidad').val('');
			$('#txtDescripcion').val('');

			$('#txtCantidad').attr('disabled','true');
			$('#btnAgregar').attr('disabled','true');

			/*********************/
			contador++;

		}

	}

	function LlenarDetArt(){

		var search_articulo_ = $('#txtBuscarArt').val();
		var url_ = "<?php echo base_url().'admin/existfiltrolimit/' ?>";

			$.ajax({
				url: url_,
				type: 'post',
				dataType: 'json',
				data: {busqueda: search_articulo_}
			}).done(function(data){


			
			$('#wrapper_articulos').html('');
			$(data.articulos).each(function(){
				var cod_ = "'"+this.codigo+"'";
				$('#wrapper_articulos').append(	'	<tr>'+
									        '        <td class="column-100">'+this.codigo+'</td>'+
									        '        <td>'+this.nombre+'</td>'+
									        '        <td class="column-100">'+this.tipo+'</td>'+
									        '        <td class="column-50">'+this.cantidad+'</td>'+
									        '        <td class="column-50">$'+this.precio+'</td>'+
									        '        <td class="column-50"><a class="btn" onclick="SetArt('+cod_+')"><img src="<?php echo $assets_uri; ?>img/Buy-50.png" alt=""></a></td>'+
								            '	</tr>');
			});

			

			}).fail(function(){

				alert('Error');

		});

	}

	function SetArt(varart){

		
		$('#txtArticulo').val(varart);
		BuscarArt();
		$('#view_product').modal('hide');
		
	}

	function imprSelec(){

		var ficha=document.getElementById('divrecibo');
		var ventimp=window.open(' ','popimpr');

		ventimp.document.write(ficha.innerHTML);
		ventimp.document.close();
		ventimp.print();
		ventimp.close();
	}

</script>

<div  id="divrecibo">
	
	<div id="encabezado"> 
			********* Cafeteria Estrada*********** 
	</div>
	<div id="fecha"> Fecha: <?php echo date("Y-m-d H:i:s"); ?></div>
	<div id="texto"> 
		<br>Ticket: <span id="ticket_recibo"></span>
		<br>Cliente: <span id="cliente_recibo"></span>
		<br>Tipo Pago: <span id="tipopago_recibo"></span>
		<br>Su compra es: $<span id="total_recibo"></span>
		<br>Su credito disponible es: $<span id="credito_recibo"></span>
		<br>
		<br>	*********Gracias por su compra********
	</div>

</div>


<!--VerificarPago-->
<div id="view_pago_contado" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="vw_nombre">Confirmacion de Pago</h4>
            </div>
            <div class="modal-body">

				<div class="form-horizontal">
		  
					  <div class="form-group">
					    
					    <label class="col-lg-3 control-label negrita" for="txtPEmpleado">Empleado:</label>
						<div class="col-lg-7">
					      <input type="text" class="form-control" id="txtPEmpleado" value="Raul Eduardo Herandez" disabled>
					    </div>			
					    
					  </div>
					  <div class="form-group">
					    
					    <label class="col-lg-3 control-label negrita" for="txtPFormaPago">Forma de Pago:</label>
						<div class="col-lg-3">
					      <input type="text" class="form-control" id="txtPFormaPago" value="Contado" disabled>
					    </div>				
					    
					  </div>
					  <div class="form-group">
					    
					    <label class="col-lg-3 control-label negrita" for="txtPTotal">Total a Pagar:</label>
						<div class="col-lg-3">
					      <input type="text" class="form-control" id="txtPTotal" value="$0.00" disabled>
					    </div>				
					    
					  </div>

				</div>
				
            </div>
            <div class="modal-footer">
				<form>
	            	<label class="col-lg-3 control-label negrita">Pago:</label>
							<div class="col-lg-3">
						      <input type="text" class="form-control" id="txtPPago" placeholder="$0.00" onkeypress="return justNumbers(event);"  min="0" max="1000" required>
					</div>	
	            	<button type="button" class="btn btn-primary" id="btn_PagarCredito" onclick="Pagar_contado()">Pagar</button>                
	                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
	            </form>
            </div>
        </div>
    </div>
</div>

<!--VerificarPago-->
<div id="view_pago" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="vw_nombre">Confirmacion de Pago</h4>
            </div>
            <div class="modal-body">

				<div class="form-horizontal">
		  
					  <div class="form-group">
					    
					    <label class="col-lg-3 control-label negrita" for="txtPEmpleado">Empleado:</label>
						<div class="col-lg-7">
					      <input type="text" class="form-control" id="txtPEmpleado" value="Raul Eduardo Herandez" disabled>
					    </div>			
					    
					  </div>
					  <div class="form-group">
					    
					    <label class="col-lg-3 control-label negrita" for="txtPFormaPago">Forma de Pago:</label>
						<div class="col-lg-3">
					      <input type="text" class="form-control" id="txtPFormaPago" value="Credito" disabled>
					    </div>				
					    
					  </div>
					  <div class="form-group">
					    
					    <label class="col-lg-3 control-label negrita" for="txtPDisponible">Dispobible:</label>
						<div class="col-lg-3">
					      <input type="text" class="form-control" id="txtPDisponible" value="$0.00" disabled>
					    </div>			
					    
					  </div>
					  <div class="form-group">
					    
					    <label class="col-lg-3 control-label negrita" for="txtPTotal">Total a Pagar:</label>
						<div class="col-lg-3">
					      <input type="text" class="form-control" id="txtPTotal2" disabled>
					    </div>				
					    
					  </div>
					  <div class="form-group">
					    
					    <label class="col-lg-3 control-label negrita">Restante:</label>
						<div class="col-lg-3">
					      <input type="text" class="form-control" id="txtRestante" value="$0.00" disabled>
					    </div>				
					    
					  </div>

				</div>
				
            </div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-primary" id="btn_PagarCredito" onclick="Pagar_credito()">Pagar</button>                
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Visualizacion -->
<div id="view_product" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="vw_nombre">Articulos</h4>
            </div>
            <div class="modal-body">

				<div class="form-horizontal">				  
					  	<div class="form-group">
					    <label for="txtBuscarArt" class="col-lg-1 control-label">Buscar:</label>
					    <div class="col-lg-5">
					      <input type="text" class="form-control" id="txtBuscarArt" placeholder="">
					    </div>						
					    <button type="button" class="btn btn-default" onclick="LlenarDetArt()"><img src="<?php echo $assets_uri; ?>img/ic_search_grey600_18dp.png" alt=""></button>
				  	</div>

                <table class="table table-bordered table-condensed table-hover">
		        <thead class="table-head">
		            <tr>
		                <th class="column-100">Articulo</th>
		                <th>Nombre</th>
		                <th class="column-100">Tipo</th>
		                <th class="column-100">Exis.</th>
		                <th class="column-100">Precio</th>
		                <th class="column-50"></th>
		            </tr>
		        </thead>
		        <tbody id="wrapper_articulos">
		       		
		           	            
		        </tbody>
		    </table>
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>

