/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnDetalleTarea", function(){

	var id = $(this).attr("id");

	var datos = new FormData();
	datos.append("id", id);

	$.ajax({
		url: "ajax/tareas.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
			console.log(respuesta);
     		$("#nombre").val(respuesta["nombre"]);
     		$("#fecha_inicio").val(respuesta["fecha_inicio"]);
     		$("#fecha_fin").val(respuesta["fecha_fin"]);
     		$("#fecha").val(respuesta["fecha"]);
     		$("#aporte").val(respuesta["aporte"]);
     		$("#observacion").val(respuesta["observacion"]);
     		$("#actividad_id").val(respuesta["id"]);
     	}

	})


})

$(".tablas").on("click", ".btnEditarAvance", function(){

	var id = $(this).attr("id");

	var datos = new FormData();
	datos.append("id", id);
	console.log(id);
	console.log(datos);
	$("#actividad_id").val(id);
})


$(".avances").on("click", ".btnAvances", function () {
window.location.href = "ajax/reportes.ajax.php?action=generateExcel";
});
