<h5 class="font-weight-light"><b>Descripcion de Factor: </b> <?= $factor['descripcion'] ?></h5><br>

<div class="col-10 offset-1">
<form action="<?= base_url(); ?>valor_factor/update_valor_factor/<?= $valor_factor['id_valor_factor'] ?>" method="post">

  <div class="form-group row">
    <label class="col-4 col-form-label">Valor</label>
    <div class="col-8">
      <select class="form-control" name="valor">
        <option value="1" <?php if ($valor_factor['valor']==='1'){ echo "selected"; } ?>>1</option>
        <option value="2" <?php if ($valor_factor['valor']==='2'){ echo "selected"; } ?>>2</option>
        <option value="3" <?php if ($valor_factor['valor']==='3'){ echo "selected"; } ?>>3</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-4 col-form-label">Descripcion</label>
    <div class="col-8">
      <input type="text" class="form-control" name="descripcion" value="<?= $valor_factor['descripcion'] ?>">
    </div>
  </div>

  <div class="form-group row">
    <div class="col-12">
      <input type="submit" name="" value="Confirmar Modificación" class="btn btn-primary pull-right">
    </div>
  </div>

</form>
</div>
