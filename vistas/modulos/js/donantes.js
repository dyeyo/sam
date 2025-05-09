/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarDonante", function(){

	var id = $(this).attr("id");

	var datos = new FormData();
	datos.append("id", id);

	$.ajax({
		url: "ajax/donantes.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarDonante").val(respuesta["categoria"]);
     		$("#id").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarDonante", function(){

	 var id = $(this).attr("id");

	 swal({
	 	title: '¿Está seguro de borrar el donante?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar donante!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=donantes&id="+id;

	 	}

	 })

})