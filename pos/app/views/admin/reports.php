<link href="<?php echo $assets_uri; ?>css/facturacion.css" rel="stylesheet" />
<div class="title">Consulta de Ventas</div>

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
            <button type="button" class="btn btn-danger" onclick="Limpiar()" id="btnlimpiar" disabled>Limpiar</button>   
          </div>
          

        </div>
        <div class="form-horizontal">
          
          <div class="form-group">
          
            <div class="butoption">
                <button type="button" class="btn btn-success" onclick="VentaCierre()" id="btnverfac" >Ver Factura Cierre</button>
            </div>
            
          </div>

        </div>

    </div>


    <div class="clear"></div>
    <div class="table-responsive">
         
        <table class="table table-bordered table-condensed table-hover">
            <thead class="table-head">
                <tr>
                    <th class="column-100">Ticket</th>
                    <th class="column-100">Carnet</th>
                    <th>Nombre</th>
                    <th class="column-100">TipoPago</th>
                    <th class="column-200">Fecha</th>
                    <th class="column-100">Monto</th>
                </tr>
            </thead>
            <tbody id="wrapper_recibos">
            
            </tbody>
        </table>   
    </div>
</div>

<script>
        
    $("#txtEmpleado").keyup(function(event){
        if(event.keyCode == 13){
            
            if ($('#txtEmpleado').val() != '') {
                BuscarEmpleado();
            }
            
        }
    });

    function Limpiar(){

        $('#txtEmpleado').removeAttr('disabled');
        $('#txtNombre').val('');
        $('#txtEmpleado').val('');
        $('#txtEmpleado').focus();
        $('#btnverfac').removeAttr('disabled');
        $('#btnlimpiar').attr('disabled','');
        $('#wrapper_recibos').html('');

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
                $('#btnlimpiar').removeAttr('disabled');
                $('#btnverfac').attr('disabled','');
                

                var _url2 = "<?php echo base_url().'admin/ventaempleado/'; ?>";
                $.ajax({
                        url: _url2,
                        type: 'post',
                        dataType: 'json',
                        data: {idempleado: idempleado_}
                }).done(function(data){



                $('#wrapper_recibos').html('');
                $(data).each(function(){
                    var cod_ = "'"+this.codigo+"'";


                     var tipopago_ = '';

                    if(this.tipopago != 1){
                        tipopago_ =  'CREDITO';
                    }else{
                        tipopago_ = 'CONTADO';
                    }

                    $('#wrapper_recibos').append( '   <tr>'+
                                                '        <td class="column-100">'+this.documento+'</td>'+
                                                '        <td class="column-100">'+this.carnet+'</td>'+
                                                '        <td>'+this.nombre+'</td>'+
                                                '        <td class="column-100">'+tipopago_+'</td>'+
                                                '        <td class="column-200">'+this.fecha+'</td>'+
                                                '        <td class="column-100">$'+this.monto+'</td>'+
                                                '   </tr>');
                });   



                }).fail(function(){

                    alert('Error');
                });

            }else{
                $('#txtEmpleado').val('');
                alert('Empleado No Existe');
            }




        }).fail(function(){

            alert('Error');
        });

    }  

    function VentaCierre(){

       var cierre = '<?php echo $this->session->userdata('cierre'); ?>';

        if (cierre != "") {
            var _url2 = "<?php echo base_url().'admin/ventacierre/'; ?>";
                $.ajax({
                        url: _url2,
                        type: 'post',
                        dataType: 'json'
                }).done(function(data){


                $('#txtEmpleado').attr('disabled','');
                $('#btnlimpiar').removeAttr('disabled','');

                $('#wrapper_recibos').html('');
                $(data).each(function(){
                    var cod_ = "'"+this.codigo+"'";
                    var tipopago_ = '';

                    if(this.tipopago != 1){
                        tipopago_ =  'CREDITO';
                    }else{
                        tipopago_ = 'CONTADO';
                    }


                    $('#wrapper_recibos').append( '   <tr>'+
                                                '        <td class="column-100">'+this.documento+'</td>'+
                                                '        <td class="column-100">'+this.carnet+'</td>'+
                                                '        <td>'+this.nombre+'</td>'+
                                                '        <td class="column-100">'+ tipopago_+'</td>'+
                                                '        <td class="column-200">'+this.fecha+'</td>'+
                                                '        <td class="column-100">$'+this.monto+'</td>'+
                                                '   </tr>');
                });   



                }).fail(function(){

                    alert('Error');
                });

        }else{
            alert('Para utilizar esta opcion es necesario abrir la caja');
        }

         

    }  


</script>

