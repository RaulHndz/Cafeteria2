<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no">

	<title>Cafeteria</title>
	<link rel="stylesheet" href="<?php echo $assets_uri; ?>css/reset.css">
	<link rel="stylesheet" href="<?php echo $assets_uri; ?>css/bootstrap_material.min.css">
	<link rel="stylesheet" href="<?php echo $assets_uri; ?>css/admin.css">

	<script src="<?php echo $assets_uri; ?>script/jquery-1.11.1.min.js"></script>
    <script src="<?php echo $assets_uri; ?>script/admin.js"></script>
	<script src="<?php echo $assets_uri; ?>script/bootstrap.min.js"></script>

	<script>var base_url = '<?php echo base_url(); ?>'; </script>
</head>
<body>

<header class="site-header">
	<span id="menu-button"></span>
</header>


<nav id="side-bar">
	<div id="side-bar-head">
	    <div class="user-photo"></div>
	    <span id="option-user-button" class="user-name"><?php echo $this->session->userdata('user_name2') ?><img src="<?php echo $assets_uri; ?>img/ic_bullet_list.png" alt=""></span>
	    
	    <ul id="user-option">
		  
		  <li>
		  	<a href="<?php echo base_url(); ?>user/logout">
		  		Cerrar Sesion
		  	</a>
		  </li>

		</ul>
		
	    <span class="site-title">Tipicos Doña Mimita</span>
	</div>

	<ul class="menu">
		<li class="menu-option">
			<a href="<?php echo base_url(); ?>admin/">
				<span class="icon" style="background: url(<?php echo $assets_uri; ?>img/ic_home.png);"></span>
				<span class="menu-label">Control de Caja</span>
			</a>
		</li>
		<li class="menu-option">
			<a href="<?php echo base_url(); ?>admin/facturacion">
				<span class="icon" style="background: url(<?php echo $assets_uri; ?>img/ic_users.png);"></span>
				<span class="menu-label">Facturacion</span>
			</a>
		</li>
		
		<li class="menu-option">
			<a href="<?php echo base_url(); ?>admin/existencias">
				<span class="icon" style="background: url(<?php echo $assets_uri; ?>img/ic_menus.png);"></span>
				<span class="menu-label">Consulta de Articulos</span>
			</a>
		</li>
		

		<li class="menu-option">
			<a href="<?php echo base_url(); ?>admin/reports">
				<span class="icon" style="background: url(<?php echo $assets_uri; ?>img/ic_widgets.png);"></span>
				<span class="menu-label">Consulta Empleado</span>
			</a>
		</li>	
	</ul>
	
	<footer>CASI-4 Inc. &copy; <?php echo @date('Y'); ?></footer>
</nav>

<div class="body-content">
	<div class="content" align="center">
		<?php $this->load->view($option); ?>
	</div>
</div>

</body>
</html>