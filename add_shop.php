<?php
	$page_title='Agregar tienda';
	require_once('includes/load.php');
	page_require_level(2);
	$all_shops=find_all('shops');
?>
<?php
	if(isset($_POST['add_shop'])){
		$req_fields=array('direccion','cod_postal','poblacion','empleado','metros_cuadrados','alquiler','adquisicion');
		validate_fields($req_fields);
		if(empty($errors)){
			$s_direccion=$db->escape($_POST['direccion']);
			$s_cod_postal=$db->escape($_POST['cod_postal']);
			$s_poblacion=$db->escape($_POST['poblacion']);
			$s_empleado=$db->escape((int)$_POST['empleado']);
			$s_metros=$db->escape($_POST['metros_cuadrados']);
			$s_alquiler=$db->escape($_POST['alquiler']);
			$s_adquisicion=$db->escape($_POST['adquisicion']);
			$s_adquisicion=make_date();
			$sql="INSERT INTO shops (";
			$sql.=" direccion,cod_postal,poblacion,empleado,metros_cuadrados,alquiler,adquisicion";
			$sql.=") VALUES (";
			$sql.=" '{$s_direccion}','{$s_cod_postal}','{$s_poblacion}','{$s_empleado}','{$s_metros}','{$s_alquiler}','{$s_adquisicion}'";
			$sql.=")";
			$sql.=" ON DUPLICATE KEY UPDATE direccion='{$s_direccion}'";
			if($db->query($sql)){
				$session->msg('s',"Tienda agregada.");
				redirect('add_shop.php',false);
            }else{
				$session->msg('d','Tienda no agregada.');
				redirect('add_shop.php',false);
            }
        }else{
			$session->msg("d",$errors);
			redirect('add_shop.php',false);
        }
	}
	if(isset($_POST['back'])){
		header("Location: shops.php");
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
					<span>Agregar tienda</span>
				</strong>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<form method="post" action="add_shop.php" class="clearfix">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-th-large"></i>
								</span>
								<input type="text" class="form-control" name="direccion" placeholder="Dirección">
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-flag"></i>
									</span>
									<input type="number" class="form-control" name="cod_postal" placeholder="Código postal">
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-map-marker"></i>
									</span>
									<input type="text" class="form-control" name="poblacion" placeholder="Población">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-user"></i>
									</span>
									<input type="number" class="form-control" name="empleado" placeholder="ID empleado">
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-fullscreen"></i>
									</span>
									<input type="number" class="form-control" step="0.01" name="metros_cuadrados" placeholder="Metros cuadrados">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-blackboard"></i>
									</span>
									<select class="form-control" name="alquiler" placeholder="alquiler">
										<option value=""disabled selected>Alquiler</option>
										<option value="si">Si</option>
										<option value="no">No</option>
									</select>
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
									</span>
									<input type="text" class="form-control" name="adquisicion" placeholder="Fecha de adquisición" onfocus="(this.type='date')" onblur="(this.type='text')">
								</div>
							</div>
						</div>
						<button type="submit" name="add_shop" class="btn btn-danger" style="margin-left:100px">Agregar tienda</button>
						<button type="submit" name="back" class="btn btn-primary" style="margin-left:400px">Volver atras</button>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>