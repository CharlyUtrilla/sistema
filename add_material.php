<?php
	$page_title='Agregar material';
	require_once('includes/load.php');
	page_require_level(2);
	$all_materials=find_all('materials');
?>
<?php
	if(isset($_POST['add_material'])){
		$req_fields=array('nombre','descripcion','cantidad','fecha_compra','precio_compra');
		validate_fields($req_fields);
		if(empty($errors)){
			$m_nombre=$db->escape($_POST['nombre']);
			$m_descripcion=$db->escape($_POST['descripcion']);
			$m_cantidad=$db->escape((int)$_POST['cantidad']);
			$m_compra=$db->escape($_POST['fecha_compra']);
			$m_precio=$db->escape($_POST['precio_compra']);
			$sql="INSERT INTO materials (";
			$sql.=" nombre,descripcion,cantidad,fecha_compra,precio_compra";
			$sql.=") VALUES (";
			$sql.=" '{$m_nombre}','{$m_descripcion}','{$m_cantidad}','{$m_compra}','{$m_precio}'";
			$sql.=")";
			$sql.=" ON DUPLICATE KEY UPDATE nombre='{$m_nombre}'";
			if($db->query($sql)){
				$session->msg('s',"Material agregado.");
				redirect('add_material.php',false);
            }else{
				$session->msg('d','Material no agregado.');
				redirect('add_material.php',false);
            }
        }else{
			$session->msg("d",$errors);
			redirect('add_material.php',false);
        }
	}
	if(isset($_POST['back'])){
		header("Location: materials.php");
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
					<span>Agregar material</span>
				</strong>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<form method="post" action="add_material.php" class="clearfix">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-wrench"></i>
									</span>
									<input type="text" class="form-control" name="nombre" placeholder="Nombre">
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-gift"></i>
									</span>
									<input type="text" class="form-control" name="descripcion" placeholder="Descripción">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-signal"></i>
									</span>
									<input type="number" class="form-control" name="cantidad" placeholder="Cantidad">
								</div>
								<div class="col-md-4">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
									</span>
									<input type="date" class="form-control" name="fecha_compra" placeholder="Fecha de compra" onfocus="(this.type='date')" onblur="(this.type='text')">
								</div>
								<div class="col-md-4">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-eur"></i>
									</span>
									<input type="number" step="0.01" class="form-control" name="precio_compra" placeholder="Precio de compra">
								</div>
							</div>
						</div>
						<button type="submit" name="add_material" class="btn btn-danger" style="margin-left:100px">Agregar material</button>
						<button type="submit" name="back" class="btn btn-primary" style="margin-left:400px">Volver atras</button>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>