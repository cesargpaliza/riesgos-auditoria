<?php
/**
 *
 */
class Valor_factor_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function addValorFactor($parametros){
    $parametros_db = array(
      'id_factor' => $parametros['id_factor'],
      'descripcion' => $parametros['descripcion'],
      'valor' => $parametros['valor']
    );
    $this->db->insert('valor_factor', $parametros_db);
    return $this->db->insert_id();
  }

  public function getValorFactorPorFactor($id_factor){
    $query = "";
    $query .= " SELECT *";
    $query .= " FROM valor_factor vf";
    $query .= " WHERE vf.id_factor = $id_factor";
    $query .= " ORDER BY vf.valor";
    $result = $this->db->query($query);
    return $result ->result_array();
  }

  public function getValorFactor($id_valor_factor){
    $query = "";
    $query .= " SELECT *";
    $query .= " FROM valor_factor vf";
    $query .= " WHERE vf.id_valor_factor = $id_valor_factor";
    $result = $this->db->query($query);
    $array = $result ->result_array();
    $resultado = $array[0];
    return $resultado;
  }

  public function getAllValorFactor(){
    $query = "";
    $query .= " SELECT *";
    $query .= " FROM valor_factor vf";
    //$query .= " JOIN factor f ON vf.id_factor = f.id_factor";
    $result = $this->db->query($query);
    return $result ->result_array();
  }

  public function updateValorFactor($parametros){
    $data = array(
        'valor' => $parametros['valor'],
        'descripcion' => $parametros['descripcion']
      );
    $this->db->where('id_valor_factor', $parametros['id_valor_factor']);
    $result = $this->db->update('valor_factor', $data);
    return $result;
  }

}
