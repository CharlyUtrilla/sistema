<?php
	$page_title='Lista de tiendas';
	require_once('includes/load.php');
	page_require_level(1);
?>
<?php
	$shops=find_all_shop();
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
					<span>Todas las tiendas</span>
				</strong>
				<div class="pull-right">
					<a href="add_shop.php" class="btn btn-primary">Agregar tienda</a>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center" style="width: 50px;">#</th>
							<th class="text-center">Direccion</th>
							<th class="text-center" style="width: 10%;">Código Postal</th>
							<th class="text-center" style="width: 10%;">Población</th>
							<th class="text-center" style="width: 10%;">Empleado</th>
							<th class="text-center" style="width: 10%;">Metros Cuadrados</th>
							<th class="text-center" style="width: 10%;">Alquiler</th>
							<th class="text-center" style="width: 10%;">Fecha de Adquisición</th>
							<th class="text-center" style="width: 100px;">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($shops as $shop): ?>
						<tr>
							<td class="text-center"><?php echo count_id(); ?></td>
							<td class="text-center"><?php echo remove_junk($shop['direccion']); ?></td>
							<td class="text-center"><?php echo remove_junk($shop['cod_postal']); ?></td>
							<td class="text-center"><?php echo remove_junk($shop['poblacion']); ?></td>
							<td class="text-center"><?php echo remove_junk($shop['empleado']); ?></td>
							<td class="text-center"><?php echo remove_junk($shop['metros_cuadrados']); ?></td>
							<td class="text-center"><?php echo remove_junk($shop['alquiler']); ?></td>
							<td class="text-center"><?php echo read_date($shop['adquisicion']); ?></td>
							<td class="text-center">
								<div class="btn-group">
									<a href="edit_shop.php?id=<?php echo (int)$shop['id']; ?>" style="margin-right:5px;" class="btn btn-warning btn-xs" title="Edit" data-toggle="tooltip">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a onclick="javascript:return confirm('¿Confirmar Eliminación?');" href="delete_shop.php?id=<?php echo (int)$shop['id']; ?>" style="margin-left:5px;" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
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