<?php
	$page_title='Editar producto';
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$product=find_by_id('products',(int)$_GET['id']);
	$all_categories=find_all('categories');
	$all_photo=find_all('media');
	if(!$product){
		$session->msg("d","ID de producto perdido.");
		redirect('product.php');
	}
?>
<?php
	if(isset($_POST['product'])){
		$req_fields=array('product-title','product-categorie','product-quantity','buying-price','saleing-price','id_supplier');
		validate_fields($req_fields);
		if(empty($errors)){
			$p_name=remove_junk($db->escape($_POST['product-title']));
			$p_cat=(int)$_POST['product-categorie'];
			$p_qty=remove_junk($db->escape($_POST['product-quantity']));
			$p_buy=remove_junk($db->escape($_POST['buying-price']));
			$p_sale=remove_junk($db->escape($_POST['saleing-price']));
			$p_supplier=remove_junk($db->escape($_POST['id_supplier']));
			if(is_null($_POST['product-photo'])||$_POST['product-photo']===""){
				$media_id='0';
			}else{
				$media_id=remove_junk($db->escape($_POST['product-photo']));
			}
			$query ="UPDATE products SET";
			$query.=" name='{$p_name}',quantity='{$p_qty}',";
			$query.=" buy_price='{$p_buy}',sale_price='{$p_sale}',categorie_id='{$p_cat}',media_id='{$media_id}',id_supplier='{$p_supplier}'";
			$query.=" WHERE id='{$product['id']}'";
			$result=$db->query($query);
			if($result&&$db->affected_rows()===1){
				$session->msg('s',"El producto ha sido actualizado.");
				redirect('product.php',false);
			}else{
				$session->msg('d','Actualización fallida.');
				redirect('edit_product.php?id='.$product['id'],false);
            }
		}else{
			$session->msg("d",$errors);
			redirect('edit_product.php?id='.$product['id'],false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: product.php");
	}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
	<div class="col-md-12">
		<?php echo display_msg($msg); ?>
	</div>
</div>
<center><img src="libs/images/logo.jpg" alt="logo"></center><br>
<div class="row">
    <div class="panel panel-default">
		<div class="panel-heading">
			<strong>
				<span class="glyphicon glyphicon-th"></span>
				<span>Editar producto</span>
			</strong>
        </div>
        <div class="panel-body">
			<div class="col-md-7">
				<form method="post" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-th-large"></i>
							</span>
							<input type="text" class="form-control" name="product-title" value="<?php echo remove_junk($product['name']); ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<select class="form-control" name="product-categorie">
									<option value=""disabled>Selecciona una categoría</option>
									<?php foreach ($all_categories as $cat): ?>
									<option value="<?php echo (int)$cat['id']; ?>" <?php if($product['categorie_id']===$cat['id']): echo "selected"; endif; ?>>
									<?php echo remove_junk($cat['name']); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-md-6">
								<select class="form-control" name="product-photo">
									<option value=""disabled>Sin imagen</option>
									<?php foreach ($all_photo as $photo): ?>
									<option value="<?php echo (int)$photo['id']; ?>" <?php if($product['media_id']===$photo['id']): echo "selected"; endif; ?>>
									<?php echo $photo['file_name'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="qty">Cantidad</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-shopping-cart"></i>
										</span>
										<input type="number" class="form-control" name="product-quantity" value="<?php echo remove_junk($product['quantity']); ?>">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="qty">Precio de compra</label>
									<div class="input-group">
										<input type="number" step="0.01" class="form-control" name="buying-price" value="<?php echo remove_junk($product['buy_price']); ?>">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-eur"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="qty">Precio de venta</label>
									<div class="input-group">
										<input type="number" step="0.01" class="form-control" name="saleing-price" value="<?php echo remove_junk($product['sale_price']); ?>">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-eur"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
						</div>
						<div class="col-md-4">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-briefcase"></i>
								</span>
								<input type="number" class="form-control" name="id_supplier" value="<?php echo remove_junk($product['id_supplier']); ?>">
							</div>
						</div>
						<div class="col-md-4">
						</div>
					</div>
					<button type="submit" name="product" class="btn btn-danger" style="margin-left:200px">Actualizar</button>
					<button type="submit" name="back" class="btn btn-primary" style="margin-left:200px">Volver atras</button>
				</form>
			</div>
        </div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>