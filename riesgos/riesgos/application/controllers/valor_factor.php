<?php
/**
 *
 */
class Valor_factor extends CI_Controller
{

  function __construct(){
    parent::__construct();
    $this->load->model('factor_model');
    $this->load->model('valor_factor_model');
  }

  //Funciones apra mostrar páginas
  public function  index_factor($id_factor){
    $this->load->view('layout/header');
    $data['titulo'] = "Valores asociados a Factor";
    $this->load->view('layout/menu', $data);
    $data['valores'] = $this->valor_factor_model->getValorFactorPorFactor($id_factor);
    $data['factor'] = $this->factor_model->getFactor($id_factor);
    $data['view_alta'] = $this->load->view("valor_factor/alta", $data , TRUE);
    $this->load->view('valor_factor/index_factor', $data);
    $this->load->view('layout/footer');
  }

  public function  alta($id_factor){
    $this->load->view('layout/header');
    $data['titulo'] = "Alta de valor asociado a Factor";
    $this->load->view('layout/menu', $data);
    $data['factor'] = $this->factor_model->getFactor($id_factor);
    $this->load->view('valor_factor/alta', $data);
    $this->load->view('layout/footer');
  }

  public function modificar($id_valor_factor){
    $this->load->view('layout/header');
    $data['titulo'] = "Modificar de valor asociado a Factor";
    $this->load->view('layout/menu', $data);

    $data['valor_factor'] = $this->valor_factor_model->getValorFactor($id_valor_factor);
    $data['factor'] = $this->factor_model->getFactor($data['valor_factor']['id_factor']);
    $this->load->view('valor_factor/modificar', $data);
    $this->load->view('layout/footer');
  }

  public function obtener_formulario_modificar_factor($id_valor_factor){
    $data['valor_factor'] = $this->valor_factor_model->getValorFactor($id_valor_factor);
    $data['factor'] = $this->factor_model->getFactor($data['valor_factor']['id_factor']);
    echo $this->load->view('valor_factor/modificar', $data, TRUE);
  }




  //Funciones que interaccionan con la DB
  public function add_valor_factor($id_factor){
    if (($this->input->post())==FALSE) {
      echo "ERROR: Acceso denegado";
      return 403;
    }
    $parametros = array(
      'id_factor' => $id_factor,
      'descripcion' => $this->input->post('descripcion'),
      'valor' => $this->input->post('valor')
    );
    $ultimo_id = $this->valor_factor_model->addValorFactor($parametros);

    if ($ultimo_id !== null) {
      $mensaje = "Se inserto el valor correctamente con el ID: ". $ultimo_id ;
      $clase = "success";
    }else{
      $mensaje = "La operacion no se pudo realizar";
      $clase = "danger";
    }
    $this->session->set_flashdata('mensaje', $mensaje);
    $this->session->set_flashdata('clase', $clase);
    redirect(base_url().'valor_factor/index_factor/'.$id_factor);
  }// funcion add_valor_factor


  public function update_valor_factor($id_valor_factor){
    if (($this->input->post())==FALSE) {
      echo "ERROR: Acceso denegado";
      return 403;
    }
    $parametros = array(
      'id_valor_factor' => $id_valor_factor,
      'descripcion' => $this->input->post('descripcion'),
      'valor' => $this->input->post('valor')
    );
    $result = $this->valor_factor_model->updateValorFactor($parametros);

    if ($result !== null) {
      $mensaje = "Se modificó correctamente el valor";
      $clase = "success";
    }else{
      $mensaje = "La operacion no se pudo realizar";
      $clase = "danger";
    }
    $this->session->set_flashdata('mensaje', $mensaje);
    $this->session->set_flashdata('clase', $clase);
    $data['valor_factor'] = $this->valor_factor_model->getValorFactor($id_valor_factor);
    redirect(base_url().'valor_factor/index_factor/'.$data['valor_factor']['id_factor']);
  }//funcion update_valor_factor
}
