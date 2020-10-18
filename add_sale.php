<?php
	$page_title='Agregar venta';
	require_once('includes/load.php');
	page_require_level(3);
?>
<?php
	if(isset($_POST['add_sale'])){
		$req_fields=array('s_id','quantity','price','total','date','client');
		validate_fields($req_fields);
		if(empty($errors)){
			$p_id=$db->escape((int)$_POST['s_id']);
			$s_qty=$db->escape((int)$_POST['quantity']);
			$s_price=$db->escape($_POST['price']);
			$s_total=$db->escape($_POST['total']);
			$date=$db->escape($_POST['date']);
			$s_client=$db->escape((int)$_POST['client']);
			$s_date=make_date();
			$sql="INSERT INTO sales (";
			$sql.="product_id,qty,price,total,date,client";
			$sql.=") VALUES (";
			$sql.="'{$p_id}','{$s_qty}','{$s_price}','{$s_total}','{$s_date}','{$s_client}'";
			$sql.=")";
			if($db->query($sql)){
				update_product_qty_sale($s_qty,$p_id);
				$session->msg('s',"Venta agregada.");
				redirect('add_sale.php',false);
            }else{
				$session->msg('d','Venta no agregada.');
				redirect('add_sale.php',false);
            }
        }else{
			$session->msg("d",$errors);
			redirect('add_sale.php',false);
        }
	}
	if(isset($_POST['back'])){
		header("Location: sales.php");
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
					<span>Agregar venta</span>
				</strong>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<form method="post" action="add_sale.php" class="clearfix">
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
									<input type="number" class="form-control" name="cliente" placeholder="Cliente">
								</div>
							</div>
						</div>
						<button type="submit" name="add_sale" class="btn btn-danger" style="margin-left:100px">Agregar venta</button>
						<button type="submit" name="back" class="btn btn-primary" style="margin-left:400px">Volver atras</button>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>