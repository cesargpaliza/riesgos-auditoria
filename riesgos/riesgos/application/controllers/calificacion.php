<?php
/**
 *
 */
class Calificacion extends CI_Controller
{

  function __construct(){
    parent::__construct();
    $this->load->model('proceso_model');
    $this->load->model('tipo_calificacion_model');
    $this->load->model('factor_model');
    $this->load->model('valor_factor_model');
    $this->load->model('linea_calificacion_model');
    $this->load->model('calificacion_model');
    $this->load->model('nivel_exposicion_proceso_model');
    $this->load->model('nivel_exposicion_model');
  }

  
  // FUNCIONES PARA MOSTRAR PAGINAS ///////////////////////////////////////////

  public function  index($id_proceso, $año){
    $this->load->view('layout/header');
    $proceso = $this->proceso_model->getProceso($id_proceso);

    //Preguntar si tiene Impacto cargada
    $data['tiene_impacto'] = $this->proceso_model->haveCalificacion($id_proceso, 1, $año);
    if ($data['tiene_impacto'] > 0) {
      $id_calificacion = $this->calificacion_model->getIdCalificacion($id_proceso, 1, $año);
      $data['detalle_impacto']  = $this->calificacion_model->getDetalleCalificacion($id_calificacion);
      $data['total_impacto']  = $this->calificacion_model->getCalificacionTotal($id_calificacion);
      $data['rango_impacto']  = $this->calificacion_model->calcularImpactoRango($data['total_impacto'][0]['total']);
      $data['calificacion']  = $this->calificacion_model->getCalificacion($id_calificacion);
      $año = $data['calificacion'][0]['año'];
    }

    //Preguntar si tiene Probabilidad cargada
    $data['tiene_probabilidad'] = $this->proceso_model->haveCalificacion($id_proceso, 2, $año);
    if ($data['tiene_probabilidad'] > 0) {
      $id_calificacion = $this->calificacion_model->getIdCalificacion($id_proceso, 2, $año);
      $data['detalle_probabilidad']  = $this->calificacion_model->getDetalleCalificacion($id_calificacion);
      $data['total_probabilidad']  = $this->calificacion_model->getCalificacionTotal($id_calificacion);
      $data['rango_probabilidad']  = $this->calificacion_model->calcularProbabilidadRango($data['total_probabilidad'][0]['total']);
      $data['calificacion']  = $this->calificacion_model->getCalificacion($id_calificacion);
      $año = $data['calificacion'][0]['año'];
    }

    $data['titulo'] = "Calificaciones Asociadas al Proceso: " . $proceso['nombre'] . " - Año: " . $año;
    $this->load->view('layout/menu', $data);
    $data['proceso'] = $proceso;
    $this->load->view('calificacion/index_viejo', $data);
    $this->load->view('layout/footer');

  }//function index


  public function  alta($id_proceso, $id_tipo_calificacion){
    $this->load->view('layout/header');

    $data['proceso'] = $this->proceso_model->getProceso($id_proceso);
    $data['tipo_calificacion'] = $this->tipo_calificacion_model->getTipoCalificacion($id_tipo_calificacion);
    $data['titulo'] = "Alta de calificación de " . $data['tipo_calificacion']['nombre'] . " del Proceso: " . $data['proceso']['nombre'];
    $data['factores'] = $this->factor_model->getAllFactorPorTipoCalificacion($id_tipo_calificacion);
    $data['valores'] = $this->valor_factor_model->getAllValorFactor();

    $this->load->view('layout/menu', $data);
    $this->load->view('calificacion/alta');
    $this->load->view('layout/footer');
  }

  // FUNCIONES PARA INTERACTUAR CON LA BASE DE DATOS ///////////////////////////
  /*
    funcion que crea:
      - calificacion
      - lineas_calificacion
      - proceso_calificacion
  */
  public function add_calificacion($id_proceso, $id_tipo_calificacion){
    if (($this->input->post())==FALSE) {
      echo "ERROR: Acceso denegado";
      return 403;
    }

    $año = $this->input->post('año');
    //PREGUNTAR SI EL PROCESO YA TIENE LA CALIFICACION EN ESTE AÑO de este tipo
    $respuesta = $this->calificacion_model->haveCalificacion($año, $id_proceso, $id_tipo_calificacion);
    if ($respuesta[0]['cantidad']>0) {
      $mensaje = "El Proceso ya tiene cargada una calificacion en ese año" ;
      $clase = "danger";
      $this->session->set_flashdata('mensaje', $mensaje);
      $this->session->set_flashdata('clase', $clase);
      redirect(base_url()."calificacion/alta/$id_proceso/$id_tipo_calificacion");
    }else {
      //En caso que no este cargada la calificacion
      //Guardar Calificacion
      $parametros = array(
        'id_proceso' => $id_proceso,
        'id_tipo_calificacion' => $id_tipo_calificacion,
        'año' =>  $año
      );
      $id_calificacion = $this->calificacion_model->addCalificacion($parametros);

      //Guardar Lineas de Calificacion
      $post = $this->input->post();
      $datos = array();

      //Se recorren y se crea el array data para guardar todos los datos en bach
      foreach($post as $key => $value){
        if($key != "año" ) {
          $a = array(
            'id_calificacion' => $id_calificacion,
            'id_factor' => $key,
            'id_valor_factor' => $value
          );
          array_push($datos, $a);
        }
      }
      $this->linea_calificacion_model->addLineasDeCalificacion($datos);
      echo "<pre>";
      print_r($datos);
      echo "</pre>";

      //calcular total DESPUES DE INSERTAR LAS LINEAS
      $data['total']  = $this->calificacion_model->getCalificacionTotal($id_calificacion);
      $total = $data['total'][0]['total'];
      echo "Total de calificacion cargada por post: $total <br>";

      //Calcular rangos de probabilidad e impacto
      if($id_tipo_calificacion == 1){
        $data['rango']  = $this->calificacion_model->calcularImpactoRango($total);
        echo "<pre>RANGO Impacto";
        print_r($data['rango']);
        echo "</pre>";
      }
      if ($id_tipo_calificacion == 2) {
        $data['rango']  = $this->calificacion_model->calcularProbabilidadRango($total);
        echo "<pre>RANGO Probabilidad ";
        print_r($data['rango']);
        echo "</pre>";
      }

      //Acualizar el registro con el total y el rango correspondiente
      $parametros = array(
        'total' => $total,
        'id_calificacion' => $id_calificacion,
        'rango' => $data['rango']
      );
      $respuesta =  $this->calificacion_model->updateCalificacionTotalRango($parametros);
      //PREGUNTAR SI YA TIENE LAS DOS CALIFICACIONES (Impacto y Probabilidad) CARGADAS

      //Preguntar si tiene cargado IMPACTO y PROBABILIDAD
      $data['tiene_impacto'] = $this->proceso_model->haveCalificacion($id_proceso, 1, $año);
      $data['tiene_probabilidad'] = $this->proceso_model->haveCalificacion($id_proceso, 2, $año);

      echo "<br> tiene_impacto: ".$data['tiene_impacto'];
      echo "<br> tiene_probabilidad: ".$data['tiene_probabilidad'];


      if ($data['tiene_impacto'] > 0 &&  $data['tiene_probabilidad'] > 0) {
        //Obtener los ID's de los registros de impacto y probabilidad asociados
        echo "<br>id_proceso: $id_proceso";
        echo "<br>año: $año";
        $id_calificacion_impacto = $this->calificacion_model->getIdCalificacion($id_proceso, 1, $año);
        $id_calificacion_probabilidad = $this->calificacion_model->getIdCalificacion($id_proceso, 2, $año);
        echo "<br>ID Impacto: $id_calificacion_impacto";
        echo "<br>ID Probabilidad: $id_calificacion_probabilidad";

        //Obtener los rangos de los registros de impacto y PROBABILIDAD
        $rango_impacto = $this->calificacion_model->getRango($id_calificacion_impacto);
        $rango_probabilidad = $this->calificacion_model->getRango($id_calificacion_probabilidad);
        echo "<br>rango_impacto: $rango_impacto";
        echo "<br>rango_probabilidad: $rango_probabilidad";

        //Calcular el nivel de exposicion
        $nivel_exposicion = $this->nivel_exposicion_model->getIDNivelExposicion($rango_impacto, $rango_probabilidad);
        echo "<br>nivel_exposicion: " ;
        echo "<pre>";
        print_r($nivel_exposicion);
        echo "</pre>";
        //echo "<br>id_nivel_exposicion: ". $nivel_exposicion;

        //ALTA DE REGISTRO NIVEL_EXPOSICION_PROCESO
          $parametros = array(
            'id_proceso' => $id_proceso,
            'año' => $año,
            'id_calificacion_probabilidad' => $id_calificacion_probabilidad,
            'id_calificacion_impacto' => $id_calificacion_impacto,
            'id_nivel_exposicion' => $nivel_exposicion[0]['id_nivel_exposicion']
          );
          $respuesta = $this->nivel_exposicion_proceso_model->addNivelExposicionProceso($parametros);
          if ($respuesta) {
            $mensaje = "La calificacion se cargo correctamente." ;
            $clase = "success";
            $this->session->set_flashdata('mensaje', $mensaje);
            $this->session->set_flashdata('clase', $clase);
            redirect(base_url()."calificacion/historial/$id_proceso");
          }
      }//IF impacto y probabilidad creadas
      else{
        $mensaje = "La calificacion se cargo correctamente." ;
        $clase = "success";
        $this->session->set_flashdata('mensaje', $mensaje);
        $this->session->set_flashdata('clase', $clase);
        redirect(base_url()."calificacion/historial/$id_proceso");
      }
    }//else no existe la calificacion a crearse
}//function add_calificacion


    //Historial de calificaciones de un proceso. Listado año por año
    public function historial($id_proceso){
      $this->load->view('layout/header');
      $proceso = $this->proceso_model->getProceso($id_proceso);
      $data['titulo'] = "Calificaciones Asociadas al Proceso: " . $proceso['nombre'];
      $this->load->view('layout/menu', $data);
      $data['calificaciones'] = $this->calificacion_model->getAllCalificacion($id_proceso);
      $data['proceso'] = $proceso;
      $this->load->view('calificacion/historial', $data);
      $this->load->view('layout/footer');
    }

}// clase
