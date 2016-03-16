<link href="<?php echo $assets_uri; ?>css/configcaja.css" rel="stylesheet" />
<script src="<?php echo $assets_uri; ?>script/jquery-1.11.1.min.js"></script>

<div class="title">Control de Caja
</div>

<div class="cajacontainer">	
	<center>
	<div class="cajabody" align="center">
		
		

		<div class="form-horizontal">
		  
		  <div class="form-group">
		    <label for="txtCaja" class="col-lg-3 control-label">Caja:</label>
		    <div class="col-lg-7">
		      <input type="password" class="form-control" id="txtCaja" placeholder="Codigo de Caja" value="">
		    </div>
		  </div>

		  <div class="cajabodydet">
		  	
		  		<!--Estado-->
			  <div class="form-group">
			    <label for="txtEstado" class="col-lg-3 control-label">Estado:</label>
			    <div class="col-lg-7">
			      <input type="text" class="form-control" id="txtEstado"  placeholder="" disabled="true">
			    </div>
			  </div>
			  <!--Usuario Apertura-->
			  <div class="form-group">
			    <label for="txtUsuario" class="col-lg-3 control-label">Usuario Apertura:</label>
			    <div class="col-lg-7">
			      <input type="text" class="form-control" id="txtUsuario"  placeholder="" disabled="true">
			    </div>
			  </div>
			  <!--Fecha Apertura-->
			  <div class="form-group">
			    <label for="txtFecha" class="col-lg-3 control-label">Fecha Apertura:</label>
			    <div class="col-lg-7">
			      <input type="text" class="form-control" id="txtFecha"  placeholder=""  disabled="true">
			    </div>
			  </div>
			  <!--Monto Apertura-->
			  <div class="form-group">
			    <label for="txtMonto" class="col-lg-3 control-label">Monto:</label>
			    <div class="col-lg-7">
			      <input type="text" class="form-control" id="txtMonto"  placeholder=""  disabled="true">
			    </div>
			  </div>
			  
			  
			  <div class="form-group" id="div_opciones">

			   	
			  </div>		

		  </div>

		</div>



	</div>
	</center>
</div>


<script>

$("#txtCaja").keyup(function(event){
    if(event.keyCode == 13){
        CargarCaja();
    }
});


function Limpiar(){

	$('#txtCaja').val('');
	$('#txtCaja').removeAttr('disabled');
	$('#txtEstado').val('');
	$('#txtUsuario').val('');
	$('#txtFecha').val('');
	$('#txtMonto').val('');
	$('#txtMonto').attr('disabled','true');
	$('#div_opciones').html('');

}

function CargarCaja(){

	var codcaja = $('#txtCaja').val();

	 var _url = "<?php echo base_url().'admin/validarcaja/'; ?>";
    $.ajax({
            url: _url,
            type: 'post',
            dataType: 'json',
            data: {identificador: codcaja}
    }).done(function(data){

          
           if (data.codigo != null) {
           	
           		var idcaja_ = data.codigo;
           		var _url2 = "<?php echo base_url().'admin/datoscaja/'; ?>";
           		$.ajax({
				            url: _url2,
				            type: 'post',
				            dataType: 'json',
				            data: {idcaja: idcaja_}
				    }).done(function(dcaja){


				           if (dcaja.usuario != null) {

				           		$('#txtCaja').attr('disabled','true');
				           		$('#txtEstado').val('ABIERTA');
				           		$('#txtUsuario').val(dcaja.usuario);
				           		$('#txtFecha').val(dcaja.fecha);
				           		$('#txtMonto').val("$"+dcaja.monto);

				           		var usuario_ = "<?php echo $this->session->userdata('user_name2') ?>";


				           		if (usuario_ != dcaja.usuario) {


									$('#div_opciones').html('');
				           			$('#div_opciones').append('<center>'+
														      '<button type="submit" class="btn btn-primary" id="btnEntrar" title="Usuario no Coincide con el que aperturo la caja" disabled>Entrar</button>'+
														      '&nbsp;&nbsp;&nbsp;'+
														      '<button type="submit" class="btn btn-danger" onclick="Limpiar()">Limpiar</button>'+
														   	'</center>');

				           		}else{
				           			$('#div_opciones').html('');
				           			$('#div_opciones').append('<center>'+
				           									'<form action="<?php echo base_url()."admin/entrarcaja/"; ?>" method="post" autocomplete="off">		'+        
											                '	<input type="hidden" class="form-control" name="idcaja" placeholder="Codigo de Caja" value="'+idcaja_+'">'+
											                '	<button type="submit" class="btn btn-primary" id="btnEntrar" type="submit">Entrar</button>'+
											                '&nbsp;&nbsp;<button type="submit" class="btn btn-danger" onclick="Limpiar()">Limpiar</button>'+
													    	'</form>'+
														      
														      
														   	'</center>');
				           		}


				           }else{

				           		$('#txtApertura').focus();
				           		$('#txtCaja').attr('disabled','true');
					           	$('#txtEstado').val('DISPONIBLE');
					           	$('#txtUsuario').val('');
				           		$('#txtFecha').val('');
				           		$('#txtMonto').val('');
				           		$('#div_opciones').html('');

				           		$('#div_opciones').append('<center>'+
														 	'<form action="<?php echo base_url()."admin/aperturarcaja/"; ?>" method="post" autocomplete="off">		'+        
											                '	<input type="hidden" class="form-control" name="idcaja" placeholder="Codigo de Caja" value="'+idcaja_+'">'+
											                '<div class="form-group">              '+
											                '  	<label class="col-lg-3 control-label negrita" for="txtTotal">Monto Apertura:</label>'+
											                ' 	<div class="col-lg-3">'+
											                '    	<input type="number" class="form-control" id="txtApertura" name="txtApertura" placeholder="$0.00" onkeypress="return justNumbers(event);"  min="0" max="1000" required>'+
											                '  	</div>      '+
											                '  	<button type="submit" class="btn btn-primary" id="btnEntrar" type="submit">Aperturar</button>'+
											                '  	<button type="submit" class="btn btn-danger" onclick="Limpiar()">Limpiar</button>'+
											                '</div>'+

											                
														 '</center>');
				           		

				           }
				           

				            
				    }).fail(function(){


				        alert('Error');

				    });
           	
           }else{
           		$('#txtCaja').val('');
           		alert('Caja no existe');
           }
           

            
    }).fail(function(){


        alert('Error');

    });

}


function justNumbers(e)
    {
      var keynum = window.event ? window.event.keyCode : e.which;
      if ((keynum == 8) || (keynum == 46))
      return true;
       
      return /\d/.test(String.fromCharCode(keynum));
    }
	
</script>

