<?php 
session_start();
$respuesta['exito'] = false;
$respuesta['mensaje'] = "";

switch ($_POST['queHago']) {
	case 'INGRESO':
			require_once 'clases/login.php';

			if (!isset($_POST['login']['usuario']) && !isset($_POST['login']['contraseña'])) {
				$respuesta['mensaje'] = "Se necesitan todos los campos.";
				echo json_encode($respuesta);
				return;
			}

			$usuario = $_POST['login']['usuario'];
			$contraseña = $_POST['login']['contraseña'];

			$listaDeUsuarios = Login::TraerTodosLosUsuarios();

			foreach ($listaDeUsuarios as $user) {
				if ($user->_usuario == $usuario && $user->_contraseña == $contraseña) {
					$respuesta['exito']=true;
					$respuesta['mensaje']="Ingresando a la pagina . . . ";
					$_SESSION['user'] = json_encode($user);
					setcookie("user",json_encode($user),time() + (60));			
					break;
				}
				else{
					$respuesta['mensaje'] = "E-mail o Contraseña incorrectos.";
				}
			}
			
			echo json_encode($respuesta);
		break;

	case "DESLOGUEAR":
		$_SESSION['user']=null;
		session_destroy();
		break;

	case "SACARCOOKIE":
		setcookie("user", "", time() - 3600);
		break;
	
	case "FORM_ALTA":
		require_once("partes/form.php");
		break;

	case "GRILLA":
		include_once("partes/Grilla.php");
		break;

	case "LOGIN":
		require_once("partes/FrmLogin.php");
		break;

	case "ALTA":
		require_once 'clases/materiales.php';
		
		//VALIDACION-------------------------------------------------//

		if (!isset($_POST['material']['nombre']) && !isset($_POST['material']['precio'])) {
				$respuesta['mensaje'] = "Se necesitan todos los campos.";
				echo json_encode($respuesta);
				return;
			}

		$nombre = $_POST['material']['nombre'];
		$precio = $_POST['material']['precio'];
		$tipo = $_POST['material']['tipo'];

		//var_dump($nombre); var_dump($precio); var_dump($tipo);

		if ($nombre == "" && $precio == "") {
			$respuesta['mensaje'] = "Se necesitan todos los campos.";
			echo json_encode($respuesta);
			return;
		}
		//-----------------------------------------------------------//
		//WEB SERVICE------------------------------------------------//
		require_once('lib/nusoap.php');

		$host = 'http://localhost/php/web_service.php';

		$proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
		$proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
		$proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
		$proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';
		
		$client = new nusoap_client($host . '?wsdl', true, $proxyhost, $proxyport, 
										$proxyusername, $proxypassword);

		$err = $client->getError();
		if ($err) {
			echo '<h2>ERROR EN LA CONSTRUCCION DEL WS:</h2><pre>' . $err . '</pre>';
			die();
		}

		//VARIABLE ENTRADA
		$material = array('Nombre' => $nombre, 'Precio' => $precio, 'Tipo' => $tipo);

		//INVOCO AL METODO DE MI WS		
		$result = $client->call('AltaMaterial', array('Material' => $material));

		if ($client->fault) {
			echo '<h2>ERROR AL INVOCAR METODO:</h2><pre>';
			print_r($result);
			echo '</pre>';
		} else {
			$err = $client->getError();
			if ($err) {
				$respuesta['mensaje'] = '<h2>ERROR EN EL CLIENTE:</h2><pre>' . $err . '</pre>';
			} 
			else {
				$respuesta['exito']=true;
				$respuesta['mensaje']="OK alta . . . ".$result;
			}
		}
		
		//-----------------------------------------------------------//

		echo json_encode($respuesta);
		break;

	default:
		echo ":(";
		break;
}
 ?>