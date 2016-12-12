<?php
/**
*		ACCESO POR TXT
*/				
class MaterialesTXT
{
	public $id;
	public $nombre;
	public $precio;
	public $tipo;

	function __construct($id=NULL,$nombre=NULL,$precio=NULL,$tipo=NULL)
	{
		if ($id!=NULL) {
			$this->id = AutoTXT::ObtenerUltimoId() + 1;
			$this->nombre = $nombre;
			$this->precio = $precio;
			$this->tipo = $tipo;
		}
	}

	private static function ObtenerUltimoId(){
		$a = fopen("BD/autos.txt", "r");
		$ultimoID;
		while (!feof($a)) {
			$arr = explode(" - ",fgets($a));
			if (count($arr) > 1) {
				$ultimoID = $arr[0];
			}
		}
		return $ultimoID;
	}

	public static function ObtenerAutoPorId($id){
		$objAuto = new AutoTXT();
		$a = fopen("BD/autos.txt", "r");

		while (!feof($a)) {
			$arr = explode(" - ", fgets($a));

			if (count($arr) > 1) {
				if ($arr[0] == $id) {
					$objAuto->nombre = $arr[1];
					$objAuto->precio = $arr[2];
					$objAuto->tipo = $arr[3];
					break;
				}
			}
		}
		fclose($a);
		return $objAuto;
	}
}

/**
*		ACCESO POR PDO
*/
class AutoPDO
{
	
	function __construct(argument)
	{
		# code...
	}
}

?>
