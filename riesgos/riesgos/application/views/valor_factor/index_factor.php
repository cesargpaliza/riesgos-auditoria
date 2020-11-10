<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal_nuevo">
  <i class="fas fa-plus"></i> Nuevo Valor
</button><br><br>

<h5 class="font-weight-light"><b>Descripcion de Factor: </b> <?= $factor['descripcion'] ?></h5>

<table class="table table-sm w-50">
  <thead class="thead-light">
    <tr>
      <th scope="col">Valor</th>
      <th scope="col">Descipcion</th>
      <th scope="col">Gestión</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($valores as $valor): ?>
      <tr>
        <td scope="row"><?=$valor['valor']?></td>
        <td><?= $valor['descripcion'] ?></td>
        <td scope="row">
          <button  onclick="modificar(<?= $valor['id_valor_factor'] ?>)" class="btn btn-outline-primary btn-sm"><i class="fas fa-sync"></i> Modificar</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Modal NUEVO-->
<div class="modal fade" id="modal_nuevo" tabindex="-1" role="dialog" aria-labelledby="modal_nuevo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header primary bg-light">
        <h5 class="modal-title">Alta de Valor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <?= $view_alta ?>
      </div>

    </div>
  </div>
</div>


<!-- Modal MODIFICAR-->
<div class="modal fade" id="modal_modificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header primary bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Modificar Valor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" id="contenido_modal_modificar">
      </div>

    </div>
  </div>
</div>


<script type="text/javascript" src="<?php echo base_url("librerias/b4md/js/jquery-3.3.1.min.js"); ?>"></script>
<script type="text/javascript">

    function modificar(id_valor_factor){
      $('#modal_modificar').modal('show');
      $.ajax({
        method: "GET",
        url: "<?php echo base_url(); ?>valor_factor/obtener_formulario_modificar_factor/"+ id_valor_factor,
      })
        .done(function( data ) {
          $("#contenido_modal_modificar").html(data);
        });
    }


</script>
