<?php
	$page_title='Panel de Control';
	require_once('includes/load.php');
	page_require_level(1);
?>
<?php
	$c_categorie=count_by_id('categories');
	$c_product=count_by_id('products');
	$c_employee=count_by_id('employees');
	$c_user=count_by_id('users');
	$suppliers=find_all_supplier();
	$clients=find_all_client();
	$products_sold=find_higest_saleing_product('10');
	$recent_products=find_recent_product_added('5');
	$recent_sales=find_recent_sale_added('5');
	$recent_purchases=find_recent_purchase_added('5');
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
	<div class="col-md-6">
		<?php echo display_msg($msg); ?>
	</div>
</div>
<center><img src="libs/images/logo.jpg" alt="logo"></center><br>
<div class="row">
	<div class="col-md-3">
		<div class="panel panel-box clearfix">
			<a href="users.php">
				<div class="panel-icon pull-left bg-green">
					<i class="glyphicon glyphicon-user"></i>
				</div>
				<div class="panel-value pull-right">
					<h2 class="margin-top"><?php echo $c_user['total']; ?></h2>
					<p class="text-muted">Usuarios</p>
				</div>
			</a>
		</div>
    </div>
    <div class="col-md-3">
		<div class="panel panel-box clearfix">
			<a href="categorie.php">
				<div class="panel-icon pull-left bg-red">
					<i class="glyphicon glyphicon-list"></i>
				</div>
				<div class="panel-value pull-right">
					<h2 class="margin-top"><?php echo $c_categorie['total']; ?></h2>
					<p class="text-muted">Categorías</p>
				</div>
			</a>
		</div>
    </div>
    <div class="col-md-3">
		<div class="panel panel-box clearfix">
			<a href="product.php">
				<div class="panel-icon pull-left bg-blue">
					<i class="glyphicon glyphicon-shopping-cart"></i>
				</div>
				<div class="panel-value pull-right">
					<h2 class="margin-top"><?php echo $c_product['total']; ?></h2>
					<p class="text-muted">Productos</p>
				</div>
			</a>
		</div>
    </div>
    <div class="col-md-3">
		<div class="panel panel-box clearfix">
			<a href="employees.php">
				<div class="panel-icon pull-left bg-yellow">
					<i class="glyphicon glyphicon-wrench"></i>
				</div>
				<div class="panel-value pull-right">
					<h2 class="margin-top"><?php  echo $c_employee['total']; ?></h2>
					<p class="text-muted">Empleados</p>
				</div>
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>
					<span class="glyphicon glyphicon-th"></span>
					<span>ÚLTIMAS VENTAS</span>
				</strong>
			</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered table-condensed">
					<thead>
						<tr>
							<th class="text-center" style="width: 50px;">#</th>
							<th>Producto</th>
							<th>Fecha</th>
							<th>Venta total</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($recent_sales as $recent_sale): ?>
						<tr>
							<td class="text-center"><?php echo count_id();?></td>
							<td>
								<a href="edit_sale.php?id=<?php echo (int)$recent_sale['id']; ?>">
								<?php echo remove_junk(first_character($recent_sale['name'])); ?></a>
							</td>
							<td><?php echo remove_junk(ucfirst($recent_sale['date'])); ?></td>
							<td><?php echo remove_junk(first_character($recent_sale['price'])); ?> €</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>
					<span class="glyphicon glyphicon-th"></span>
					<span>Productos más vendidos</span>
				</strong>
			</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered table-condensed">
					<thead>
						<tr>
							<th>Título</th>
							<th>Total vendido</th>
							<th>Cantidad total</th>
						<tr>
					</thead>
					<tbody>
						<?php foreach ($products_sold as  $product_sold): ?>
						<tr>
							<td><?php echo remove_junk(first_character($product_sold['name'])); ?></td>
							<td><?php echo (int)$product_sold['totalSold']; ?></td>
							<td><?php echo (int)$product_sold['totalQty']; ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>
					<span class="glyphicon glyphicon-th"></span>
					<span><a href="suppliers.php">Proveedores</a></span>
				</strong>
			</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered table-condensed">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Población</th>
							<th>Teléfono</th>
							<th>Descripción</th>
						<tr>
					</thead>
					<tbody>
						<?php foreach ($suppliers as $supplier): ?>
						<tr>
							<td><?php echo remove_junk($supplier['nombre']); ?></td>
							<td><?php echo remove_junk($supplier['poblacion']); ?></td>
							<td><?php echo remove_junk($supplier['telefono']); ?></td>
							<td><?php echo remove_junk($supplier['descripcion']); ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>
					<span class="glyphicon glyphicon-th"></span>
					<span>ÚLTIMAS COMPRAS</span>
				</strong>
			</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered table-condensed">
					<thead>
						<tr>
							<th class="text-center" style="width: 50px;">#</th>
							<th>Producto</th>
							<th>Fecha</th>
							<th>Compra total</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($recent_purchases as $recent_purchase): ?>
						<tr>
							<td class="text-center"><?php echo count_id();?></td>
							<td>
								<a href="edit_purchase.php?id=<?php echo (int)$recent_purchase['id']; ?>">
								<?php echo remove_junk(first_character($recent_purchase['name'])); ?></a>
							</td>
							<td><?php echo remove_junk(ucfirst($recent_purchase['date'])); ?></td>
							<td><?php echo remove_junk(first_character($recent_purchase['price'])); ?> €</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>
					<span class="glyphicon glyphicon-th"></span>
					<span>Productos recientemente añadidos</span>
				</strong>
			</div>
			<div class="panel-body">
				<div class="list-group">
					<?php foreach ($recent_products as $recent_product): ?>
					<a class="list-group-item clearfix" href="edit_product.php?id=<?php echo (int)$recent_product['id']; ?>">
						<h4 class="list-group-item-heading">
							<?php if($recent_product['media_id']==='0'): ?>
							<img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
							<?php else: ?>
							<img class="img-avatar img-circle" src="uploads/products/<?php echo $recent_product['image']; ?>" alt=""/>
							<?php endif; ?>
							<?php echo remove_junk(first_character($recent_product['name'])); ?>
							<span class="label label-warning pull-right">
								<?php echo (int)$recent_product['sale_price']; ?> €
							</span>
						</h4>
						<span class="list-group-item-text pull-left">&ensp;
							<?php echo remove_junk(first_character($recent_product['categorie'])); ?>
						</span>
					</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>
					<span class="glyphicon glyphicon-th"></span>
					<span><a href="clients.php">Clientes</a></span>
				</strong>
			</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered table-condensed">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Población</th>
							<th>Teléfono</th>
							<th>Descripción</th>
						<tr>
					</thead>
					<tbody>
						<?php foreach ($clients as $client): ?>
						<tr>
							<td><?php echo remove_junk($client['nombre']); ?></td>
							<td><?php echo remove_junk($client['poblacion']); ?></td>
							<td><?php echo remove_junk($client['telefono']); ?></td>
							<td><?php echo remove_junk($client['descripcion']); ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php include_once('layouts/footer.php'); ?>