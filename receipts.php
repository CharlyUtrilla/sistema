<?php
	$page_title='Ver facturas';
	require_once('includes/load.php');
	page_require_level(2);
	$all_receipts=find_all('receipts');
?>
<?php
	if(isset($_POST['find_receipt'])){
		$req_fields=array('tipo','persona','fecha','producto');
		validate_fields($req_fields);
		if(empty($errors)){
			$r_tipo=$db->escape($_POST['tipo']);
			$r_persona=$db->escape($_POST['persona']);
			$r_fecha=$db->escape($_POST['fecha']);
			$r_producto=$db->escape($_POST['producto']);
			if($r_tipo=="compra"&&$r_persona=="cliente"){
				$session->msg('d',"La factura de compra debe ser con un proveedor.");
				redirect('receipts.php',false);
			}elseif($r_tipo=="venta"&&$r_persona=="proveedor"){
				$session->msg('d',"La factura de venta debe ser con un cliente.");
				redirect('receipts.php',false);
			}elseif($r_tipo=="compra"&&$r_persona=="proveedor"){
				$sql="SELECT * FROM purchases ";
				$sql.="WHERE date='.$r_fecha.' AND product_id='.$r_producto.'";
				$session->msg('s',"Factura encontrada.");
				redirect('receipts.php',false);
			}elseif($r_tipo=="venta"&&$r_persona=="cliente"){
				$sql="SELECT * FROM sales ";
				$sql.="WHERE date='.$r_fecha.' AND product_id='.$r_producto.'";
				$session->msg('s',"Factura encontrada.");
				redirect('receipts.php',false);
			}else{
				$session->msg('d',"Error encontrado.");
				redirect('receipts.php',false);
			}
			if($db->query($sql)){
				$session->msg('s',"Factura encontrada.");
				redirect('receipts.php',false);
			}else{
				$session->msg('d','Factura no encontrada.');
				redirect('receipts.php',false);
			}
		}else{
			$session->msg("d",$errors);
			redirect('receipts.php',false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: receipts.php");
	}
?>
<?php include_once('layouts/header.php'); ?>
<center><img src="libs/images/logo.jpg" alt="logo"></center><br>
<div class="row">
	<div class="col-md-12">
		<?php echo display_msg($msg); ?>
	</div>
</div>
<div class="row" style="margin-left:20%;">
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>
					<span class="glyphicon glyphicon-th"></span>
					<span>Buscar factura</span>
				</strong>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<form method="post" action="receipts.php" class="clearfix">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-th-large"></i>
									</span>
									<select class="form-control" name="tipo" placeholder="Tipo">
										<option value=""disabled selected>Tipo de factura</option>
										<option value="compra">Compra</option>
										<option value="venta">Venta</option>
									</select>
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-user"></i>
									</span>
									<select class="form-control" name="persona" placeholder="Persona">
										<option value=""disabled selected>Tipo de persona</option>
										<option value="compra">Proveedor</option>
										<option value="inactivo">Cliente</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
									</span>
									<input type="text" class="form-control" name="fecha" placeholder="Fecha" onfocus="(this.type='date')" onblur="(this.type='text')">
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-gift"></i>
									</span>
									<input type="number" class="form-control" name="producto" placeholder="Producto">
								</div>
							</div>
						</div>
						<button type="submit" name="find_receipt" class="btn btn-danger" style="margin-left:100px">Buscar factura</button>
						<button type="submit" name="back" class="btn btn-primary" style="margin-left:400px">Volver atras</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once('layouts/footer.php'); ?>