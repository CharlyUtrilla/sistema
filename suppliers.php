<?php
	$page_title='Lista de proveedores';
	require_once('includes/load.php');
	page_require_level(1);
?>
<?php
	$suppliers=find_all_supplier();
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
					<span>Todos los proveedores</span>
				</strong>
				<div class="pull-right">
					<a href="add_supplier.php" class="btn btn-primary">Agregar proveedor</a>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center" style="width:50px;">#</th>
							<th>Nombre</th>
							<th class="text-center" style="width:10%;">Dirección</th>
							<th class="text-center" style="width:10%;">Población</th>
							<th class="text-center" style="width:10%;">Estado</th>
							<th class="text-center" style="width:10%;">Teléfono</th>
							<th class="text-center" style="width:10%;">Descripción</th>
							<th class="text-center" style="width:10%;">Fecha inicio</th>
							<th class="text-center" style="width:10%;">Activo</th>
							<th class="text-center" style="width:100px;">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($suppliers as $supplier): ?>
						<tr>
							<td class="text-center"><?php echo count_id(); ?></td>
							<td><?php echo remove_junk($supplier['nombre']); ?></td>
							<td class="text-center"><?php echo remove_junk($supplier['direccion']); ?></td>
							<td class="text-center"><?php echo remove_junk($supplier['poblacion']); ?></td>
							<td class="text-center"><?php echo remove_junk($supplier['estado']); ?></td>
							<td class="text-center"><?php echo remove_junk($supplier['telefono']); ?></td>
							<td class="text-center"><?php echo remove_junk($supplier['descripcion']); ?></td>
							<td class="text-center"><?php echo read_date($supplier['fecha_inicio']); ?></td>
							<td class="text-center"><?php echo remove_junk($supplier['activo']); ?></td>
							<td class="text-center">
								<div class="btn-group">
									<a href="edit_supplier.php?id=<?php echo (int)$supplier['id']; ?>" style="margin-right:5px;" class="btn btn-warning btn-xs" title="Edit" data-toggle="tooltip">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a onclick="javascript:return confirm('¿Confirmar Eliminación?');" href="delete_supplier.php?id=<?php echo (int)$supplier['id']; ?>" style="margin-left:5px;" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
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