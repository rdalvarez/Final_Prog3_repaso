 <!DOCTYPE html>
 <html>
 <head>
 	<title>Login Ingreso</title>
 	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jquery -->
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<!-- Mis funciones JS -->
<script type="text/javascript" src="JS/funciones.js"></script>
<!-- Animaciones -->
<link rel="stylesheet" type="text/css" href="CSS/animate.css">

 </head>

<body>

<?php
if (isset($_COOKIE['user'])) {
	$u = json_decode($_COOKIE['user']);
	echo '<div class="alert alert-success animated fadeInLeft" role="alert"> <strong>Ultima Coneccón: </strong> Usuario: '.$u->_usuario.' Tipo: '.$u->_tipo.'. <input type="button" name="button" value="Sacar" class="btn btn-success btn-sm animated fadeInDown" onclick="SacarCookie()"> </div>';	
}
session_start();
if (isset($_SESSION['user'])) {
	$U = json_decode($_SESSION['user']);
	echo '<div class="alert alert-info animated fadeInLeft" role="alert"> <strong>Session: </strong> Usuario: '.$U->_usuario.' Tipo: '.$U->_tipo.'. <input type="button" name="button" value="Login Out" class="btn btn-danger btn-sm animated fadeInDown " onclick="LoginOut()"> </div>';


	include_once 'partes/Grilla.php';
}
else
{
	include_once 'partes/FrmLogin.php';
}
 ?>
<div id="divAbm"  style="border-style:none;float:left;width:30%"></div>
</body>
</html>