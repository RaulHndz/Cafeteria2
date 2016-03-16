<link href="<?php echo $assets_uri; ?>css/configcaja.css" rel="stylesheet" />

<div class="title">Punto de Ventas</div>
<div class="cajacontainer"> 
    <center>
    <div class="cajabody" align="center">
        

        <div class="form-horizontal">
          
          <div class="form-group">
            <label for="txtCaja" class="col-lg-3 control-label">Caja:</label>
            <div class="col-lg-7">
              <input type="text" class="form-control" id="txtCaja" placeholder="" value="<?php echo $caja->caja; ?>" disabled>
            </div>
          </div>

          <div class="cajabodydet">
            
                <!--Estado-->
              <div class="form-group">
                <label for="txtEstado" class="col-lg-3 control-label">Estado:</label>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="txtEstado"  placeholder="" value="ABIERTA" disabled>
                </div>
              </div>
              <!--Usuario Apertura-->
              <div class="form-group">
                <label for="txtUsuario" class="col-lg-3 control-label">Usuario Apertura:</label>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="txtUsuario"  placeholder="" value="<?php echo $caja->usuario; ?>" disabled>
                </div>
              </div>
              <!--Fecha Apertura-->
              <div class="form-group">
                <label for="txtFecha" class="col-lg-3 control-label">Fecha Apertura:</label>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="txtFecha"  placeholder="" value="<?php echo $caja->fecha; ?>" disabled>
                </div>
              </div>
              <!--Monto Apertura-->
              <div class="form-group">
                <label for="txtMonto" class="col-lg-3 control-label">Monto:</label>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="txtMonto"  placeholder=""  value="$<?php echo $caja->monto; ?>" disabled>
                </div>
              </div>
              
              
              <div class="form-group" id="div_opciones">
                <center>
                    <button type="button" class="btn btn-info" id="btnEntrar" onclick="CerraCaja()" >Cerrar Caja</button>                
                </center>
              </div>        

          </div>

        </div>



    </div>
    </center>
</div>


<script>

function Salir(){

   $('#view_cerrar').modal('hide');
}

function justNumbers(e)
    {
      var keynum = window.event ? window.event.keyCode : e.which;
      if ((keynum == 8) || (keynum == 46))
      return true;
       
      return /\d/.test(String.fromCharCode(keynum));
    }

function CerraCaja(){

  var cierre_ = "<?php echo $this->session->userdata('cierre') ; ?>";
  var url_ ="<?php echo base_url().'admin/dcierrecaja/' ; ?>";

  $.ajax({
        url: url_,
        dataType: 'json',
        type: 'post',
        data: {cierre: cierre_}
  }).done(function(data){

    $('#txtVentaTotal').val(data.VAR_VENTATOTAL);
    $('#txtCreditos').val(data.VAR_VENTACREDITO);
    $('#txtEfectivo').val(data.VAR_VENTAEFECTIVO);
    $('#txtApertura').val(data.VAR_APERTURA);
    $('#txtTotal').val(data.VAR_TOTALEFECTIVO);
    $('#txtventa_').val(data.VAR_TOTALEFECTIVO);


  }).fail(function(){
    alert('Error');
  });


  $('#view_cerrar').modal('show');
}

    
</script>


<div id="view_cerrar" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="vw_nombre">Cerrar Caja</h4>
            </div>
            <div class="modal-body">

        <div class="form-horizontal">
      
             <div class="form-group">
              
              <label class="col-lg-3 control-label negrita" for="txtVentaTotal">Venta Total:</label>
              <div class="col-lg-7">
                <input type="text" class="form-control" id="txtVentaTotal" value="" disabled>
              </div>      
              
            </div>

            <div class="form-group">
              
              <label class="col-lg-3 control-label" for="txtCreditos">Venta Creditos:</label>
            <div class="col-lg-7">
                <input type="text" class="form-control" id="txtCreditos" value="" disabled>
              </div>      
              
            </div>
            <div class="form-group">
              
              <label class="col-lg-3 control-label" for="txtEfectivo">Venta Efectivo:</label>
            <div class="col-lg-3">
                <input type="text" class="form-control" id="txtEfectivo" value="" disabled>
              </div>        
              
            </div>
            <div class="form-group">
              
              <label class="col-lg-3 control-label" for="txtApertura">Apertura:</label>
              <div class="col-lg-3">
                <input type="text" class="form-control" id="txtApertura" value="" disabled>
              </div>      
              
            </div>
            <div class="form-group">
              
              <label class="col-lg-3 control-label negrita" for="txtTotal">Total Efectivo:</label>
              <div class="col-lg-3">
                <input type="text" class="form-control" id="txtTotal" value="" disabled>
              </div>      
              
            </div>

        </div>
        
            </div>
            <div class="modal-footer">

                <form action="<?php echo base_url()."admin/cerrarcaja_ok/"; ?>" method="post" autocomplete="off">      
                  <div class="form-group">
              
                  <label class="col-lg-3 control-label negrita" for="txtTotal">Monto Efectivo:</label>
                  <div class="col-lg-3">
                    <input type="text" class="form-control" id="txtPPago" name="txtPPago" placeholder="$0.00" onkeypress="return justNumbers(event);"   required>
                  </div>      
                  <button type="submit" class="btn btn-danger" id="btnEntrar" type="submit">Cerrar</button>
                  <button type="submit" class="btn btn-default" onclick="Salir()">Salir</button>
                 </div>

                   <input type="hidden" class="form-control" id="txtventa_" name="txtventa_">
                  
                </form>


                 
            </div>
        </div>
    </div>
</div>