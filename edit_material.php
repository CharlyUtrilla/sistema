<?php
	$page_title='Editar material';
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$material=find_by_id('materials',(int)$_GET['id']);
	$all_materials=find_all('materials');
	if(!$material){
		$session->msg("d","ID de material no encontrado.");
		redirect('materials.php');
	}
?>
<?php
	if(isset($_POST['material'])){
		$req_fields=array('nombre','descripcion','cantidad','fecha_compra','precio_compra');
		validate_fields($req_fields);
		if(empty($errors)){
			$m_nombre=remove_junk($db->escape($_POST['nombre']));
			$_descripcion=remove_junk($db->escape($_POST['descripcion']));
			$m_cantidad=((int)$_POST['cantidad']);
			$m_compra=remove_junk($db->escape($_POST['fecha_compra']));
			$m_precio=remove_junk($db->escape($_POST['precio_compra']));
			$query ="UPDATE materials SET";
			$query.=" nombre='{$m_nombre}',descripcion='{$m_descripcion}',cantidad='{$m_cantidad}',fecha_compra='{$m_compra}',precio_compra='{$m_precio}'";
			$query.=" WHERE id='{$material['id']}'";
			$result=$db->query($query);
			if($result&&$db->affected_rows()===1){
				$session->msg('s',"El material ha sido actualizado.");
				redirect('materials.php',false);
			}else{
				$session->msg('d','Actualización fallida.');
				redirect('edit_material.php?id='.$material['id'],false);
            }
		}else{
			$session->msg("d",$errors);
			redirect('edit_material.php?id='.$material['id'],false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: materials.php");
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
				<span>Editar material</span>
			</strong>
        </div>
        <div class="panel-body">
			<div class="col-md-12">
				<form method="post" action="edit_material.php?id=<?php echo (int)$material['id'] ?>">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-wrench"></i>
								</span>
								<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo remove_junk($material['nombre']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-gift"></i>
								</span>
								<input type="text" class="form-control" name="descripcion" placeholder="Descripción" value="<?php echo remove_junk($material['descripcion']); ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-signal"></i>
								</span>
								<input type="number" class="form-control" name="cantidad" placeholder="Cantidad" value="<?php echo remove_junk($material['cantidad']); ?>">
							</div>
							<div class="col-md-4">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-calendar"></i>
								</span>
								<input type="date" class="form-control" name="fecha_compra" placeholder="Fecha de compra" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?php echo remove_junk($material['fecha_compra']); ?>">
							</div>
							<div class="col-md-4">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-eur"></i>
								</span>
								<input type="number" step="0.01" class="form-control" name="precio_compra" placeholder="Precio de compra"value="<?php echo remove_junk($material['precio_compra']); ?>">
							</div>
							
						</div>
					</div>
					<button type="submit" name="material" class="btn btn-danger" style="margin-left:500px">Actualizar</button>
					<button type="submit" name="back" class="btn btn-primary" style="margin-left:500px">Volver atras</button>
				</form>
			</div>
        </div>
	</div>
</div>
<?php include_once('layouts/footer.php'); ?>