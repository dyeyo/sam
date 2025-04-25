<?php


//leemos variables

$_SESSION['sub']="nn";


	$titulo1="SUBACTIVIDADES";

	$titulo2="ID";

	$titulo3="SUBACTIVIDADES";


	$modal = 'data-target="#new_avance"';

	$modal_ver = 'data-target="#ver_avance"';

	$data_id = "id";

	$tabla = "subactividades";

	$data_el = "id";

	$funcion = "limpiar_subactividad_add()";
	$funcionver= "limpiar_subactividad_ver()"


if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>



	
<script type="text/javascript" class="init">


$(document).ready(function() {

    var printCounter = 0;

    $('#donante').on('change', function() {
        var selectedValue = $(this).val();

        if (selectedValue!='nn') {
		
			remove(document.getElementById('anio'));
			remove(document.getElementById('output'));
			remove(document.getElementById('actividad'));
			remove(document.getElementById('subactividad'));



 document.getElementById('t_actividad').value="";			
document.getElementById('t_subactividad').value="";			
			document.getElementById('t_output').value="";			
document.getElementById('t_anio').value="";						
	document.getElementById('t_donante').value="";					
			
			
			
			
        $.ajax({
            url: '../xml/get_anio_output.php', // URL de la página que devuelve el texto
            method: 'GET', // Método HTTP
			data: { id: selectedValue },
            success: function(data) {
				datos = data.split("s;s;s");

				
					option = document.createElement('option');
					option.value = "nn";
					option.text = "";				
					document.getElementById('anio').appendChild(option);
				
				
				  if(datos[0]!='')
				  	{
					  for(i=0; i<datos.length;i++) {
					     option = document.createElement('option');
					     option.value = datos[i];
					     option.text = datos[i];

					  if(datos[i].length>0)

					  document.getElementById('anio').appendChild(option);

					  	}

					 }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error: ' + textStatus + ' - ' + errorThrown); // Manejo de errores
            }
        });			
			
	
        $.ajax({
            url: '../xml/get_don_id.php', // URL de la página que devuelve el texto
            method: 'GET', // Método HTTP
			data: { id: selectedValue },
            success: function(data) {
				datos = data.split("-;-;-");
				  if(datos[0]!='')
				  	{
						document.getElementById('t_donante').value=datos[0];
					 }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error: ' + textStatus + ' - ' + errorThrown); // Manejo de errores
            }
        });				
			
			
			
			
			
			
			
        } else {
			document.getElementById('t_donante').value="";
            document.getElementById('t_anio').value="";
			document.getElementById('t_output').value="";
 document.getElementById('t_actividad').value="";
			document.getElementById('t_subactividad').value="";			
			remove(document.getElementById('anio'));	

			remove(document.getElementById('actividad'));
			remove(document.getElementById('subactividad'));
			
			
			remove(document.getElementById('output'));	

        }
    });	

	
	
    $('#anio').on('change', function() {
	
        var selectedValue = $(this).val();

        if (selectedValue!='nn') {
			remove(document.getElementById('output'));
			remove(document.getElementById('actividad'));
remove(document.getElementById('subactividad'));
document.getElementById('t_subactividad').value="";			

 document.getElementById('t_actividad').value="";			
document.getElementById('t_output').value="";			
document.getElementById('t_anio').value="";						
			
			
			$.ajax({
            url: '../xml/get_output_anio.php', // URL de la página que devuelve el texto
            method: 'GET', // Método HTTP
			data: { anio: selectedValue,
				  	id:document.getElementById('donante').value
				  
				  },
            success: function(data) {
				datos = data.split("s;s;s");
				  if(datos[0]!='')
				  	{
					  for(i=0; i<datos.length;i++) {
						  option = document.createElement('option');

						  	valor = datos[i].split("-;-;-");

					  option.value = valor[0];

					  option.text = valor[1];

					  if(valor[0].length>0)

					  document.getElementById('output').appendChild(option);

					  	}

					 }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error: ' + textStatus + ' - ' + errorThrown); // Manejo de errores
            }
        });			
			

						document.getElementById('t_anio').value=selectedValue;

        } else {
			document.getElementById('t_anio').value="";
			document.getElementById('t_output').value="";
 document.getElementById('t_actividad').value="";
document.getElementById('t_subactividad').value="";			

			remove(document.getElementById('actividad'));	
			remove(document.getElementById('subactividad'));
			remove(document.getElementById('output'));	

        }
    });	
	

    $('#output').on('change', function() {
		
        var selectedValue = $(this).val();

        if (selectedValue!='x') {

			remove(document.getElementById('actividad'));
remove(document.getElementById('subactividad'));
 document.getElementById('t_actividad').value="";
			document.getElementById('t_subactividad').value="";
			
			
			
			
			$.ajax({
            url: '../xml/get_actividad_anio.php', // URL de la página que devuelve el texto
            method: 'GET', // Método HTTP
			data: { id:document.getElementById('output').value
				  
				  },
            success: function(data) {
				datos = data.split("s;s;s");
				  if(datos[0]!='')
				  	{
					  for(i=0; i<datos.length;i++) {
						  option = document.createElement('option');

						  	valor = datos[i].split("-;-;-");

					  option.value = valor[0];

					  option.text = valor[1];

					  if(valor[0].length>0)

					  document.getElementById('actividad').appendChild(option);
						  

					  	}

					 }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error: ' + textStatus + ' - ' + errorThrown); // Manejo de errores
            }
        });			
			
	
        $.ajax({
            url: '../xml/get_output_id.php', // URL de la página que devuelve el texto
            method: 'GET', // Método HTTP
			data: { id: selectedValue },
            success: function(data) {
				datos = data.split("-;-;-");
				  if(datos[0]!='')
				  	{
						document.getElementById('t_output').value=datos[0];
						

					 }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error: ' + textStatus + ' - ' + errorThrown); // Manejo de errores
            }
        });				
			
			
			
			
			
			
			
        } else {
			document.getElementById('t_output').value="";
 document.getElementById('t_actividad').value="";
document.getElementById('t_subactividad').value="";			
			remove(document.getElementById('actividad'));	
			remove(document.getElementById('subactividad'));	
		     }
    });	
	
    $('#actividad').on('change', function() {
		
        var selectedValue = $(this).val();

        if (selectedValue!='x') {

			remove(document.getElementById('subactividad'));

 document.getElementById('t_subactividad').value="";
			
			
			
			
			
			$.ajax({
            url: '../xml/get_subactividad_anio.php', // URL de la página que devuelve el texto
            method: 'GET', // Método HTTP
			data: { id:document.getElementById('output').value
				  
				  },
            success: function(data) {
				datos = data.split("s;s;s");
				  if(datos[0]!='')
				  	{
					  for(i=0; i<datos.length;i++) {
						  option = document.createElement('option');

						  	valor = datos[i].split("-;-;-");

					  option.value = valor[0];

					  option.text = valor[1];

					  if(valor[0].length>0)

					  document.getElementById('subactividad').appendChild(option);

					  	}

					 }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error: ' + textStatus + ' - ' + errorThrown); // Manejo de errores
            }
        });			
			
	
			
			
			
			
			
			
			
			
        } else {
			document.getElementById('t_actividad').value="";
 document.getElementById('t_subactividad').value="";

			remove(document.getElementById('subactividad'));	
}
    });	

	

} );

	function remove(obj)
	{
		for (let i = obj.options.length; i >= 0; i--) {
			obj.remove(i);
		  }
		
	}
	
	
	
	</script>
<body class="wide comments example dt-example-bootstrap4">



	<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar productos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar productos</li>
    
    </ol>

  </section>

    <div class="container">




	<form id="formulario" action="avances.php" method="POST" onSubmit="return validar()">

	<h3 align="center">INFORME DE AVANCES ENTREGADOS</h3>

    <!-- Marco 3D con filtros -->
    <div class="form-container">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="donante">Donante</label>
                <select id="donante" class="form-control" name="donante">
					<option value = 'nn'></option>
        <?php
$hacer_consulta = mysqli_query($_SESSION['conexion_res'],"Select * from donantes order by nombreDonante");
$cont=0;
	while ( $row = mysqli_fetch_assoc ( $hacer_consulta ) ) 
	{
		echo "<option value = '".$row['idDonante']."'>".$row['nombreDonante']."</option>";
	}
		  ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="anio">Año</label>
                <select id="anio" name="anio" class="form-control">

                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="output">Output</label>
                <select id="output" name="output" class="form-control">

                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="actividad">Actividad</label>
                <select id="actividad" name="actividad" class="form-control">

                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="subactividad">Subactividad</label>
                <select id="subactividad" name="subactividad" class="form-control">

                </select>
            </div>
        </div>
		<div class="form-row">
<div class="form-group col-6 col-md-3">
            <label for="fechaInicio">Fecha de Inicio</label>
            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio">
        </div>
        <div class="form-group col-6 col-md-3">
            <label for="fechaFin">Fecha de Fin</label>
            <input type="date" class="form-control" id="fechaFin" name="fechaFin">
        </div>			
            <div class="form-group col-12 col-md-4">
                <label for="responsable">Responsable</label>
                <select id="responsable" name="responsable" class="form-control">
<option value = 'nn'></option>
        <?php
$hacer_consulta = mysqli_query($_SESSION['conexion_res'],"Select * from personas order by nombresApellidos");
$cont=0;
	while ( $row = mysqli_fetch_assoc ( $hacer_consulta ) ) 
	{
		echo "<option value = '".$row['idPersona']."'>".$row['nombresApellidos']."</option>";
	}
		  ?>
                </select>
            </div>
            <div class="form-group col-12 col-md-2">
                <label for="eje">Eje</label>
                <select id="eje" name="eje" class="form-control">
					<option value = 'nn'></option>
<?php
$hacer_consulta = mysqli_query($_SESSION['conexion_res'],"Select * from ejes order by nombreEje");
$cont=0;
	while ( $row = mysqli_fetch_assoc ( $hacer_consulta ) ) 
	{
		echo "<option value = '".$row['idEje']."'>".$row['nombreEje']."</option>";
	}
		  ?>
                </select>
            </div>			
			
		</div>
		    <div class="form-row">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Consultar</button>
        </div>
    </div>
    </div>
     <a href="reporte_consolidado.php">Volver</a>
	<input type="hidden" id="cerrando" name="cerrando" value="0">

	<input type="hidden" id="guia" name="guia" value="">

	<input type="hidden" id="t_donante" name="t_donante" value="">
		<input type="hidden" id="t_anio" name="t_anio" value="">
		<input type="hidden" id="t_output" name="t_output" value="">
		<input type="hidden" id="t_actividad" name="t_actividad" value="">
<input type="hidden" id="t_subactividad" name="t_subactividad" value="">

</form>
	
	
</div>	
<script>
function validar()
	{

    var fechaInicio = document.getElementById('fechaInicio').value;
    var fechaFin = document.getElementById('fechaFin').value;

if ((fechaInicio === '' && fechaFin !== '') || (fechaInicio !== '' && fechaFin === '')) {
        alert('Seleccione las dos fechas.');
        return false;
    }

    if (fechaInicio && fechaFin && fechaInicio > fechaFin) {
        alert('La fecha de inicio no puede ser mayor que la fecha de fin.');
        return false;
    }

	}
		
		
		</script>
