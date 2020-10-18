<?php
	$page_title='Agregar cliente';
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	if(isset($_POST['add_client'])){
		$req_fields=array('nombre','direccion','poblacion','estado','telefono','descripcion','fecha_inicio','activo');
		validate_fields($req_fields);
		if(empty($errors)){
			$c_nombre=$db->escape($_POST['nombre']);
			$c_direccion=$db->escape($_POST['direccion']);
			$c_poblacion=$db->escape($_POST['poblacion']);
			$c_estado=$db->escape($_POST['estado']);
			$c_telefono=$db->escape($_POST['telefono']);
			$c_descripcion=$db->escape($_POST['descripcion']);
			$c_fecha=$db->escape($_POST['fecha_inicio']);
			$c_activo=$db->escape($_POST['activo']);
			$sql="INSERT INTO clients (";
			$sql.=" nombre,direccion,poblacion,estado,telefono,descripcion,fecha_inicio,activo";
			$sql.=") VALUES (";
			$sql.=" '{$c_nombre}','{$c_direccion}','{$c_poblacion}','{$c_estado}','{$c_telefono}','{$c_descripcion}','{$c_fecha}','{$c_activo}'";
			$sql.=")";
			$sql.=" ON DUPLICATE KEY UPDATE nombre='{$c_nombre}'";
			if($db->query($sql)){
				$session->msg('s',"Cliente agregado.");
				redirect('add_client.php',false);
            }else{
				$session->msg('d','Cliente no agregado.');
				redirect('add_client.php',false);
            }
        }else{
			$session->msg("d",$errors);
			redirect('add_client.php',false);
        }
	}
	if(isset($_POST['back'])){
		header("Location: clients.php");
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
					<span>Agregar cliente</span>
				</strong>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<form method="post" action="add_client.php" class="clearfix">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-user"></i>
									</span>
									<input type="text" class="form-control" name="nombre" placeholder="Nombre">
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-map-marker"></i>
									</span>
									<input type="text" class="form-control" name="direccion" placeholder="Dirección">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-home"></i>
									</span>
									<input type="text" class="form-control" name="poblacion" placeholder="Población">
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-flag"></i>
									</span>
									<input type="text" class="form-control" name="estado" placeholder="Estado">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-phone"></i>
									</span>
									<input type="number" class="form-control" name="telefono" placeholder="Teléfono">
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-tasks"></i>
									</span>
									<input type="text" class="form-control" name="descripcion" placeholder="Descripción">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
									</span>
									<input type="text" class="form-control" name="fecha_inicio" placeholder="Fecha inicio" onfocus="(this.type='date')" onblur="(this.type='text')">
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-ok"></i>
									</span>
									<select class="form-control" name="activo" placeholder="Cliente activo?">
										<option value=""disabled selected>Cliente activo?</option>
										<option value="si">Si</option>
										<option value="no">No</option>
									</select>
								</div>
							</div>
						</div>
						<button type="submit" name="add_client" class="btn btn-danger" style="margin-left:100px">Agregar cliente</button>
						<button type="submit" name="back" class="btn btn-primary" style="margin-left:400px">Volver atras</button>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>