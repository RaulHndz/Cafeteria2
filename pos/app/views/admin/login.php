<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>Administrador</title>

    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet" type="text/css" />

    <link href="<?php echo $assets_uri; ?>css/reset.css" rel="stylesheet" />
    <link href="<?php echo $assets_uri; ?>css/login.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href="<?php echo $assets_uri; ?>img/logo.png" />

    <script src="<?php echo $assets_uri; ?>script/jquery-1.11.1.min.js"></script>
</head>
<body>

    <div class="header">
    </div>
    
    <div class="wrapper">
        <div id="login-box">

		    <div class="avatar"></div>

		    <form action="<?php echo base_url(); ?>user/sigin" method="post" autocomplete="off">
		        <input class="input-first" type="text" name="user" placeholder="USUARIO" required>
		        <input class="input-last" type="password" name="pwrd" placeholder="CONTRASE&Ntilde;A" required>
		        <br />
                <button class="button-primary" type="submit">INICIAR SESION</button>
		    </form>

		</div>
    </div>
    <footer>
        CASI 4 &copy; 2015
    </footer>
</body>
</html>
