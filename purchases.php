<?php
	$page_title='Lista de compras';
	require_once('includes/load.php');
	page_require_level(3);
	$purchases=find_all_purchase();
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
					<span>Todas las compras</span>
				</strong>
				<div class="pull-right">
					<a href="add_purchase.php" class="btn btn-primary">Agregar compra</a>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center" style="width: 50px;">#</th>
							<th>Nombre del producto</th>
							<th class="text-center" style="width: 15%;">Cantidad</th>
							<th class="text-center" style="width: 15%;">Precio</th>
							<th class="text-center" style="width: 15%;">Total</th>
							<th class="text-center" style="width: 15%;">Fecha</th>
							<th class="text-center" style="width: 15%;">Proveedor</th>
							<th class="text-center" style="width: 100px;">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($purchases as $purchase): ?>
						<tr>
							<td class="text-center"><?php echo count_id(); ?></td>
							<td><?php echo remove_junk($purchase['name']); ?></td>
							<td class="text-center"><?php echo (int)$purchase['qty']; ?></td>
							<td class="text-center"><?php echo remove_junk($purchase['price']); ?></td>
							<td class="text-center"><?php echo remove_junk($purchase['total']); ?></td>
							<td class="text-center"><?php echo $purchase['date']; ?></td>
							<td class="text-center"><?php echo $purchase['supplier']; ?></td>
							<td class="text-center">
								<div class="btn-group">
									<a href="edit_purchase.php?id=<?php echo (int)$purchase['id']; ?>" style="margin-right:5px;" class="btn btn-warning btn-xs" title="Edit" data-toggle="tooltip">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a onclick="javascript:return confirm('¿Confirmar Eliminación?');" href="delete_purchase.php?id=<?php echo (int)$purchase['id']; ?>" style="margin-left:5px;" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
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