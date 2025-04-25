<?php

require_once "conexion.php";

class ModeloTareas{

/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarTareas(){
		$tareas = Conexion::conectar()->prepare("SELECT * FROM actividades
        WHERE CAST(REPLACE(avance, '%', '') AS UNSIGNED) < 100");
		$tareas -> execute();
		return $tareas->fetchAll(PDO::FETCH_ASSOC);
	}

	static public function mdlMostrarTareasPendientes(){
		$tareas = Conexion::conectar()->prepare("SELECT 
                actividades.id AS actividad_id,
                actividades.nombre AS actividad_nombre,
                actividades.fecha_inicio AS actividad_fecha_inicio,
                actividades.fecha_fin AS actividad_fecha_fin,
                actividades.observacion AS actividad_observacion,
                actividades.avance AS actividad_avance,
                tareas.id AS tarea_id, 
                tareas.estado, 
                tareas.porcentaje_aporte_final,
                tareas.persona_apoyan_id,
                tareas.porcentaje_aporte AS tarea_porcentaje_aporte,
                tareas.fecha_aporte, 
                tareas.archivo_1,
                tareas.archivo_2,
                tareas.archivo_3,
                tareas.descripcion_avance AS tarea_descripcion_avance,
                tareas.fuentes_verificacion AS tarea_fuentes_verificacion,
                (SELECT GROUP_CONCAT(DISTINCT u.email SEPARATOR ', ') 
                FROM usuarios u 
                WHERE tareas.persona_apoyan_id LIKE CONCAT('%\"', u.id, '\"%')
                ) AS correos
                FROM actividades
                INNER JOIN tareas ON actividades.id = tareas.actividad_id
                WHERE tareas.estado = 0
                AND tareas.porcentaje_aporte > 0;
            ");
		$tareas -> execute();
		return $tareas->fetchAll(PDO::FETCH_ASSOC);
	}

	static public function mdlDetalleTareas($id){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM actividades WHERE id = $id");
		$stmt->execute();
		return  $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
    
	static public function mdlUpdateEstadoTarea($id, $aporte, $actividad_id){
        $conexion = Conexion::conectar();
        $conexion->beginTransaction();
        try {
            $estado = 1; 
        
            $sqlActualizar = "
                UPDATE tareas 
                SET estado = :estado, 
                    porcentaje_aporte = :aporte,
                    porcentaje_aporte_final = porcentaje_aporte_final + :aporte
                WHERE id = :id";
            
            $stmtActualizar = $conexion->prepare($sqlActualizar);
            
            $stmtActualizar->bindParam(":estado", $estado, PDO::PARAM_INT);
            $stmtActualizar->bindParam(":aporte", $aporte, PDO::PARAM_INT);
            $stmtActualizar->bindParam(":id", $id, PDO::PARAM_INT);
            
            if (!$stmtActualizar->execute()) {
                $conexion->rollBack();
                return "Error al actualizar la tabla tareas.";
            }
        
            $sqlActualizarAvance = "
                UPDATE actividades 
                SET avance = avance + :aporte 
                WHERE id = :actividad_id
            ";
            
            $stmtActualizarAc = $conexion->prepare($sqlActualizarAvance);
        
            $stmtActualizarAc->bindParam(":aporte", $aporte, PDO::PARAM_INT);
            $stmtActualizarAc->bindParam(":actividad_id", $actividad_id, PDO::PARAM_INT);
        
            if (!$stmtActualizarAc->execute()) {
                $conexion->rollBack();
                return "Error al actualizar el avance en actividades.";
            }
        
            $conexion->commit();
            return "ok";
        } catch (Exception $e) {
            $conexion->rollBack();
            return "Error: " . $e->getMessage();
        }
        
    }
    

	static public function mdlUpdateRechazoEstadoTarea($id, $aporte, $actividad_id, $nota){
        $conexion = Conexion::conectar();
        $conexion->beginTransaction();
        try {
            $estado = 0; 
    
            // Actualizar el estado y sumar los valores
            $sqlActualizar = "
                UPDATE tareas 
                SET estado = :estado, 
                    porcentaje_aporte = porcentaje_aporte - :aporte,
                    porcentaje_aporte_final = porcentaje_aporte,
                    nota = :nota
                WHERE id = :id";
            
            $stmtActualizar = $conexion->prepare($sqlActualizar);
            
            // Vincula los parámetros con bindParam
            $stmtActualizar->bindParam(":estado", $estado, PDO::PARAM_INT);
            $stmtActualizar->bindParam(":aporte", $aporte, PDO::PARAM_INT);
            $stmtActualizar->bindParam(":id", $id, PDO::PARAM_INT);
            $stmtActualizar->bindParam(":nota", $nota, PDO::PARAM_INT);
            
            if (!$stmtActualizar->execute()) {
                $conexion->rollBack();
                return "error al actualizar avance";
            }
            $conexion->commit();
            return "ok";
        } catch (Exception $e) {
            $conexion->rollBack();
            return "Error: " . $e->getMessage();
        }
    }
    
	static public function mdlCrearTarea($datos) {
        try {
            $conexion = Conexion::conectar();
    
            $conexion->beginTransaction();
    
            $sqlInsertarTarea = "
                INSERT INTO tareas (actividad_id, persona_apoyan_id, ejes_intervienen_id, archivo_1, archivo_2, archivo_3, porcentaje_aporte, fecha_aporte, descripcion_avance, fuentes_verificacion) 
                VALUES (:actividad_id, :persona_apoyan_id, :ejes_intervienen_id, :archivo_1, :archivo_2, :archivo_3, :porcentaje_aporte, :fecha_aporte, :descripcion_avance, :fuentes_verificacion)
            ";
            $stmtInsertar = $conexion->prepare($sqlInsertarTarea);
    
            $stmtInsertar->bindParam(":actividad_id", $datos["actividad_id"], PDO::PARAM_INT);
            $stmtInsertar->bindParam(":persona_apoyan_id", $datos["persona_apoyan_id"], PDO::PARAM_STR); 
            $stmtInsertar->bindParam(":ejes_intervienen_id", $datos["ejes_intervienen_id"], PDO::PARAM_STR); 
            $stmtInsertar->bindParam(":archivo_1", $datos["archivo_1"], PDO::PARAM_STR);
            $stmtInsertar->bindParam(":archivo_2", $datos["archivo_2"], PDO::PARAM_STR);
            $stmtInsertar->bindParam(":archivo_3", $datos["archivo_3"], PDO::PARAM_STR);
            $stmtInsertar->bindParam(":porcentaje_aporte", $datos["porcentaje_aporte"], PDO::PARAM_INT);
            $stmtInsertar->bindParam(":fecha_aporte", $datos["fecha_aporte"], PDO::PARAM_STR);
            $stmtInsertar->bindParam(":descripcion_avance", $datos["descripcion_avance"], PDO::PARAM_STR);
            $stmtInsertar->bindParam(":fuentes_verificacion", $datos["fuentes_verificacion"], PDO::PARAM_STR);
    
            if (!$stmtInsertar->execute()) {
                $conexion->rollBack();
                return "error al insertar tarea";
            }
    
            $conexion->commit();
            return "ok";
        } catch (PDOException $e) {
            $conexion->rollBack();
            return "error: " . $e->getMessage();
        }
    }
    

 
    static public function mdlTareasRojo($id){
		$rojo = Conexion::conectar()->prepare("SELECT anio,
            SUM(CASE WHEN avance < 30 THEN 1 ELSE 0 END)  FROM  actividades 
            WHERE id_donante = $id;
            ");
		$rojo->execute();
		return  $rojo->fetchAll(PDO::FETCH_ASSOC);
	}

    static public function mdlTareasAmarillo($id){
		$amarillo = Conexion::conectar()->prepare("SELECT anio,
            SUM(CASE WHEN avance BETWEEN 31 AND 99 THEN 1 ELSE 0 END) FROM  actividades 
            WHERE id_donante = $id;");
		$amarillo->execute();
		return  $amarillo->fetchAll(PDO::FETCH_ASSOC);
	}

    static public function mdlTareasVerde($id){
		$verde = Conexion::conectar()->prepare("SELECT anio,
            SUM(CASE WHEN avance = 100 THEN 1 ELSE 0 END)  FROM  actividades 
            WHERE id_donante = $id
            ;");
		$verde->execute();
		return  $verde->fetchAll(PDO::FETCH_ASSOC);
	}


    public static function mdlInformeEntregados()
    {
        $stmt = Conexion::conectar()->prepare("SELECT 
            actividades.id AS actividad_id,
            actividades.nombre AS actividad_nombre,
            actividades.fecha_inicio AS actividad_fecha_inicio,
            actividades.fecha_fin AS actividad_fecha_fin,
            actividades.observacion AS actividad_observacion,
            actividades.avance AS actividad_avance,
            tareas.id AS tarea_id,
            tareas.porcentaje_aporte AS tarea_porcentaje_aporte,
            tareas.descripcion_avance AS tarea_descripcion_avance,
            tareas.fuentes_verificacion  AS tarea_fuentes_verificacion,
            GROUP_CONCAT(DISTINCT usuarios.nombre SEPARATOR ', ') AS responsables
        FROM 
            actividades
        INNER JOIN tareas ON actividades.id = tareas.actividad_id
        INNER JOIN usuarios ON tareas.persona_apoyan_id LIKE CONCAT('%\"', usuarios.id, '\"%')
        WHERE actividades.avance >= 30 
        ORDER BY actividades.fecha_inicio ASC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mdlInformeAtrasadas()
    {
        $stmt = Conexion::conectar()->prepare("SELECT 
        actividades.id AS actividad_id,
        actividades.nombre AS actividad_nombre,
        actividades.fecha_inicio AS actividad_fecha_inicio,
        actividades.fecha_fin AS actividad_fecha_fin,
        actividades.observacion AS actividad_observacion,
        actividades.avance AS actividad_avance,
        tareas.id AS tarea_id,
        tareas.estado,
        tareas.porcentaje_aporte AS tarea_porcentaje_aporte,
        tareas.descripcion_avance AS tarea_descripcion_avance,
        tareas.fuentes_verificacion AS tarea_fuentes_verificacion,
        GROUP_CONCAT(DISTINCT usuarios.nombre SEPARATOR ', ') AS responsables,
        GROUP_CONCAT(DISTINCT usuarios.email SEPARATOR ', ') AS correo_responsables
            FROM actividades
            INNER JOIN tareas ON actividades.id = tareas.actividad_id
            INNER JOIN usuarios ON tareas.persona_apoyan_id LIKE CONCAT('%\"', usuarios.id, '\"%')
            WHERE actividades.avance <= 30
            AND tareas.estado = 0
            GROUP BY 
        actividades.id, 
        actividades.nombre, 
        actividades.fecha_inicio, 
        actividades.fecha_fin, 
        actividades.observacion, 
        actividades.avance, 
        tareas.id, 
        tareas.estado, 
        tareas.porcentaje_aporte, 
        tareas.descripcion_avance, 
        tareas.fuentes_verificacion
    ORDER BY actividades.fecha_inicio ASC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mdlInformeAtrasadasEmail()
    {
        $stmt = Conexion::conectar()->prepare("SELECT 
                    GROUP_CONCAT(DISTINCT actividades.nombre SEPARATOR ', ') AS actividades_nombres,
                    usuarios.nombre AS responsable_nombre,
                    usuarios.email AS responsable_correo
                FROM actividades
                INNER JOIN tareas ON actividades.id = tareas.actividad_id
                INNER JOIN usuarios ON tareas.persona_apoyan_id LIKE CONCAT('%\"', usuarios.id, '\"%')
                WHERE actividades.avance <= 30
                AND tareas.estado = 0
                GROUP BY 
                    usuarios.id, usuarios.nombre, usuarios.email  
                ORDER BY `actividades_nombres` ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

