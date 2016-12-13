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
			
		if (!isset($_POST['material']['nombre']) && !isset($_POST['material']['precio'])) {
				$respuesta['mensaje'] = "Se necesitan todos los campos.";
				echo json_encode($respuesta);
				return;
			}

		$nombre = $_POST['material']['nombre'];
		$precio = $_POST['material']['precio'];
		$tipo = $_POST['material']['tipo'];

		if ($nombre == "" && $precio == "") {
			$respuesta['mensaje'] = "Se necesitan todos los campos.";
			echo json_encode($respuesta);
			return;
		}

		$obj = new MaterialesTXT($nombre,$precio,$tipo);

		if ($obj->InsertarMaterial()) {
			$respuesta['exito']=true;
			$respuesta['mensaje']="OK alta . . . ";
		}
		else
		{
			$respuesta['mensaje'] = "Error al ingresar el material.";
		}

		echo json_encode($respuesta);
		break;

	default:
		echo ":(";
		break;
}
 ?>