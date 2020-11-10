<a href="<?php echo base_url(); ?>proceso/alta" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i> Nuevo Proceso</a><br><br>

<table class="table table-sm">
  <thead class="thead-light">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Objetivo</th>
      <th scope="col">Responsable</th>
      <th scope="col">Gestión</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($procesos as $proceso): ?>
      <tr class="">
        <td scope="row"><?=$proceso['id_proceso']?></td>
        <td scope="row"><?=$proceso['nombre']?></td>
        <td scope="row"><?=$proceso['objetivo']?></td>
        <td scope="row"><?=$proceso['responsable']?></td>
        <td scope="row">
          <a href="<?php echo base_url();?>calificacion/historial/<?=$proceso['id_proceso']?>" class="btn btn-primary btn-sm"    data-toggle="tooltip" data-placement="top" title="Ver Historial de Calificaciones" ><i class="fas fa-chart-line"></i> </a>
        </td>
      </tr>
    <?php endforeach; ?>

  </tbody>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
