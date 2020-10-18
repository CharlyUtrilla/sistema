<?php
	$page_title='Agregar proveedor';
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	if(isset($_POST['add_supplier'])){
		$req_fields=array('nombre','direccion','poblacion','estado','telefono','descripcion','fecha_inicio','activo');
		validate_fields($req_fields);
		if(empty($errors)){
			$s_nombre=$db->escape($_POST['nombre']);
			$s_direccion=$db->escape($_POST['direccion']);
			$s_poblacion=$db->escape($_POST['poblacion']);
			$s_estado=$db->escape($_POST['estado']);
			$s_telefono=$db->escape($_POST['telefono']);
			$s_descripcion=$db->escape($_POST['descripcion']);
			$s_fecha=$db->escape($_POST['fecha_inicio']);
			$s_activo=$db->escape($_POST['activo']);
			$sql="INSERT INTO suppliers (";
			$sql.=" nombre,direccion,poblacion,estado,telefono,descripcion,fecha_inicio,activo";
			$sql.=") VALUES (";
			$sql.=" '{$s_nombre}','{$s_direccion}','{$s_poblacion}','{$s_estado}','{$s_telefono}','{$s_descripcion}','{$s_fecha}','{$s_activo}'";
			$sql.=")";
			$sql.=" ON DUPLICATE KEY UPDATE nombre='{$s_nombre}'";
			if($db->query($sql)){
				$session->msg('s',"Proveedor agregado.");
				redirect('add_supplier.php',false);
            }else{
				$session->msg('d','Proveedor no agregado.');
				redirect('add_supplier.php',false);
            }
        }else{
			$session->msg("d",$errors);
			redirect('add_supplier.php',false);
        }
	}
	if(isset($_POST['back'])){
		header("Location: suppliers.php");
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
					<span>Agregar proveedor</span>
				</strong>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<form method="post" action="add_supplier.php" class="clearfix">
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
									<select class="form-control" name="activo" placeholder="Proveedor activo?">
										<option value=""disabled selected>Proveedor activo?</option>
										<option value="si">Si</option>
										<option value="no">No</option>
									</select>
								</div>
							</div>
						</div>
						<button type="submit" name="add_supplier" class="btn btn-danger" style="margin-left:100px">Agregar proveedor</button>
						<button type="submit" name="back" class="btn btn-primary" style="margin-left:400px">Volver atras</button>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>