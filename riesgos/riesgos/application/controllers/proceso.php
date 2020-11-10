<?php
/**
 *
 */
class Proceso extends CI_Controller
{

  function __construct(){
    parent::__construct();
    $this->load->model('proceso_model');
    $this->load->model('calificacion_model');
  }

  // FUNCIONES PARA MOSTRAR PAGINAS
  public function  index(){
    $this->load->view('layout/header');
    $data['titulo'] = "Gestión de Procesos";
    $this->load->view('layout/menu', $data);

    $data['procesos'] = $this->proceso_model->getAllProceso();
    $this->load->view('proceso/index', $data);
    $this->load->view('layout/footer');
  }


  public function alta(){
    $this->load->view('layout/header');
    $data['titulo'] = "Alta de Proceso";
    $this->load->view('layout/menu', $data);
    $this->load->view('proceso/alta');
    $this->load->view('layout/footer');
  }

  // FUNCIONES PARA INTERACTUAR CON LA BASE DE DATOS
  public function add_proceso(){
    if (($this->input->post())==FALSE) {
      echo "ERROR: Acceso denegado";
      return 403;
    }
    $parametros = array(
      'nombre' => $this->input->post('nombre'),
      'objetivo' => $this->input->post('objetivo'),
      'responsable' => $this->input->post('responsable'),
      'descripcion' => $this->input->post('descripcion')
    );
    $ultimo_id = $this->proceso_model->addProceso($parametros);

    if ($ultimo_id !== null) {
      $mensaje = "Se inserto el Proceso con el ID: ". $ultimo_id ;
      $clase = "success";
    }else{
      $mensaje = "La operacion no se pudo realizar";
      $clase = "danger";
    }
    $this->session->set_flashdata('mensaje', $mensaje);
    $this->session->set_flashdata('clase', $clase);
    redirect(base_url().'proceso');

  }// funcion addFactor

  function get_proceso($id_proceso){
    return (array) $this->proceso_model->getProceso($id_proceso);
  }



}// clase
