
  <div class="container">
    <h5>Cargar Nuevas calificaciones de:</h5>
    <a href="<?php echo base_url();?>calificacion/alta/<?=$proceso['id_proceso']?>/1" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i> Impacto</a>
    <a href="<?php echo base_url();?>calificacion/alta/<?=$proceso['id_proceso']?>/2" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i> Probabilidad</a>
    <br><br>
    <h5>Historial de calificaciones:</h5>
    <table class="table table-sm table-bordered">
      <thead class="thead-light">
        <tr>
          <th scope="col">Tipo Calificacion</th>
          <th scope="col">Total</th>
          <th scope="col">Año</th>
          <th scope="col">Gestión</th>
        </tr>
      </thead>
      <?php foreach ($calificaciones as $calificacion): ?>
        <tr class="">
          <td scope="row"><?=$calificacion['nombre']?></td>
          <td scope="row"><?=$calificacion['total']?></td>
          <td scope="row"><?=$calificacion['año']?></td>
          <td scope="row">
            <a href="<?php echo base_url();?>calificacion/index/<?=$proceso['id_proceso']?>/<?=$calificacion['año']?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-list"></i> Detalle del Año</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div><br>
  <div class="col offset-md-2 col-md-8 ">
    <div class="card">
      <h5 class="card-header">Evolución de Calificaciones</h5>
      <div class="card-body">
        <canvas id="myChart"></canvas>
      </div>
    </div>

  </div>



  <script type="text/javascript">

  var ctx = document.getElementById('myChart').getContext('2d');
  var chart = new Chart(ctx, {
      // The type of chart we want to create
      type: 'line',

      // The data for our dataset
      data: {
          labels: [
          <?php foreach ($calificaciones as $calificacion): ?>
           <?php if ($calificacion['nombre'] == 'Impacto'): ?>
             <?=$calificacion['año']?> ,
           <?php endif; ?>
          <?php endforeach; ?>
          ],
          datasets: [
            {
              label: "Impacto",
              borderColor: 'rgb(244,67,54)',
              backgroundColor:  'rgba(244,67,54, 0)',
              data: [
                <?php foreach ($calificaciones as $calificacion): ?>
                 <?php if ($calificacion['nombre'] == 'Impacto'): ?>
                   <?=$calificacion['total']?> ,
                 <?php endif; ?>
                <?php endforeach; ?>
              ],
            },
            {
              label: "Probabilidad",
              borderColor: 'rgb(63,81,181)',
              backgroundColor:  'rgba(244,67,54, 0)',
              data: [
                <?php foreach ($calificaciones as $calificacion): ?>
                 <?php if ($calificacion['nombre'] == 'Probabilidad'): ?>
                   <?=$calificacion['total']?> ,
                 <?php endif; ?>
                <?php endforeach; ?>

              ],
            }
          ]
      },

      // Configuration options go here
      options: {
        scales: {
                yAxes:[{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            steps: 7,
                            stepValue: 0.5,
                            max: 3.5
                        }
                      }]
                }
      }
  });

  </script>
