/*=============================================
EDITAR depto
=============================================*/
$(".tablas").on("click", ".btnEditarDepartamento", function(){

	var id = $(this).attr("id");

	var datos = new FormData();
	datos.append("id", id);

	$.ajax({
		url: "ajax/departamentos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarDepartamento").val(respuesta["departamento"]);
     		$("#id").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR depto
=============================================*/
$(".tablas").on("click", ".btnEliminarDepartamento", function(){

	 var id = $(this).attr("id");

	 swal({
	 	title: '¿Está seguro de borrar el eje?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar eje!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=departamentos&id="+id;

	 	}

	 })

})