<div class="">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><i class="fas fa-thumbs-up"></i> Gestión de Riesgos en Auditoría</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url()?>inicio"><i class="fas fa-home"></i> Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url()?>proceso"><i class="fas fa-project-diagram"></i> Procesos</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="<?= base_url()?>factor"><i class="fas fa-cog"></i> Factores </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="<?= base_url()?>matriz_exposicion/index/2018"><i class="fas fa-th"></i> Matriz de Exposición </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="<?= base_url()?>reporte/index/2018"><i class="fas fa-file-alt"></i> Reportes</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <button class="btn btn-outline-primary btn-sm" type="submit"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
    </form>
  </div>
</nav>
</div>


  <main role="main" class="container" style="padding:40px">
  <h3><?php if(isset($titulo)){ echo $titulo;}else{echo "";}?></h3>

  <?php if ($this->session->flashdata('mensaje')) {?>
      <div class="alert alert-<?php echo $this->session->flashdata('clase');?> alert-dismissible fade show" role="alert">
      <strong>Atención: </strong> <?php echo $this->session->flashdata('mensaje');?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php } ?>
