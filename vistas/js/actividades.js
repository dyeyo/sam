$(".tablas").on("click", ".btnEditarActividad", function(){

    var id = $(this).attr("id");

    var datos = new FormData();
    let  datosRes = [];
    datos.append("id", id);

    $.ajax({
        url: "ajax/actividades.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){
            $("#id").val(respuesta["id"]);
            $("#editarnuevaActividad").val(respuesta["actividad"]);
            $("#editarseleccionarTipo").val(respuesta["id_tipos"]);
            $("#editarnuevoNombre").val(respuesta["nombre"]);
            $("#editarnuevaCantidad").val(respuesta["cantidad"]);
            $("#editarseleccionarFechaInicio").val(respuesta["fecha_inicio"]);
            $("#editarseleccionarFechaFin").val(respuesta["fecha_fin"]);
            $("#editarseleccionarAnio").val(respuesta["anio"]);
            $("#editarseleccionarMes").val(respuesta["mes"]);
            $("#editarseleccionarDonante").val(respuesta["id_donante"]);
            $("#editarseleccionarDepartamento").val(respuesta["id_departamento"]);
            $("#editarseleccionarMunicipio").val(respuesta["id_municipio"]);
            $("#editarseleccionarEje").val(respuesta["id_eje"]);
            $("#editarnuevaObservacion").val(respuesta["observacion"]);
            $("#editarAporte").val(respuesta["aporte"]);
            $("#editarAvance").val(respuesta["avance"]);
            cargarMunicipios(respuesta["id_departamento"], respuesta["id_municipio"]);
        }
    })
})

function cargarMunicipios(idDepartamento, idMunicipioSeleccionado) {
    // Realizar llamada AJAX para obtener municipios
    $.ajax({
        url: `ajax/municipios-combo.ajax.php?id=${idDepartamento}`,
        method: "GET",
        dataType: "json",
        success: function (municipios) {
            const municipioSelect = $("#editarseleccionarMunicipio");
            municipioSelect.html('<option value="">Seleccionar municipio</option>');

            municipios.forEach(function (municipio) {
                municipioSelect.append(
                    `<option value="${municipio.id}">${municipio.municipio}</option>`
                );
            });

            // Establecer el municipio seleccionado
            municipioSelect.val(idMunicipioSeleccionado);
        },
        error: function (error) {
            console.error("Error al cargar municipios:", error);
        }
    });
}

$(".tablas").on("click", ".btnEliminarActividad", function(){

     var id = $(this).attr("id");

     swal({
        title: '¿Está seguro de borrar el registro?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar actividad!'
     }).then(function(result){

        if(result.value){

            window.location = "index.php?ruta=actividades&id="+id;

        }

     })

})