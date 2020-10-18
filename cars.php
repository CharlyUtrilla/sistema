<?php
	$page_title='Lista de vehículos';
	require_once('includes/load.php');
	page_require_level(1);
?>
<?php
	$cars=find_all_car();
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
					<span>Todos los vehículos</span>
				</strong>
				<div class="pull-right">
					<a href="add_car.php" class="btn btn-primary">Agregar vehículo</a>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center" style="width: 50px;">#</th>
							<th>Marca y modelo</th>
							<th class="text-center" style="width: 10%;">Población</th>
							<th class="text-center" style="width: 10%;">Empleado</th>
							<th class="text-center" style="width: 10%;">Matrícula</th>
							<th class="text-center" style="width: 10%;">Estado</th>
							<th class="text-center" style="width: 10%;">Fecha de compra</th>
							<th class="text-center" style="width: 10%;">Última revisión</th>
							<th class="text-center" style="width: 100px;">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($cars as $car): ?>
						<tr>
							<td class="text-center"><?php echo count_id(); ?></td>
							<td><?php echo remove_junk($car['marca_modelo']); ?></td>
							<td class="text-center"><?php echo remove_junk($car['poblacion']); ?></td>
							<td class="text-center"><?php echo remove_junk($car['empleado']); ?></td>
							<td class="text-center"><?php echo remove_junk($car['matricula']); ?></td>
							<td class="text-center"><?php echo remove_junk($car['estado']); ?></td>
							<td class="text-center"><?php echo read_date($car['fecha_compra']); ?></td>
							<td class="text-center"><?php echo read_date($car['ultima_revision']); ?></td>
							<td class="text-center">
								<div class="btn-group">
									<a href="edit_car.php?id=<?php echo (int)$car['id']; ?>" style="margin-right:5px;" class="btn btn-warning btn-xs" title="Edit" data-toggle="tooltip">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a onclick="javascript:return confirm('¿Confirmar Eliminación?');" href="delete_car.php?id=<?php echo (int)$car['id']; ?>" style="margin-left:5px;" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
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