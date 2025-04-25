/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarEje", function(){

	var id = $(this).attr("id");

	var datos = new FormData();
	datos.append("id", id);

	$.ajax({
		url: "ajax/ejes.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
			let usuariosArray = JSON.parse(respuesta["usuarios"])
     		$("#editarEje").val(respuesta["eje"]);
     		$("#usuariosEditar").val(usuariosArray);
     		$("#id").val(respuesta["id"]);
			 $("#usuariosEditar").trigger("change");
     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarEje", function(){

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

	 		window.location = "index.php?ruta=ejes&id="+id;

	 	}

	 })

})