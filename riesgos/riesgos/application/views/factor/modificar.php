<form action="<?= base_url(); ?>factor/update_factor/<?= $factor['id_factor'] ?>" method="post">

  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Descripcion</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="descripcion" value="<?= $factor['descripcion'] ?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Ponderacion</label>
    <div class="col-sm-7">
      <input type="number" step="any" class="form-control" name="ponderacion" value="<?= $factor['ponderacion'] ?>">
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10">
      <input type="submit" name="" value="Confirmar Alta" class="btn btn-primary pull-right">
    </div>
  </div>

</form>
