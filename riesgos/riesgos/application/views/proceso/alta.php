<form action="<?php echo base_url(); ?>proceso/add_proceso" method="post">

  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Nombre</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="nombre" required>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Objetivo</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="objetivo" required>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Responsable</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="responsable" required>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Descripción</label>
    <div class="col-sm-7">
      <textarea class="form-control" rows="3" name="descripcion" required></textarea>
    </div>
  </div>


  <div class="form-group row">
    <div class="col-sm-10">
      <input type="submit" name="" value="Confirmar Alta" class="btn btn-primary pull-right">
    </div>
  </div>

</form>
