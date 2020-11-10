<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calificacion_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  public function addCalificacion($parametros){
    $parametros_db = array(
      'id_proceso' => $parametros['id_proceso'],
      'id_tipo_calificacion' => $parametros['id_tipo_calificacion'],
      'año'=>$parametros['año']
    );
    $this->db->insert('calificacion', $parametros_db);
    return $this->db->insert_id();
  }

  public function updateCalificacionTotalRango($parametros){
    $parametros_db = array(
      'total' => $parametros['total'],
      'rango' => $parametros['rango']
    );
    $this->db->where('id_calificacion', $parametros['id_calificacion']);
    $result = $this->db->update('calificacion', $parametros_db);
    return $result;
  }

  public function getCalificacionTotal($id_calificacion){
    $query = "";
    $query .= " SELECT SUM(TRUNCATE(f.ponderacion * vf.valor,2)) AS total";
    $query .= " FROM linea_calificacion lc";
    $query .= " JOIN factor f ON lc.id_factor = f.id_factor";
    $query .= " JOIN valor_factor vf ON lc.id_valor_factor = vf.id_valor_factor";
    $query .= " WHERE lc.id_calificacion = $id_calificacion";
    $result = $this->db->query($query);
    return $result ->result_array();
  }

  public function getCalificacion($id_calificacion){
    $query = "";
    $query .= " SELECT *";
    $query .= " FROM calificacion c";
    $query .= " WHERE c.id_calificacion = $id_calificacion";
    $result = $this->db->query($query);
    return $result ->result_array();
  }

  public function getDetalleCalificacion($id_calificacion){
    $query = "";
    $query .= " SELECT lc.id_calificacion, f.descripcion, vf.valor, f.ponderacion, TRUNCATE(vf.valor* f.ponderacion, 2) AS subtotal";
    $query .= " FROM linea_calificacion lc";
    $query .= " JOIN factor f ON lc.id_factor = f.id_factor";
    $query .= " JOIN valor_factor vf ON lc.id_valor_factor = vf.id_valor_factor";
    $query .= " WHERE lc.id_calificacion = $id_calificacion";
    $result = $this->db->query($query);
    return $result ->result_array();
  }

  public function getIdCalificacion($id_proceso, $id_tipo_calificacion, $año){
    $query = "";
    $query .= " SELECT c.id_calificacion";
    $query .= " FROM calificacion c";
    $query .= " WHERE c.id_proceso = $id_proceso";
    $query .= " AND c.id_tipo_calificacion = $id_tipo_calificacion";
    $query .= " AND c.año = $año";
    $result = $this->db->query($query);
    $array = $result ->result_array();
    $resultado = $array[0]['id_calificacion'];
    return $resultado;
  }

  public function calcularImpactoRango($nro){
      if ( $nro <= 1.5 ) { return 1; }
      if ( 1.51 <= $nro && $nro <= 2   ) { return 2; }
      if ( 2.01 <= $nro && $nro <= 2.50) { return 3; }
      if ( 2.51 <= $nro) { return 4; } //&& $nro <= 3
  }

  public function calcularProbabilidadRango($nro){
      if ( $nro <= 1.80) { return 1; }
      if ( 1.81 <= $nro && $nro <= 2   ) { return 2; }
      if ( 2.01 <= $nro && $nro <= 2.20) { return 3; } //&& $nro <= 2.20
      if ( 2.21 <= $nro) { return 4; } //&& $nro <= 2.40
  }


  public function getRango($id){
    $query = "";
    $query .= " SELECT c.rango";
    $query .= " FROM calificacion c";
    $query .= " WHERE c.id_calificacion = $id";
    $result = $this->db->query($query);
    $array = $result ->result_array();
    $resultado = $array[0]['rango'];
    return $resultado;
  }




  public function getAllCalificacion($id_proceso){
    $query = "";
    $query .= " SELECT * ";
    $query .= " FROM calificacion c";
    $query .= " JOIN tipo_calificacion tc ";
    $query .= " ON c.id_tipo_calificacion = tc.id_tipo_calificacion";
    $query .= " WHERE c.id_proceso = $id_proceso";
    $query .= " ORDER BY c.año";

    $result = $this->db->query($query);
    return $result ->result_array();
  }

  function haveCalificacion($año, $id_proceso, $id_tipo_calificacion){
    $query = "";
    $query .= " SELECT COUNT(*) cantidad";
    $query .= " FROM calificacion";
    $query .= " WHERE id_proceso = $id_proceso ";
    $query .= " AND id_tipo_calificacion = $id_tipo_calificacion";
    $query .= " AND año = $año";
    $result = $this->db->query($query);
    return $result ->result_array();
  }


  //METODO NO UTILIZADO
  // public function getUltimaCalificacion($id_proceso, $id_tipo_calificacion){
  //   $query = "";
  //   $query .= " SELECT * ";
  //   $query .= " FROM calificacion c";
  //   $query .= " WHERE c.id_proceso = $id_proceso";
  //   $query .= " AND c.id_tipo_calificacion = $id_tipo_calificacion";
  //   $query .= " ORDER BY c.año DESC";
  //   $query .= " LIMIT 1";
  //   $result = $this->db->query($query);
  //   return $result ->result_array();
  // }



}
