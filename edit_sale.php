<?php
	$page_title='Editar venta';
	require_once('includes/load.php');
	page_require_level(3);
?>
<?php
	$sale=find_by_id('sales',(int)$_GET['id']);
	if(!$sale){
		$session->msg("d","ID producto desconocido.");
		redirect('sales.php');
	}
?>
<?php $product=find_by_id('products',$sale['product_id']); ?>
<?php
	if(isset($_POST['update_sale'])){
		$req_fields=array('title','quantity','price','total','date','client');
		validate_fields($req_fields);
        if(empty($errors)){
			$p_id=$db->escape((int)$product['id']);
			$s_qty=$db->escape((int)$_POST['quantity']);
			$s_price=$db->escape($_POST['price']);
			$s_total=$db->escape($_POST['total']);
			$date=$db->escape($_POST['date']);
			$s_client=$db->escape($_POST['client']);
			$s_date=date("Y-m-d",strtotime($date));
			$sql="UPDATE sales SET";
			$sql.=" product_id='{$p_id}',qty={$s_qty},price='{$s_price}',total='{$s_total}',date='{$s_date}',client='{$s_client}'";
			$sql.=" WHERE id='{$sale['id']}'";
			$result=$db->query($sql);
			if($result&&$db->affected_rows()===1){
                update_product_qty_sale($s_qty,$p_id);
                $session->msg('s',"Venta actualizada.");
                redirect('edit_sale.php?id='.$sale['id'],false);
            }else{
                $session->msg('d','Venta no actualizada.');
                redirect('sales.php',false);
            }
        }else{
            $session->msg("d",$errors);
            redirect('edit_sale.php?id='.(int)$sale['id'],false);
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
					<span>Todas las ventas</span>
				</strong>
				<div class="pull-right">
					<a href="sales.php" class="btn btn-primary">Mostrar todas las ventas</a>
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
						<th>Cliente</th>
						<th>Acciones</th>
					</thead>
					<tbody  id="product_info">
						<tr>
							<form method="post" action="edit_sale.php?id=<?php echo (int)$sale['id']; ?>">
								<td id="s_name">
									<input type="text" class="form-control" id="sug_input" name="title" value="<?php echo remove_junk($product['name']); ?>">
									<div id="result" class="list-group"></div>
								</td>
								<td id="s_qty">
									<input type="text" class="form-control" name="quantity" value="<?php echo (int)$sale['qty']; ?>">
								</td>
								<td id="s_price">
									<input type="text" class="form-control" name="price" value="<?php echo remove_junk($product['sale_price']); ?>" >
								</td>
								<td id="s_total">
									<input type="text" class="form-control" name="total" value="<?php echo remove_junk($sale['total']); ?>">
								</td>
								<td id="s_date">
									<input type="date" class="form-control datepicker" name="date" data-date-format="" value="<?php echo remove_junk($sale['date']); ?>">
								</td>
								<td id="s_client">
									<input type="text" class="form-control" name="client" value="<?php echo remove_junk($sale['client']); ?>">
								</td>
								<td>
									<button type="submit" name="update_sale" class="btn btn-danger">Actualizar venta</button>
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