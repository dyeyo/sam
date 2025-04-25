/*=============================================
EDITAR mpio
=============================================*/
$(".tablas").on("click", ".btnEditarMunicipio", function(){
	var id = $(this).attr("id");
	var datos = new FormData();
	datos.append("id", id);

	$.ajax({
		url: "ajax/municipios.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
			console.log(respuesta);
     		$("#id").val(respuesta[0]["id"]);
     		$("#editarMunicipio").val(respuesta[0]["municipio"]);
     	}
	})

})

/*=============================================
ELIMINAR mpio
=============================================*/
$(".tablas").on("click", ".btnEliminarMunicipio", function(){

	 var id = $(this).attr("id");

	 swal({
	 	title: '¿Está seguro de borrar el registro?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=municipios&id="+id;

	 	}

	 })

})