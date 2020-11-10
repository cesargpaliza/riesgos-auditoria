<?php
/**
 *
 */
class Factor_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function addFactor($parametros){
    $parametros_db = array(
      'descripcion' => $parametros['descripcion'],
      'ponderacion' => $parametros['ponderacion'],
      'id_tipo_calificacion' => $parametros['id_tipo_calificacion']
    );
    $this->db->insert('factor', $parametros_db);
    return $this->db->insert_id();
  }

  public function getAllFactor(){
    $query = "";
    $query .= " SELECT *";
		$query .= " FROM factor f";
    $query .= " JOIN tipo_calificacion tc ON f.id_tipo_calificacion = tc.id_tipo_calificacion";
    $result = $this->db->query($query);
    return $result ->result_array();
  }

  public function getAllFactorPorTipoCalificacion($id_tipo_calificacion){
    $query = "";
    $query .= " SELECT *";
    $query .= " FROM factor f";
    $query .= " WHERE f.id_tipo_calificacion = $id_tipo_calificacion";
    $result = $this->db->query($query);
    return $result ->result_array();


  }


  public function getFactor($id_factor){
    $query = "";
    $query .= " SELECT *";
    $query .= " FROM factor f";
    $query .= " WHERE f.id_factor = $id_factor";
    $result = $this->db->query($query);
    $array = $result ->result_array();
    $resultado = $array[0];
    return $resultado;
  }

  public function updateFactor($parametros){
    $parametros_db = array(
        'descripcion' => $parametros['descripcion'],
        'ponderacion' => $parametros['ponderacion']
      );
      $this->db->where('id_factor', $parametros['id_factor']);
      $result = $this->db->update('factor', $parametros_db);
      return $result;
  }



}
