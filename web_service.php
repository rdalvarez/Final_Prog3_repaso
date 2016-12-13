<?php 
	require_once('lib/nusoap.php'); 
	require_once('clases/materiales.php');
	$server = new nusoap_server(); 

	$server->configureWSDL('WebService Materiales', 'urn:wsMaterialesTXT'); 

///**********************************************************************************************************///


//AGREGO TIPO COMPLEJO, INFORMANDO SU ESTRUCTURA	
	$server->wsdl->addComplexType(
									'Materiales',
									'complexType',
									'struct',
									'all',
									'',
									array('Nombre' => array('name' => 'Nombre', 'type' => 'xsd:string'),
										  'Precio' => array('name' => 'Precio', 'type' => 'xsd:int'),
										  'Tipo' => array('name' => 'Tipo', 'type' => 'xsd:string')
										 )
								);
//PARAMETROS DE SALIDA DE TIPOS COMPLEJOS								
	$server->wsdl->addComplexType(
									'Retorno',
									'complexType',
									'struct',
									'all',
									'',
									array('Mensaje' => array('name' => 'Mensaje', 'type' => 'xsd:string')
										 )
								);
///**********************************************************************************************************///								
//REGISTRO METODO CON PARAMETRO DE ENTRADA COMPLEJO Y PARAMETRO DE SALIDA 'SIMPLE'
	$server->register('SaludarPersona',                	
						array('Persona' => 'tns:Persona'),  
						array('return' => 'xsd:string'),   
						'urn:testWSDL',                		
						'urn:testWSDL#SaludarPersona',             
						'rpc',                        		
						'encoded',                    		
						'Saluda a una persona'    			
					);


	function SaludarPersona($p) {

		$saludo = 'Hola, ' . $p['Nombre'] .
		' tu edad es de ' . $p['Edad'] .
		' a&ntilde;os y eres ' . $p['Sexo'] . '.';
		
		return $saludo;
	}
///**********************************************************************************************************///

//REGISTRO METODO SIN PARAMETRO DE ENTRADA Y PARAMETRO DE SALIDA 'ARRAY de ARRAYS'
	$server->register('ObtenerTodosLosMateriales',                	
						array(),  
						array('return' => 'xsd:Array'),   
						'urn:wsMaterialesTXT',                		
						'urn:wsMaterialesTXT#ObtenerTodosLosMateriales',             
						'rpc',                        		
						'encoded',                    		
						'Obtiene todos los Materiales del archivo TXT'    			
					);


	function ObtenerTodosLosMateriales() {
		
		$r =  MaterialesTXT::TraerTodosLosMateriales();
		return $r;
		//return "llegue";
	}

///**********************************************************************************************************///								

	$HTTP_RAW_POST_DATA = file_get_contents("php://input");	
	$server->service($HTTP_RAW_POST_DATA);
?>