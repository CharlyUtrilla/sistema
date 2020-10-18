<?php
	$page_title='Inicio Administración';
	require_once('includes/load.php');
	if(!$session->isUserLoggedIn(true)){redirect('index.php',false);}
?>
<?php include_once('layouts/header.php'); ?>
<link href="libs/css/bootstrap.css" rel="stylesheet"/>
<link href="libs/css/font-awesome.css" rel="stylesheet"/>
<link href="libs/css/custom.css" rel="stylesheet"/>
<div class="row">
	<div class="col-md-12">
		<?php echo display_msg($msg); ?>
	</div>
	<div class="col-md-12">
		<div class="panel">
			<div class="jumbotron text-center">
				<img src="libs/images/logo.jpg" alt="logo"><br><br>
				<h1><b>ADMINISTRACIÓN<b></h1>
				<br><br><br>
				<div class="row text-center pad-top">
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="div-square">
							<a href="suppliers.php">
								<img src="libs/images/supplier.jpg" alt="proveedores">
								<h4>Proveedores</h4>
							</a>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="div-square">
							<a href="clients.php">
								<img src="libs/images/client.jpg" alt="clientes">
								<h4>Clientes</h4>
							</a>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="div-square">
							<a href="employees.php">
								<img src="libs/images/employee.jpg" alt="empleados">
								<h4>Empleados</h4>
							</a>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="div-square">
							<a href="users.php">
								<img src="libs/images/user.jpg" alt="usuarios">
								<h4>Usuarios</h4>
							</a>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="div-square">
							<a href="purchases.php">
								<img src="libs/images/purchase.jpg" alt="compras">
								<h4>Compras</h4>
							</a>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="div-square">
							<a href="sales.php">
								<img src="libs/images/sale.jpg" alt="ventas">
								<h4>Ventas</h4>
							</a>
						</div>
					</div>
				</div>
				<br><br><br>
				<div class="row text-center pad-top">
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="div-square">
							<a href="product.php">
								<img src="libs/images/product.jpg" alt="productos">
								<h4>Productos</h4>
							</a>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="div-square">
							<a href="cars.php">
								<img src="libs/images/car.jpg" alt="vehículos">
								<h4>Vehículos</h4>
							</a>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="div-square">
							<a href="shops.php">
								<img src="libs/images/shop.jpg" alt="tiendas">
								<h4>Tiendas</h4>
							</a>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="div-square">
							<a href="materials.php">
								<img src="libs/images/material.jpg" alt="materiales">
								<h4>Materiales</h4>
							</a>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="div-square">
							<a href="salary.php">
								<img src="libs/images/salary.jpg" alt="nominas">
								<h4>Nominas</h4>
							</a>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<div class="div-square">
							<a href="receipts.php">
								<img src="libs/images/receipt.jpg" alt="facturas">
								<h4>Facturas</h4>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once('layouts/footer.php'); ?>