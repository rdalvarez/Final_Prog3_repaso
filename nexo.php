<?php 
session_start();
$respuesta['exito'] = false;
$respuesta['mensaje'] = "";

switch ($_POST['queHago']) {
	case 'INGRESO':
			require_once 'login.php';

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
	
	case "":

		break;

	default:
		# code...
		break;
}
 ?>