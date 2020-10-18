<?php
	$page_title='Lista de materiales';
	require_once('includes/load.php');
	page_require_level(1);
?>
<?php
	$materials=find_all_material();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
	<div class="col-md-6">
		<?php echo display_msg($msg); ?>
	</div>
</div>
<div class="row">
	<center><img src="libs/images/logo.jpg" alt="logo"></center><br>
    <div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<strong>
					<span class="glyphicon glyphicon-th"></span>
					<span>Todos los materiales</span>
				</strong>
				<div class="pull-right">
					<a href="add_material.php" class="btn btn-primary">Agregar material</a>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center" style="width: 50px;">#</th>
							<th class="text-center" style="width: 10%;">Nombre</th>
							<th>Descripción</th>
							<th class="text-center" style="width: 10%;">Cantidad</th>
							<th class="text-center" style="width: 10%;">Fecha de compra</th>
							<th class="text-center" style="width: 10%;">Precio de compra</th>
							<th class="text-center" style="width: 100px;">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($materials as $material): ?>
						<tr>
							<td class="text-center"><?php echo count_id(); ?></td>
							<td class="text-center"><?php echo remove_junk($material['nombre']); ?></td>
							<td><?php echo remove_junk($material['descripcion']); ?></td>
							<td class="text-center"><?php echo remove_junk($material['cantidad']); ?></td>
							<td class="text-center"><?php echo read_date($material['fecha_compra']); ?></td>
							<td class="text-center"><?php echo remove_junk($material['precio_compra']); ?></td>
							<td class="text-center">
								<div class="btn-group">
									<a href="edit_material.php?id=<?php echo (int)$material['id']; ?>" style="margin-right:5px;" class="btn btn-warning btn-xs" title="Edit" data-toggle="tooltip">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a onclick="javascript:return confirm('¿Confirmar Eliminación?');" href="delete_material.php?id=<?php echo (int)$material['id']; ?>" style="margin-left:5px;" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
										<span class="glyphicon glyphicon-trash"></span>
									</a>
								</div>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php include_once('layouts/footer.php'); ?>