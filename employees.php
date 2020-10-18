<?php
	$page_title='Lista de empleados';
	require_once('includes/load.php');
	page_require_level(2);
	$employees=join_employees_table();
?>
<?php include_once('layouts/header.php'); ?>
	<div class="row">
		<div class="col-md-12">
			<?php echo display_msg($msg); ?>
		</div>
		<center><img src="libs/images/logo.jpg" alt="logo"></center><br>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<div class="pull-right">
						<a href="add_employee.php" class="btn btn-primary">Agregar empleado</a>
					</div>
				</div>
				<div class="panel-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="text-center" style="width: 50px;">#</th>
								<th class="text-center">Foto</th>
								<th class="text-center">Nombre</th>
								<th class="text-center">Apellidos</th>
								<th class="text-center">DNI</th>
								<th class="text-center" style="width: 100px;">Acciones</th>
							</tr>
						</thead>
					<tbody>
						<?php foreach ($employees as $employee): ?>
						<tr>
							<td class="text-center"><?php echo count_id(); ?></td>
							<td class="text-center">
								<?php if($employee['foto']==='0'): ?>
									<img class="img-avatar img-circle" src="uploads/employees/no_image.jpg" alt="">
								<?php else: ?>
									<img class="img-avatar img-circle" src="uploads/employees/<?php echo $employee['image']; ?>" alt="">
								<?php endif; ?>
							</td>
							<td class="text-center"><?php echo remove_junk($employee['nombre']); ?></td>
							<td class="text-center"><?php echo remove_junk($employee['apellidos']); ?></td>
							<td class="text-center"><?php echo remove_junk($employee['dni']); ?></td>
							<td class="text-center">
								<div class="btn-group">
									<a href="edit_employee.php?id=<?php echo (int)$employee['id']; ?>" style="margin-right:5px;" class="btn btn-info btn-xs" title="Editar" data-toggle="tooltip">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a onclick="javascript:return confirm('¿Confirmar Eliminación?');" href="delete_employee.php?id=<?php echo (int)$employee['id']; ?>" style="margin-left:5px;" class="btn btn-danger btn-xs" title="Eliminar" data-toggle="tooltip">
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