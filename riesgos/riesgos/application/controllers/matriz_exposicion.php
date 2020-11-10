<?php
/**
 *
 */
class Matriz_exposicion extends CI_Controller
{

  function __construct(){
    parent::__construct();
    $this->load->model('proceso_model');
    $this->load->model('nivel_exposicion_proceso_model');
  }

  // FUNCIONES PARA MOSTRAR PAGINAS
  public function  index($año){
    $this->load->view('layout/header');
    $data['titulo'] = "Matriz de exposicion año $año";
    $data['año'] = $año;
    $this->load->view('layout/menu', $data);
    $data['procesos'] = $this->proceso_model->getAllProcesosConNivelDeExposicion($año);
    $data['años'] = $this->nivel_exposicion_proceso_model->getAñosConCalificaciones();
    $this->load->view('matriz_exposicion/index', $data);
    $this->load->view('layout/footer');
  }



}// clase
