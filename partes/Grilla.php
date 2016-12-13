<?php
//DIRECTO DE LA CLASE------------------------------------------------//
// require_once 'clases/materiales.php';
// $arrMateriales2 = MaterialesTXT::TraerTodosLosMateriales();
// var_dump($arrMateriales2);
//USANDO WEB_SERVICE-------------------------------------------------//

require_once('SERVIDOR/lib/nusoap.php');

$host = 'http://localhost/php/SERVIDOR/web_service.php';

		$client = new nusoap_client($host . '?wsdl');

		$err = $client->getError();
		if ($err) {
			echo '<h2>ERROR EN LA CONSTRUCCION DEL WS:</h2><pre>' . $err . '</pre>';
			die();
		}

//INVOCO AL METODO DE MI WS		
		$arrMateriales = $client->call('ObtenerTodosLosMateriales', array());

		if ($client->fault) {
			echo '<h2>ERROR AL INVOCAR METODO:</h2><pre>';
			print_r($arrMateriales);
			echo '</pre>';
		} else {
			$err = $client->getError();
			if ($err) {
				echo '<h2>ERROR EN EL CLIENTE:</h2><pre>' . $err . '</pre>';
			} 
			else {
				echo '<h2>Resultado</h2>';
				echo '<pre>' . var_dump($arrMateriales) . '</pre>';
				echo '<br/>';
			}
		}
?>

<!-- <script type="text/javascript">
	<?php /*
	echo ('
		var arr = '.json_encode($arrMateriales).';


		function boton(id,accion){
            if (accion == 1) {
                Modificar();
            }else
                Eliminar();
        }');*/ 
	?>
</script> -->
<!-- <div class="container animated slideUp">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading"> 

					<h4>Grilla de Materiales <a data-toggle="tooltip" onclick="CargarForm()" class="btn btn-success btn-xs" title="Nuevo Usuario"><span class="glyphicon glyphicon-plus"></span></a></h4>                  
				</div>

                <div class="table-container scroll-window">
                    <table class="table table-hover table-striped">
                    	<thead>
                    		<tr>
	                        	<th>Id</th>
	                            <th>Nombre</th>
	                            <th>Precio</th>
	                            <th>Tipo</th>
	                            <th class="text-center">Acción</th>
	                        </tr>
                    	</thead>
						<tbody>
	                        <?php
	                        foreach ($arrMateriales as $material) 
	                        {
	                            $fila ='<tr>';
	                            $fila.='<td class="text-left scope="row"">'.$material->id.'</td>';
	                            $fila.='<td class="text-left">'.$material->nombre.'</td>';
	                            $fila.='<td class="text-left">'.$material->precio.'</td>';
	                            $fila.='<td class="text-left">'.$material->tipo.'</td>';
	                            $fila.='<td class="text-center">';
	                            $fila.='<a data-toggle="tooltip" onclick="boton('.$material->id.',1)" class="btn btn-info btn-xs" title="EDITAR"><span class="glyphicon glyphicon-pencil"></span></a> ';
	                            $fila.= '<a data-toggle="tooltip" onclick="boton('.$material->id.',2)" class="btn btn-danger btn-xs" title="BORRAR"><span class="glyphicon glyphicon-trash"></span></a>';
	                            $fila.='</td></tr>';
	                            echo $fila;   
	                        }
	                        ?>
						</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> -->