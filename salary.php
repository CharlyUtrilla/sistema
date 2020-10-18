<?php
	$page_title='Lista de nóminas';
	require_once('includes/load.php');
	page_require_level(1);
?>
<?php
	$salarys=find_all_salary();
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
					<span>Todas las nóminas</span>
				</strong>
				<div class="pull-right">
					<a href="add_salary.php" class="btn btn-primary">Agregar nómina</a>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center" style="width: 50px;">#</th>
							<th>Empleado</th>
							<th class="text-center" style="width: 10%;">Fecha</th>
							<th class="text-center" style="width: 10%;">Horas base</th>
							<th class="text-center" style="width: 10%;">Horas extra</th>
							<th class="text-center" style="width: 10%;">Pago base</th>
							<th class="text-center" style="width: 10%;">Pago extra</th>
							<th class="text-center" style="width: 10%;">Total horas</th>
							<th class="text-center" style="width: 10%;">Total pago</th>
							<th class="text-center" style="width: 100px;">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($salarys as $salary): ?>
						<tr>
							<td class="text-center"><?php echo count_id(); ?></td>
							<td><?php echo remove_junk($salary['empleado']); ?></td>
							<td class="text-center"><?php echo read_date($salary['fecha']); ?></td>
							<td class="text-center"><?php echo remove_junk($salary['horas_base']); ?></td>
							<td class="text-center"><?php echo remove_junk($salary['horas_extra']); ?></td>
							<td class="text-center"><?php echo remove_junk($salary['pago_base']); ?></td>
							<td class="text-center"><?php echo remove_junk($salary['pago_extra']); ?></td>
							<td class="text-center"><?php echo remove_junk($salary['total_horas']); ?></td>
							<td class="text-center"><?php echo remove_junk($salary['total_pago']); ?></td>
							<td class="text-center">
								<div class="btn-group">
									<a href="edit_salary.php?id=<?php echo (int)$salary['id']; ?>" style="margin-right:5px;" class="btn btn-warning btn-xs" title="Edit" data-toggle="tooltip">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a onclick="javascript:return confirm('¿Confirmar Eliminación?');" href="delete_salary.php?id=<?php echo (int)$salary['id']; ?>" style="margin-left:5px;" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
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