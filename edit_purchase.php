<?php
	$page_title='Editar compra';
	require_once('includes/load.php');
	page_require_level(3);
?>
<?php
	$purchase=find_by_id('purchases',(int)$_GET['id']);
	if(!$purchase){
		$session->msg("d","ID producto desconocido.");
		redirect('sales.php');
	}
?>
<?php $product=find_by_id('products',$purchase['product_id']); ?>
<?php
	if(isset($_POST['update_purchase'])){
		$req_fields=array('title','quantity','price','total','date','supplier');
		validate_fields($req_fields);
        if(empty($errors)){
			$p_id=$db->escape((int)$product['id']);
			$s_qty=$db->escape((int)$_POST['quantity']);
			$s_price=$db->escape($_POST['price']);
			$s_total=$db->escape($_POST['total']);
			$date=$db->escape($_POST['date']);
			$s_supplier=$db->escape($_POST['supplier']);
			$s_date=date("Y-m-d",strtotime($date));
			$sql="UPDATE purchases SET";
			$sql.=" product_id='{$p_id}',qty={$s_qty},price='{$s_price}',total='{$s_total}',date='{$s_date}',supplier='{$s_supplier}'";
			$sql.=" WHERE id='{$purchase['id']}'";
			$result=$db->query($sql);
			if($result&&$db->affected_rows()===1){
                update_product_qty_purchase($s_qty,$p_id);
                $session->msg('s',"Compra actualizada.");
                redirect('edit_purchase.php?id='.$purchase['id'],false);
            }else{
                $session->msg('d','Compra no actualizada.');
                redirect('purchases.php',false);
            }
        }else{
            $session->msg("d",$errors);
            redirect('edit_purchase.php?id='.(int)$purchase['id'],false);
        }
    }
?>
<?php include_once('layouts/header.php'); ?>
<center><img src="libs/images/logo.jpg" alt="logo"></center><br>
<div class="row">
	<div class="col-md-6">
		<?php echo display_msg($msg); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading clearfix">
				<strong>
					<span class="glyphicon glyphicon-th"></span>
					<span>Todas las compras</span>
				</strong>
				<div class="pull-right">
					<a href="purchases.php" class="btn btn-primary">Mostrar todas las compras</a>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<thead>
						<th>Producto</th>
						<th>Cantidad</th>
						<th>Precio (€)</th>
						<th>Total (€)</th>
						<th>Fecha</th>
						<th>Proveedor</th>
						<th>Acciones</th>
					</thead>
					<tbody  id="product_info">
						<tr>
							<form method="post" action="edit_purchase.php?id=<?php echo (int)$purchase['id']; ?>">
								<td id="s_name">
									<input type="text" class="form-control" id="sug_input" name="title" value="<?php echo remove_junk($product['name']); ?>">
									<div id="result" class="list-group"></div>
								</td>
								<td id="s_qty">
									<input type="text" class="form-control" name="quantity" value="<?php echo (int)$purchase['qty']; ?>">
								</td>
								<td id="s_price">
									<input type="text" class="form-control" name="price" value="<?php echo remove_junk($product['buy_price']); ?>" >
								</td>
								<td>
									<input type="text" class="form-control" name="total" value="<?php echo remove_junk($purchase['price']); ?>">
								</td>
								<td id="s_date">
									<input type="date" class="form-control datepicker" name="date" data-date-format="" value="<?php echo remove_junk($purchase['date']); ?>">
								</td>
								<td>
									<input type="text" class="form-control" name="supplier" value="<?php echo remove_junk($purchase['supplier']); ?>">
								</td>
								<td>
									<button type="submit" name="update_purchase" class="btn btn-danger">Actualizar compra</button>
								</td>
							</form>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php include_once('layouts/footer.php'); ?>