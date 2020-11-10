<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nivel_exposicion_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  public function getIDNivelExposicion($id_impacto, $id_probabilidad){
    $query = "";
    $query .= " SELECT *";
    $query .= " FROM nivel_exposicion ne";
    $query .= " WHERE ne.rango_calificacion_impacto = $id_impacto";
    $query .= " AND ne.rango_calificacion_probabilidad = $id_probabilidad";

    $result = $this->db->query($query);
    return $result->result_array();
  }

  // SELECT *
  // FROM nivel_exposicion ne
  // WHERE ne.rango_calificacion_impacto = $id_impacto
  // AND ne.rango_calificacion_probabilidad = $id_probabilidad

}
