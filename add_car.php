<?php
	$page_title='Agregar vehículo';
	require_once('includes/load.php');
	page_require_level(2);
	$all_cars=find_all('cars');
?>
<?php
	if(isset($_POST['add_car'])){
		$req_fields=array('marca_modelo','poblacion','empleado','matricula','estado','fecha_compra','ultima_revision');
		validate_fields($req_fields);
		if(empty($errors)){
			$c_marca=$db->escape($_POST['marca_modelo']);
			$c_poblacion=$db->escape($_POST['poblacion']);
			$c_empleado=$db->escape((int)$_POST['empleado']);
			$c_matricula=$db->escape($_POST['matricula']);
			$c_estado=$db->escape($_POST['estado']);
			$c_compra=$db->escape($_POST['fecha_compra']);
			$c_revision=$db->escape($_POST['ultima_revision']);
			$sql="INSERT INTO cars (";
			$sql.=" marca_modelo,poblacion,empleado,matricula,estado,fecha_compra,ultima_revision";
			$sql.=") VALUES (";
			$sql.=" '{$c_marca}','{$c_poblacion}','{$c_empleado}','{$c_matricula}','{$c_estado}','{$c_compra}','{$c_revision}'";
			$sql.=")";
			$sql.=" ON DUPLICATE KEY UPDATE marca_modelo='{$c_marca}'";
			if($db->query($sql)){
				$session->msg('s',"Vehículo agregado.");
				redirect('add_car.php',false);
            }else{
				$session->msg('d','Vehículo no agregado.');
				redirect('add_car.php',false);
            }
        }else{
			$session->msg("d",$errors);
			redirect('add_car.php',false);
        }
	}
	if(isset($_POST['back'])){
		header("Location: cars.php");
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
					<span>Agregar vehículo</span>
				</strong>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<form method="post" action="add_car.php" class="clearfix">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-th-large"></i>
								</span>
								<input type="text" class="form-control" name="marca_modelo" placeholder="Marca y modelo">
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-map-marker"></i>
									</span>
									<input type="text" class="form-control" name="poblacion" placeholder="Población">
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-user"></i>
									</span>
									<input type="number" class="form-control" name="empleado" placeholder="ID empleado">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-subtitles"></i>
									</span>
									<input type="text" class="form-control" name="matricula" placeholder="Matrícula">
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-blackboard"></i>
									</span>
									<select class="form-control" name="estado" placeholder="estado">
										<option value=""disabled selected>Estado</option>
										<option value="activo">Activo</option>
										<option value="inactivo">Inactivo</option>
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
									<input type="text" class="form-control" name="fecha_compra" placeholder="Fecha de compra" onfocus="(this.type='date')" onblur="(this.type='text')">
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
									</span>
									<input type="text" class="form-control" name="ultima_revision" placeholder="Última revisión" onfocus="(this.type='date')" onblur="(this.type='text')">
								</div>
							</div>
						</div>
						<button type="submit" name="add_car" class="btn btn-danger" style="margin-left:100px">Agregar vehículo</button>
						<button type="submit" name="back" class="btn btn-primary" style="margin-left:400px">Volver atras</button>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>