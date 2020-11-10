<?php
/**
 *
 */
class Factor extends CI_Controller
{

  function __construct(){
    parent::__construct();
    $this->load->model('factor_model');
  }

  // FUNCIONES PARA MOSTRAR PAGINAS
  public function  index(){
    $this->load->view('layout/header');
    $data['titulo'] = "Gestión de Factores";
    $this->load->view('layout/menu', $data);
    $data['factores'] = $this->factor_model->getAllFactor();
    $this->load->view('factor/index', $data);
    $this->load->view('layout/footer');
  }

  public function  alta(){
    $this->load->view('layout/header');
    $data['titulo'] = "Alta de Factor";
    $this->load->view('layout/menu', $data);
    $this->load->view('factor/alta');
    $this->load->view('layout/footer');
  }

  public function modificar($id_factor){
    $this->load->view('layout/header');
    $data['titulo'] = "Modificar Factor";
    $this->load->view('layout/menu', $data);
    $data['factor'] = $this->factor_model->getFactor($id_factor);
    $this->load->view('factor/modificar', $data);
    $this->load->view('layout/footer');
  }

  // FUNCIONES PARA INTERACTUAR CON LA BASE DE DATOS
  public function add_factor(){
    if (($this->input->post())==FALSE) {
      echo "ERROR: Acceso denegado";
      return 403;
    }
    $parametros = array(
      'descripcion' => $this->input->post('descripcion'),
      'ponderacion' => $this->input->post('ponderacion'),
      'id_tipo_calificacion' => $this->input->post('id_tipo_calificacion')
    );
    $ultimo_id = $this->factor_model->addFactor($parametros);

    if ($ultimo_id !== null) {
      $mensaje = "Se inserto la Oficina con el ID: ". $ultimo_id ;
      $clase = "success";
    }else{
      $mensaje = "La operacion no se pudo realizar";
      $clase = "danger";
    }
    $this->session->set_flashdata('mensaje', $mensaje);
    $this->session->set_flashdata('clase', $clase);
    redirect(base_url().'factor');
  }// funcion addFactor


  public function update_factor($id_factor){
    if (($this->input->post())==FALSE) {
      echo "ERROR: Acceso denegado";
      return 403;
    }
    $parametros = array(
      'id_factor' => $id_factor,
      'descripcion' => $this->input->post('descripcion'),
      'ponderacion' => $this->input->post('ponderacion'),
      'id_tipo_calificacion' => $this->input->post('id_tipo_calificacion')
    );
    $ultimo_id = $this->factor_model->updateFactor($parametros);

    if ($ultimo_id !== null) {
      $mensaje = "Se modifico correctamente el factor: ". $ultimo_id ;
      $clase = "success";
    }else{
      $mensaje = "La operacion no se pudo realizar";
      $clase = "danger";
    }
    $this->session->set_flashdata('mensaje', $mensaje);
    $this->session->set_flashdata('clase', $clase);
    redirect(base_url().'factor');
  }// funcion update_factor



}// clase
