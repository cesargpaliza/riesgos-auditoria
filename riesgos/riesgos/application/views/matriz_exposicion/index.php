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
    <a href="<?php echo base_url(); ?>matriz_exposicion/index/<?= $año?>" class="btn btn-primary" id="detalle_proceso">
      <i class="fas fa-share"></i>
    </a>
  </div>
</div><br>
<div class="row">
  <div class="col-md-12">
    <table class="table table-sm table-bordered text-center">
      <thead class="">
        <tr>
          <th scope="col"></th>
          <th scope="col" colspan="4">Impacto</th>
        </tr>
        <tr>
          <th style="width: 20%">Probabilidad</th>
          <th style="width: 20%">1</th>
          <th style="width: 20%">2</th>
          <th style="width: 20%">3</th>
          <th style="width: 20%">4</th>
        </tr>
      </thead>
      <tbody class="">
        <?php
          $icono = '<i class="fas fa-arrow-right fa-xs"></i> ';
          $link = "<a href=\"" . base_url() . "calificacion/index/";

        ?>
        <tr>

          <th scope="row">4</td>
            <td class="amarillo"><?php foreach ($procesos as $p){ if ($p['rango_impacto']==1 && $p['rango_probabilidad']==4){ echo $link . $p['id_proceso'] . "/" .  $año . "\">" . $icono . $p['nombre'] . "</a><br>"; }} ?> </td>
            <td class="naranja"> <?php foreach ($procesos as $p){ if ($p['rango_impacto']==2 && $p['rango_probabilidad']==4){ echo $link . $p['id_proceso'] . "/" .  $año . "\">" . $icono . $p['nombre'] . "</a><br>"; }} ?> </td>
            <td class="rojo">    <?php foreach ($procesos as $p){ if ($p['rango_impacto']==3 && $p['rango_probabilidad']==4){ echo $link . $p['id_proceso'] . "/" .  $año . "\">" . $icono . $p['nombre'] . "</a><br>"; }} ?> </td>
            <td class="rojo">    <?php foreach ($procesos as $p){ if ($p['rango_impacto']==4 && $p['rango_probabilidad']==4)
              { echo $link . $p['id_proceso'] . "/" .  $año . "\">" . $icono . $p['nombre'] . "</a><br>"; }} ?> </td>
          </tr>
          <tr>
            <th scope="row">3</td>
              <td class="verde">   <?php foreach ($procesos as $p){ if ($p['rango_impacto']==1 && $p['rango_probabilidad']==3){ echo $link . $p['id_proceso'] . "/" .  $año . "\">" . $icono . $p['nombre'] . "</a><br>"; }} ?> </td>
              <td class="amarillo"><?php foreach ($procesos as $p){ if ($p['rango_impacto']==2 && $p['rango_probabilidad']==3){ echo $link . $p['id_proceso'] . "/" .  $año . "\">" . $icono . $p['nombre'] . "</a><br>"; }} ?> </td>
              <td class="naranja"> <?php foreach ($procesos as $p){ if ($p['rango_impacto']==3 && $p['rango_probabilidad']==3){ echo $link . $p['id_proceso'] . "/" .  $año . "\">" . $icono . $p['nombre'] . "</a><br>"; }} ?> </td>
              <td class="rojo">    <?php foreach ($procesos as $p){ if ($p['rango_impacto']==4 && $p['rango_probabilidad']==3){ echo $link . $p['id_proceso'] . "/" .  $año . "\">" . $icono . $p['nombre'] . "</a><br>"; }} ?> </td>
            </tr>
            <tr>
              <th scope="row ">2</td>
                <td class="verde">    <?php foreach ($procesos as $p){ if ($p['rango_impacto']==1 && $p['rango_probabilidad']==2){ echo $link . $p['id_proceso'] . "/" .  $año . "\">" . $icono . $p['nombre'] . "</a><br>"; }} ?> </td>
                <td class="verde">    <?php foreach ($procesos as $p){ if ($p['rango_impacto']==2 && $p['rango_probabilidad']==2){ echo $link . $p['id_proceso'] . "/" .  $año . "\">" . $icono . $p['nombre'] . "</a><br>"; }} ?> </td>
                <td class="amarillo"> <?php foreach ($procesos as $p){ if ($p['rango_impacto']==3 && $p['rango_probabilidad']==2){ echo $link . $p['id_proceso'] . "/" .  $año . "\">" . $icono . $p['nombre'] . "</a><br>"; }} ?> </td>
                <td class="naranja">  <?php foreach ($procesos as $p){ if ($p['rango_impacto']==4 && $p['rango_probabilidad']==2){ echo $link . $p['id_proceso'] . "/" .  $año . "\">" . $icono . $p['nombre'] . "</a><br>"; }} ?> </td>
              </tr>
              <tr>
                <th scope="row">1</td>
                  <td class="verde">    <?php foreach ($procesos as $p){ if ($p['rango_impacto']==1 && $p['rango_probabilidad']==1){ echo $link . $p['id_proceso'] . "/" .  $año . "\">" . $icono . $p['nombre'] . "</a><br>"; }} ?> </td>
                  <td class="verde">    <?php foreach ($procesos as $p){ if ($p['rango_impacto']==2 && $p['rango_probabilidad']==1){ echo $link . $p['id_proceso'] . "/" .  $año . "\">" . $icono . $p['nombre'] . "</a><br>"; }} ?> </td>
                  <td class="verde">    <?php foreach ($procesos as $p){ if ($p['rango_impacto']==3 && $p['rango_probabilidad']==1){ echo $link . $p['id_proceso'] . "/" .  $año . "\">" . $icono . $p['nombre'] . "</a><br>"; }} ?> </td>
                  <td class="amarillo"> <?php foreach ($procesos as $p){ if ($p['rango_impacto']==4 && $p['rango_probabilidad']==1){ echo $link . $p['id_proceso'] . "/" .  $año . "\">" . $icono . $p['nombre'] . "</a><br>"; }} ?> </td>
                </tr>

              </tbody>
            </table>
          </div><!-- col-md-8 -->
</div>
<div class="row">
  <div class="col-md-4 offset-8 text-right">
    <h6>Referencias:</h6>
    <h6><span class="badge badge-warning verde">Poco significativo</span></h6>
    <h6><span class="badge badge-warning amarillo">Riesgo Medio</span></h6>
    <h6><span class="badge badge-warning naranja">Riesgo Considerable</span></h6>
    <h6><span class="badge badge-warning rojo">Riesgo Significativo</span></h6>
  </div>
</div><br>


<h5>Detalle de procesos con calificaciones</h5>
<hr>


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
          <a href="<?php echo base_url(); ?>calificacion/index/<?=$p['id_proceso'] ?>/<?= $año  ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Ver Detalle" ><i class="fas fa-list"></i> </a>
          <a href="<?php echo base_url();?>calificacion/historial/<?=$p['id_proceso']?>" class="btn btn-primary btn-sm"    data-toggle="tooltip" data-placement="top" title="Ver Historial de Calificaciones" ><i class="fas fa-chart-line"></i> </a>
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
    $('#select_año').change(function () {
      var link = "<?php echo base_url(); ?>matriz_exposicion/index/" + $(this).val();
      $('#detalle_proceso').attr("href", link);
    })

  </script>

<style media="screen">
  a, a:hover{
    color: #000;
  }

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
