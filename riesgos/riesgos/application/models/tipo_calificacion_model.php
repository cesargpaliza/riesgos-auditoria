<?php
/**
 *
 */
class Tipo_calificacion_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }


  public function getTipoCalificacion($id_tipo_calificacion){
    $query = "";
    $query .= " SELECT *";
    $query .= " FROM tipo_calificacion tc";
    $query .= " WHERE tc.id_tipo_calificacion = $id_tipo_calificacion";
    $result = $this->db->query($query);
    $array = $result ->result_array();
    $resultado = $array[0];
    return $resultado;
  }



}
