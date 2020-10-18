<?php
	$page_title='Lista de productos';
	require_once('includes/load.php');
	page_require_level(2);
	$products=join_product_table();
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
						<a href="add_product.php" class="btn btn-primary">Agregar producto</a>
					</div>
				</div>
				<div class="panel-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="text-center" style="width: 50px;">#</th>
								<th class="text-center">Imagen</th>
								<th class="text-center">Descripción</th>
								<th class="text-center" style="width: 10%;">Categoría</th>
								<th class="text-center" style="width: 10%;">Stock</th>
								<th class="text-center" style="width: 10%;">Precio de compra (€)</th>
								<th class="text-center" style="width: 10%;">Precio de venta (€)</th>
								<th class="text-center" style="width: 10%;">Agregado</th>
								<th class="text-center" style="width: 10%;">Proveedor</th>
								<th class="text-center" style="width: 100px;">Acciones</th>
							</tr>
						</thead>
					<tbody>
						<?php foreach ($products as $product): ?>
						<tr>
							<td class="text-center"><?php echo count_id(); ?></td>
							<td class="text-center">
								<?php if($product['media_id']==='0'): ?>
									<img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
								<?php else: ?>
									<img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
								<?php endif; ?>
							</td>
							<td class="text-center"> <?php echo remove_junk($product['name']); ?></td>
							<td class="text-center"><?php echo remove_junk($product['categorie']); ?></td>
							<td class="text-center"><?php echo remove_junk($product['quantity']); ?></td>
							<td class="text-center"><?php echo remove_junk($product['buy_price']); ?></td>
							<td class="text-center"><?php echo remove_junk($product['sale_price']); ?></td>
							<td class="text-center"><?php echo read_date($product['date']); ?></td>
							<td class="text-center"><?php echo remove_junk($product['id_supplier']); ?></td>
							<td class="text-center">
								<div class="btn-group">
									<a href="edit_product.php?id=<?php echo (int)$product['id']; ?>" style="margin-right:5px;" class="btn btn-info btn-xs" title="Editar" data-toggle="tooltip">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a onclick="javascript:return confirm('¿Confirmar Eliminación?');" href="delete_product.php?id=<?php echo (int)$product['id']; ?>" style="margin-left:5px;" class="btn btn-danger btn-xs" title="Eliminar" data-toggle="tooltip">
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