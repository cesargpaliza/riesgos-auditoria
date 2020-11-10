<style media="screen">

  .rojo{
    background-color: rgba(231,76,60, 0.5);
  }
  .naranja{
    background-color: rgba(230,126,34, 0.5);
  }
  .verde{
    background-color: rgba(39,174,96, 0.5);
  }
  .amarillo{
    background-color: rgba(241,196,15, 0.5);
  }
</style>
<div class="form-group row ">
  <label class="col-sm-3 col-form-label text-right h5">Visualizar procesos del año: </label>
  <div class="col-sm-3">
    <select class="form-control" id="select_año">
      <?php foreach ($años as $a): ?>
        <option value="<?=$a['año']?>" <?php if ($año == $a['año']){echo "selected";}?>><?=$a['año']?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-sm-3">
    <a href="<?php echo base_url(); ?>reporte/index/<?= $año?>" class="btn btn-primary" id="detalle_proceso">
      <i class="fas fa-share"></i>
    </a>
  </div>
</div>
<hr>
<div class="form-group row ">
  <h5 class="col-sm-3 col-form-label text-right">Matriz de Exposicion: </h5>
  <div class="col-sm-3">
    <a href="<?php echo base_url(); ?>reporte/matriz_exposicion/<?= $año?>" class="btn btn-primary" id="matriz_exposicion">
      <i class="fas fa-file-alt"></i> Generar Reporte
    </a>
  </div>
</div>
<div class="form-group row ">
  <label class="col-sm-3 col-form-label text-right h5">Listado de Procesos: </label>
  <div class="col-sm-3">
    <a href="<?php echo base_url(); ?>reporte/listado_procesos/<?= $año?>"  class="btn btn-primary" id="listado_procesos">
      <i class="fas fa-file-alt"></i> Generar Reporte
    </a>
  </div>
</div>
<hr>

<h5>Detalle de calificaciones de procesos</h5>


<table class="table table-sm">
  <thead class="thead-light ">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Objetivo</th>
      <th scope="col">Responsable</th>
      <th scope="col">Nivel de exposición</th>
      <th scope="col">Gestión</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach ($procesos as $p): ?>
      <tr style="background-color: rgba(<?= $p['color'] ?>)">
        <td scope="row"><?= $p['nombre'] ?></td>
        <td><?=$p['objetivo'] ?></td>
        <td><?=$p['responsable']?></td>
        <td><h5><span class="badge badge-warning <?= $p['color'] ?>"><?=$p['nivel_exposicion'] ?></span></h5></td>
        <td scope="row">
          <a href="<?php echo base_url(); ?>reporte/detalle_proceso/<?=$p['id_proceso'] ?>/<?= $año  ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Generar Reporte" ><i class="fas fa-file-alt"></i> </a>
        </td>
      </tr>
    <?php endforeach; ?>

  </tbody>
</table>
<hr>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
  $('#select_año').change(function () {
    var link = "<?php echo base_url(); ?>reporte/index/" + $(this).val();
    $('#detalle_proceso').attr("href", link);
  })

</script>
