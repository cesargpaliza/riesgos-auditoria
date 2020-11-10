<br>
<h4 class="text-center"><i class="fas fa-sitemap"></i> Impacto</h4>
<hr>

<?php if ($tiene_impacto == 0): ?>
  <h5 class="text-center font-weight-light">El Proceso solicitado no tiene cargados los valores para calcular el Impacto.</h5>
  <div class="col col-md-12 text-center p-2">
    <a href="<?php echo base_url(); ?>calificacion/alta/<?=$proceso['id_proceso'];?>/1" class="btn btn-primary btn-sm">+ Cargar Valores</a>
  </div>
<?php else: ?>
  <h5>Total: <?= $total_impacto[0]['total'] ?> - Rango: <?= $rango_impacto; ?> </h5>
  <h5>Detalle: </h5> <br>
  <div class="container">
    <table class="table table-sm table-bordered">
      <thead class="thead-light">
        <tr>
          <th style="width: 70%">Descripcion</th>
          <th style="width: 10%">Valor</th>
          <th style="width: 10%">Ponderacion</th>
          <th style="width: 10%">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($detalle_impacto as $detalle): ?>
          <tr>
            <td><?= $detalle['descripcion']; ?></td>
            <td><?= $detalle['valor']; ?></td>
            <td><?= $detalle['ponderacion']; ?></td>
            <td><?= $detalle['subtotal']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>



<br><br>

<h4 class="text-center"><i class="fas fa-percentage"></i> Probabilidad</h4>
<hr>
<?php if ($tiene_probabilidad == 0): ?>
  <h5 class="text-center font-weight-light">El Proceso solicitado no tiene cargados los valores para calcular la Probabilidad.</h5>
  <div class="col col-md-12 text-center p-2">
    <a href="<?php echo base_url(); ?>calificacion/alta/<?=$proceso['id_proceso'];?>/2" class="btn btn-primary btn-sm">+ Cargar Valores</a>
  </div>
<?php else: ?>
  <div class="container">
    <h5>Total: <?= $total_probabilidad[0]['total']?> - Rango: <?= $rango_probabilidad; ?> </h5>
    <h5>Detalle: </h5> <br>
    <table class="table table-sm table-bordered">
      <thead class="thead-light">
        <tr>
          <th style="width: 70%">Descripcion</th>
          <th style="width: 10%">Valor</th>
          <th style="width: 10%">Ponderacion</th>
          <th style="width: 10%">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($detalle_probabilidad as $detalle): ?>
          <tr>
            <td><?= $detalle['descripcion']; ?></td>
            <td><?= $detalle['valor']; ?></td>
            <td><?= $detalle['ponderacion']; ?></td>
            <td><?= $detalle['subtotal']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>


  </div>
<?php endif; ?>


<br>
<h4 class="text-center"><i class="fas fa-th"></i> Matriz de Exposición</h4>
<hr>
<?php if ($tiene_impacto != 0 && $tiene_probabilidad != 0): ?>
<div class="row">
  <div class="col-md-8">
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
        <tr>
          <?php $simbolo="<i class='far fa-hand-point-down'></i>"; ?>
          <th scope="row">4</td>
            <td class="amarillo"><?php if ($rango_impacto == 1 && $rango_probabilidad == 4){echo $simbolo; }?> </td>
            <td class="naranja"> <?php if ($rango_impacto == 2 && $rango_probabilidad == 4){echo $simbolo; }?> </td>
            <td class="rojo">    <?php if ($rango_impacto == 3 && $rango_probabilidad == 4){echo $simbolo; }?> </td>
            <td class="rojo">    <?php if ($rango_impacto == 4 && $rango_probabilidad == 4){echo $simbolo; }?> </td>
          </tr>
          <tr>
            <th scope="row">3</td>
              <td class="verde">    <?php if ($rango_impacto == 1 && $rango_probabilidad == 3){echo $simbolo; }?> </td>
              <td class="amarillo"> <?php if ($rango_impacto == 2 && $rango_probabilidad == 3){echo $simbolo; }?> </td>
              <td class="naranja">  <?php if ($rango_impacto == 3 && $rango_probabilidad == 3){echo $simbolo; }?> </td>
              <td class="rojo">     <?php if ($rango_impacto == 4 && $rango_probabilidad == 3){echo $simbolo; }?> </td>
            </tr>
            <tr>
              <th scope="row ">2</td>
                <td class="verde">    <?php if ($rango_impacto == 1 && $rango_probabilidad == 2){echo $simbolo; }?> </td>
                <td class="verde">    <?php if ($rango_impacto == 2 && $rango_probabilidad == 2){echo $simbolo; }?> </td>
                <td class="amarillo"> <?php if ($rango_impacto == 3 && $rango_probabilidad == 2){echo $simbolo; }?> </td>
                <td class="naranja">  <?php if ($rango_impacto == 4 && $rango_probabilidad == 2){echo $simbolo; }?> </td>
              </tr>
              <tr>
                <th scope="row">1</td>
                  <td class="verde">   <?php if ($rango_impacto == 1 && $rango_probabilidad == 1){echo $simbolo; }?> </td>
                  <td class="verde">   <?php if ($rango_impacto == 2 && $rango_probabilidad == 1){echo $simbolo; }?> </td>
                  <td class="verde">   <?php if ($rango_impacto == 3 && $rango_probabilidad == 1){echo $simbolo; }?> </td>
                  <td class="amarillo"><?php if ($rango_impacto == 4 && $rango_probabilidad == 1){echo $simbolo; }?> </td>
                </tr>

              </tbody>
            </table>

          </div>

          <div class="col-md-4">
            <h6>Referencias:</h6>
            <h5><span class="badge badge-warning verde">Poco significativo</span></h5>
            <h5><span class="badge badge-warning amarillo">Riesgo Medio</span></h5>
            <h5><span class="badge badge-warning naranja">Riesgo Considerable</span></h5>
            <h5><span class="badge badge-warning rojo">Riesgo Significativo</span></h5>
          </div>
</div>
<hr>
<div class="col col-md-12 text-center p-2">
  <a href="<?php echo base_url(); ?>calificacion/historial/<?=$proceso['id_proceso'];?>/1" class="btn btn-dark ">Atrás</a>
  <a href="<?php echo base_url(); ?>reporte/detalle_proceso/<?=$proceso['id_proceso'];?>/<?= $calificacion[0]['año'] ?>" class="btn btn-success ">Generar Reporte</a>
</div>

<?php endif; ?>





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
