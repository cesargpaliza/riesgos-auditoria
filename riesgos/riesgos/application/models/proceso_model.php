<?php
/**
 *
 */
class Proceso_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function addProceso($parametros){
    $parametros_db = array(
      'nombre' => $parametros['nombre'],
      'objetivo' => $parametros['objetivo'],
      'responsable' => $parametros['responsable'],
      'descripcion' => $parametros['descripcion']
    );
    $this->db->insert('proceso', $parametros_db);
    return $this->db->insert_id();
  }

  public function getAllProceso(){
    $query = "";
    $query .= " SELECT *";
		$query .= " FROM proceso";
    $result = $this->db->query($query);
    return $result ->result_array();
  }

  public function getProceso($id_proceso){
    $query = "";
    $query .= " SELECT *";
    $query .= " FROM proceso p";
    $query .= " WHERE p.id_proceso = $id_proceso";
    $result = $this->db->query($query);
    $array = $result ->result_array();
    $resultado = $array[0];
    return $resultado;
  }

  public function haveCalificacion($id_proceso, $id_tipo_calificacion, $año){
    $query = "";
    $query .= " SELECT COUNT(*) AS cantidad ";
    $query .= " FROM calificacion c";
    $query .= " WHERE c.id_proceso = $id_proceso";
    $query .= " AND c.id_tipo_calificacion = $id_tipo_calificacion";
    $query .= " AND c.año = $año";
    $result = $this->db->query($query);
    $array = $result ->result_array();
    $resultado = $array[0]['cantidad'];
    return $resultado;
  }

  public function getAllProcesosConNivelDeExposicion($año){
    $query = "";
    $query .= " SELECT p.id_proceso, p.nombre, p.objetivo, p.responsable, ne.nombre AS nivel_exposicion, c.nombre color, ca.rango rango_impacto, ca2.rango rango_probabilidad ";
    $query .= " FROM nivel_exposicion_proceso nep ";
    $query .= " JOIN proceso p ON p.id_proceso = nep.id_proceso ";
    $query .= " JOIN nivel_exposicion ne ON ne.id_nivel_exposicion = nep.id_nivel_exposicion ";
    $query .= " JOIN color c ON c.id_color = ne.id_color JOIN calificacion ca ON ca.id_calificacion = nep.id_calificacion_impacto ";
    $query .= " JOIN calificacion ca2 ON ca2.id_calificacion = nep.id_calificacion_probabilidad ";
    $query .= " WHERE nep.año = $año";
    $query .= " ORDER BY ne.id_color DESC";

    $result = $this->db->query($query);
    return $result ->result_array();
  }

  function getMaximoNumeroDeProcesosEnCelda($año){
    $query = "";
    $query .= " SELECT MAX(cantidad) maximo";
    $query .= " FROM(";
    $query .= "     SELECT cp.rango rango_p, ci.rango rango_i , COUNT(*) AS cantidad";
    $query .= "     FROM nivel_exposicion_proceso nep";
    $query .= "     JOIN proceso p ON p.id_proceso = nep.id_proceso";
    $query .= "     JOIN calificacion cp ON nep.id_calificacion_probabilidad = cp.id_calificacion";
    $query .= "     JOIN calificacion ci ON nep.id_calificacion_impacto = ci.id_calificacion";
    $query .= "     WHERE nep.año = 2018";
    $query .= "     GROUP BY cp.rango, ci.rango";
    $query .= "     ) AS rangos";

    $result = $this->db->query($query);
    return $result ->result_array();
  }


}
