function Ingreso(){
	var pagina = "nexo.php";
	var queHago = "INGRESO";
	var login = {usuario: $('#usuario').val(), contraseña: $('#contraseña').val()};
	$('#submit').attr("disabled", true);

	$.ajax({
		type: "POST",
		url: pagina,
		data: {
			login: login, 
			queHago: queHago
		},
		dataType: "json"
	})
	.then( 
		function bien(respuesta){

			if (!respuesta.exito) {
				var html = '<div id="aux" class="alert alert-danger animated fadeInDown" role="alert"> <strong>Error!</strong> '+respuesta.mensaje+'.</div>';
				$("#alerta").html(html);
				setTimeout(
					function(){
						$("#submit").attr("disabled", false);
						$("#usuario").val("");
						$("#contraseña").val("");
						$("#alerta").html("");
					}, 3000);
				return;
			}

			var html = '<div class="alert alert-success animate fadeInDown animated fadeInDown" role="alert"> <strong>Correcto!</strong> '+respuesta.mensaje+'.</div>';
			$("#alerta").html(html);
			setTimeout(function(){ 
				$("#alerta").html(""); 
				$('#submit').attr("disabled", false);
				$('body').html("");
				location.reload();
			}, 3000);
		}
		,
		function mal(jqXHR, textStatus, errorThrown) {
        	console.log("ERROR:\n"+jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
		}
	);
}
function LoginOut(){
	var pagina = "nexo.php";
	var queHago = "DESLOGUEAR";

	$.ajax({
        url:"nexo.php",
        type:"post",
        data: {queHago: queHago} 
    })
    .then(function(retorno){
        location.reload();       
    }); 
}
function SacarCookie(){
	var pagina = "nexo.php";
	var queHago = "SACARCOOKIE";

	$.ajax({
        url:"nexo.php",
        type:"post",
        data: {queHago: queHago} 
    })
    .then(function(retorno){    	
    	location.reload();  
    }); 
}
