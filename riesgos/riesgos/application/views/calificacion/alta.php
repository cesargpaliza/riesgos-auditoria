

<form action="<?= base_url(); ?>calificacion/add_calificacion/<?= $proceso['id_proceso'] ?>/<?= $factores[0]['id_tipo_calificacion'] ?>" method="post">
    <div class="form-group row">
      <label class="col-sm-5 col-form-label text-right">Año</label>
      <div class="col-sm-5">
        <input type="number" name="año" value="2018" class="form-control" min="1" max="2018" maxlength="4" required>
      </div>
    </div>

  <?php foreach ($factores as $factor): ?>
    <div class="form-group row">
      <label class="col-sm-5 col-form-label text-right"><?= $factor['descripcion']  ?></label>
      <div class="col-sm-5">
        <select class="form-control text-right" name="<?= $factor['id_factor']  ?>">
          <?php foreach ($valores as $valor): ?>
            <?php if ($factor['id_factor'] == $valor['id_factor']): ?>
              <option value="<?= $valor['id_valor_factor'] ?>"><?= $valor['valor']." - ". $valor['descripcion']  ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  <?php endforeach; ?>


  <div class="form-group row">
    <div class="col-sm-10">
      <input type="submit" name="" value="Confirmar Alta" class="btn btn-primary pull-right">
    </div>
  </div>

</form>
