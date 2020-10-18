<?php
	$page_title='Agregar empleado';
	require_once('includes/load.php');
	page_require_level(2);
	$all_photo=find_all('media');
?>
<?php
	if(isset($_POST['add_employee'])){
		$req_fields=array('foto','nombre','apellidos','dni','lugar_nacimiento','fecha_nacimiento','domicilio','codigo_postal','ciudad','region','carnet_conducir','titulacion','puesto','inicio_contrato','fin_contrato');
		validate_fields($req_fields);
		if(empty($errors)){
			if(is_null($_POST['foto'])||$_POST['foto']===""){
				$foto='0';
			}else{
				$foto=$db->escape($_POST['foto']);
			}
			$nombre=$db->escape($_POST['nombre']);
			$apellidos=$db->escape($_POST['apellidos']);
			$dni=$db->escape($_POST['dni']);
			$lugar_nac=$db->escape($_POST['lugar_nacimiento']);
			$fecha_nac=$db->escape($_POST['fecha_nacimiento']);
			$domicilio=$db->escape($_POST['domicilio']);
			$cod_postal=$db->escape($_POST['codigo_postal']);
			$ciudad=$db->escape($_POST['ciudad']);
			$region=$db->escape($_POST['region']);
			$carnet=$db->escape($_POST['carnet_conducir']);
			$titulo=$db->escape($_POST['titulacion']);
			$puesto=$db->escape($_POST['puesto']);
			$ini_con=$db->escape($_POST['inicio_contrato']);
			$fin_con=$db->escape($_POST['fin_contrato']);
			$date=make_date();
			$query="INSERT INTO employees (";
			$query.="foto,nombre,apellidos,dni,lugar_nacimiento,fecha_nacimiento,domicilio,codigo_postal,ciudad,region,carnet_conducir,titulacion,puesto,inicio_contrato,fin_contrato";
			$query.=") VALUES (";
			$query.="'{$foto}','{$nombre}','{$apellidos}','{$dni}','{$lugar_nac}','{$fecha_nac}','{$domicilio}','{$cod_postal}','{$ciudad}','{$region}','{$carnet}','{$titulo}','{$puesto}','{$ini_con}','{$fin_con}'";
			$query.=")";
			$query.=" ON DUPLICATE KEY UPDATE nombre='{$nombre}'";
			if($db->query($query)){
				$session->msg('s',"Empleado agregado.");
				redirect('add_employee.php',false);
			}else{
				$session->msg('d','Empleado no agragado.');
				redirect('employees.php',false);
			}
		} else{
			$session->msg("d",$errors);
			redirect('add_employee.php',false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: employees.php");
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
					<span>Agregar empleado</span>
				</strong>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<form method="post" action="add_employee.php" class="clearfix">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-th-large"></i>
										</span>
										<input type="text" class="form-control" name="nombre" placeholder="Nombre">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-th-large"></i>
										</span>
										<input type="text" class="form-control" name="apellidos" placeholder="Apellidos">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-bookmark"></i>
										</span>
										<input type="text" class="form-control" name="dni" placeholder="DNI">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-picture"></i>
										</span>
										<select class="form-control" name="foto">
											<option value="">Selecciona una imagen</option>
											<?php foreach ($all_photo as $foto): ?>
											<option value="<?php echo (int)$foto['id'] ?>">
											<?php echo $foto['file_name'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-map-marker"></i>
										</span>
										<input type="text" class="form-control" name="lugar_nacimiento" placeholder="Lugar de nacimiento">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" name="fecha_nacimiento" placeholder="Fecha de nacimiento" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-save"></i>
										</span>
										<input type="text" class="form-control" name="domicilio" placeholder="Domicilio">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-pushpin"></i>
										</span>
										<input type="number" class="form-control" name="codigo_postal" placeholder="Código postal">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-dashboard"></i>
										</span>
										<input type="text" class="form-control" name="ciudad" placeholder="Ciudad">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-globe"></i>
										</span>
										<input type="text" class="form-control" name="region" placeholder="Región">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-credit-card"></i>
										</span>
										<select class="form-control" name="carnet_conducir" placeholder="Carnet de conducir">
											<option value=""disabled selected>Carnet de conducir</option>
											<option value="si">Si</option>
											<option value="no">No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-list-alt"></i>
										</span>
										<input type="text" class="form-control" name="titulacion" placeholder="Titulación">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-tag"></i>
										</span>
										<input type="text" class="form-control" name="puesto" placeholder="Puesto">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" name="inicio_contrato" placeholder="Incio del contrato" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" name="fin_contrato" placeholder="Fin del contrato" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
							</div>
						</div>
						<button type="submit" name="add_employee" class="btn btn-danger" style="margin-left:100px">Agregar empleado</button>
						<button type="submit" name="back" class="btn btn-primary" style="margin-left:300px">Volver atras</button>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>