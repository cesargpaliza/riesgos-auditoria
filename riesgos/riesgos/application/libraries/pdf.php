<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."\\third_party\\fpdf\\fpdf.php";

    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdf extends FPDF {
        public function __construct() {
            parent::__construct();
        }
        // El encabezado del PDF
        public function Header(){
            //$this->Image(base_url('recursos/img/dim_logotipo.png'),35,6,20);
            $this->SetFont('Arial','B',14);
            $this->Cell(30);
            $this->Cell(120,10,utf8_decode('Sistema de Gestión de Riesgos para la Auditoría de ISI'),0,0,'C');
            $this->Ln('5');
            $this->SetFont('Arial','B',8);
            $this->Cell(30);
            $this->Cell(120,10,utf8_decode('Universidad Tecnológica Nacional - Facultad Regional Tucumán'),0,0,'C');
            $this->Ln(10);
       }
       // El pie del pdf
       public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      }
    }
