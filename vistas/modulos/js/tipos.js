/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarTipo", function(){

	var id = $(this).attr("id");

	var datos = new FormData();
	datos.append("id", id);

	$.ajax({
		url: "ajax/tipos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarTipo").val(respuesta["tipo"]);
     		$("#id").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarTipo", function(){

	 var id = $(this).attr("id");

	 swal({
	 	title: '¿Está seguro de borrar el tipo de actividad?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar tipo de actividad!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=tipos&id="+id;

	 	}

	 })

})