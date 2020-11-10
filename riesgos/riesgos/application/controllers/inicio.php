<?php
/**
 *
 */
class Inicio extends CI_Controller
{

  function __construct(){
    parent::__construct();
  }

  // FUNCIONES PARA MOSTRAR PAGINAS
  public function  index(){
    $this->load->view('layout/header');
    $this->load->view('layout/menu');
    $this->load->view('inicio/index');
    $this->load->view('layout/footer');
  }

  public function  a_cerca_de(){
    $this->load->view('layout/header');
    $this->load->view('layout/menu');
    $this->load->view('inicio/a_cerca_de');
    $this->load->view('layout/footer');
  }


}// clase
