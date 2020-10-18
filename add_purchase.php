<?php
	$page_title='Agregar compra';
	require_once('includes/load.php');
	page_require_level(3);
?>
<?php
	if(isset($_POST['add_purchase'])){
		$req_fields=array('s_id','quantity','price','total','date','supplier');
		validate_fields($req_fields);
		if(empty($errors)){
			$p_id=$db->escape((int)$_POST['pu_id']);
			$pu_qty=$db->escape((int)$_POST['quantity']);
			$pu_price=$db->escape($_POST['price']);
			$pu_total=$db->escape($_POST['total']);
			$date=$db->escape($_POST['date']);
			$pu_supplier=$db->escape((int)$_POST['supplier']);
			$pu_date=make_date();
			$sql="INSERT INTO purchases (";
			$sql.=" product_id,qty,price,total,date,supplier";
			$sql.=") VALUES (";
			$sql.="'{$p_id}','{$pu_qty}','{$pu_price}','{$pu_total}','{$pu_date}','{$pu_supplier}'";
			$sql.=")";
			if($db->query($sql)){
				update_product_qty_purchase($s_qty,$p_id);
				$session->msg('s',"Compra agregada.");
				redirect('add_purchase.php',false);
            }else{
				$session->msg('d','Compra no agregada.');
				redirect('add_purchase.php',false);
            }
        }else{
			$session->msg("d",$errors);
			redirect('add_purchase.php',false);
        }
	}
	if(isset($_POST['back'])){
		header("Location: purchases.php");
	}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
	<center><img src="libs/images/logo.jpg" alt="logo"></center><br>
	<div class="col-md-6">
		<?php echo display_msg($msg); ?>
	</div>
</div>
<div class="row" style="margin-left:20%;">
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>
					<span class="glyphicon glyphicon-th"></span>
					<span>Agregar compra</span>
				</strong>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<form method="post" action="add_purchase.php" class="clearfix">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-gift"></i>
									</span>
									<input type="text" class="form-control" name="producto" placeholder="Producto">
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-signal"></i>
									</span>
									<input type="number" class="form-control" name="cantidad" placeholder="Cantidad">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-eur"></i>
									</span>
									<input type="number" step="0.01" class="form-control" name="precio" placeholder="Precio">
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-eur"></i>
									</span>
									<input type="number" step="0.01" class="form-control" name="total" placeholder="Total">
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
										<i class="glyphicon glyphicon-user"></i>
									</span>
									<input type="number" class="form-control" name="proveedor" placeholder="Proveedor">
								</div>
							</div>
						</div>
						<button type="submit" name="add_purchase" class="btn btn-danger" style="margin-left:100px">Agregar compra</button>
						<button type="submit" name="back" class="btn btn-primary" style="margin-left:400px">Volver atras</button>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>