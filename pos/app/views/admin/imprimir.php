
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="es"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />



  
   
   <title>Tipico Doña Mimita</title>
   
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body >

<div  id="recibo">
<div id="encabezado"> ********* Cafeteria Estrada*********** 
<div id="fecha"> Fecha: <?php echo date("Y-m-d H:i:s"); ?></div>
<div id="texto"> 
<br>Ticket: <?php echo $ticket; ?>
<br>Cliente: <?php echo $cliente; ?>
<br>Tipo Pago: <?php echo $tipopago; ?>
<br>Su compra es: $<?php echo $pago; ?>
<br>Su credito disponible es: $<?php echo $credito; ?>
<br>*********Gracias por su compra***********


</div>




<div id="pie_plantilla"> </div>




</div>




<div id="botones" class="form-actions">

<!--<form action=# method="POST">



<input  class="btn btn-success"  type="submit"    name="btnImprimir" value="Imprimir" 
onclick="javascript:imprSelec('recibo');function imprSelec(recibo)
{var ficha=document.getElementById(recibo);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);
ventimp.document.close();ventimp.print();ventimp.close();};" />


  
</form>-->
</div>
            
            
</body>

<script type="text/javascript">


imprSelec('recibo');

function imprSelec(recibo) {

	var ficha=document.getElementById(recibo);
	var ventimp=window.open(' ','popimpr');

	ventimp.document.write(ficha.innerHTML);
	ventimp.document.close();
	ventimp.print();
	ventimp.close();
};	

document.location = '<?php echo base_url().'admin/facturacion/' ; ?>';

</script>

<!-- END BODY -->
</html>

