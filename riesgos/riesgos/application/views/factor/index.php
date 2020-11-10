<a href="<?php echo base_url(); ?>factor/alta" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i> Nuevo Factor</a><br><br>

<table class="table table-sm">
  <thead class="thead-light">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Tipo</th>
      <th scope="col">Descripción</th>
      <th scope="col">Ponderación</th>
      <th scope="col">Gestión</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($factores as $factor): ?>
      <tr>
        <td scope="row"><?= $factor['id_factor'] ?></td>
        <td><?=$factor['nombre'] ?></td>
        <td><?=$factor['descripcion']?></td>
        <td><?=$factor['ponderacion'] ?></td>
        <td scope="row">
          <a href="<?php echo base_url(); ?>factor/modificar/<?=$factor['id_factor'] ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-sync"></i> Modificar</a>
          <a href="<?php echo base_url(); ?>valor_factor/index_factor/<?=$factor['id_factor'] ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-list-ol"></i> Valores</a>
        </td>
      </tr>
    <?php endforeach; ?>

  </tbody>
</table>
