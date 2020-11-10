<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nivel_exposicion_proceso_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  public function addNivelExposicionProceso($parametros){
    $parametros_db = array(
      'id_proceso' => $parametros['id_proceso'],
      'año' => $parametros['año'],
      'id_calificacion_probabilidad' => $parametros['id_calificacion_probabilidad'],
      'id_calificacion_impacto' => $parametros['id_calificacion_impacto'],
      'id_nivel_exposicion' => $parametros['id_nivel_exposicion']
    );
    $this->db->insert('nivel_exposicion_proceso', $parametros_db);
    return $this->db->insert_id();
  }

  public function getAñosConCalificaciones(){
    $query = "";
    $query .= " SELECT nep.año";
    $query .= " FROM nivel_exposicion_proceso nep";
    $query .= " GROUP BY nep.año";
    $result = $this->db->query($query);
    return $result ->result_array();

  }

}
