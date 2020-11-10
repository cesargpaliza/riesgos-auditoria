<form action="<?php echo base_url(); ?>factor/add_factor" method="post">

  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Descripcion</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="descripcion">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Ponderacion</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="ponderacion">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Tipo de Calificacion</label>
    <div class="col-sm-7">
      <select class="form-control" name="id_tipo_calificacion">
        <option value="" selected>-- Seleccione el tipo de Calificación --</option>
        <option value="1">Impacto</option>
        <option value="2">Probabilidad</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10">
      <input type="submit" name="" value="Confirmar Alta" class="btn btn-primary pull-right">
    </div>
  </div>

</form>
