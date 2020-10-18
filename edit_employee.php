<?php
	$page_title='Editar empleado';
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$employee=find_by_id('employees',(int)$_GET['id']);
	$all_photo=find_all('media');
	if(!$employee){
		$session->msg("d","ID de empleado perdido.");
		redirect('employees.php');
		
	}
?>
<?php
	if(isset($_POST['employee'])){
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
			$query ="UPDATE employees SET ";
			$query.="foto='{$foto}',nombre='{$nombre}',apellidos='{$apellidos}',dni='{$dni}',lugar_nacimiento='{$lugar_nac}',fecha_nacimiento='{$fecha_nac}',domicilio='{$domicilio}',codigo_postal='{$cod_postal}',ciudad='{$ciudad}',region='{$region}',carnet_conducir='{$carnet}',titulacion='{$titulo}',puesto='{$puesto}',inicio_contrato='{$ini_con}',fin_contrato='{$fin_con}'";
			$query.=" WHERE id='{$employee['id']}'";
			$result=$db->query($query);
			if($result&&$db->affected_rows()===1){
				$session->msg('s',"El empleado ha sido actualizado.");
				redirect('employees.php',false);
			}else{
				$session->msg('d','Actualización fallida.');
				redirect('edit_employee.php?id='.$employee['id'],false);
            }
		}else{
			$session->msg("d",$errors);
			redirect('edit_employee.php?id='.$employee['id'],false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: employees.php");
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
				<span>Editar empleado</span>
			</strong>
        </div>
        <div class="panel-body">
			<div class="col-md-7">
				<form method="post" action="edit_employee.php?id=<?php echo (int)$employee['id'] ?>">
					<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-th-large"></i>
										</span>
										<input type="text" class="form-control" name="nombre" value="<?php echo remove_junk($employee['nombre']); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-th-large"></i>
										</span>
										<input type="text" class="form-control" name="apellidos" value="<?php echo remove_junk($employee['apellidos']); ?>">
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
										<input type="text" class="form-control" name="dni" value="<?php echo remove_junk($employee['dni']); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-picture"></i>
										</span>
										<select class="form-control" name="foto">
											<option value=""disabled>Elegir imagen</option>
											<option value="0">Sin imagen</option>
											<?php foreach($all_photo as $foto): ?>
											<option value="<?php echo (int)$foto['id'] ?>" <?php if($employee['foto']===$foto['id']): echo "selected"; endif; ?>>
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
										<input type="text" class="form-control" name="lugar_nacimiento" value="<?php echo remove_junk($employee['lugar_nacimiento']); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" name="fecha_nacimiento" value="<?php echo remove_junk($employee['fecha_nacimiento']); ?>" onfocus="(this.type='date')" onblur="(this.type='text')">
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
										<input type="text" class="form-control" name="domicilio" value="<?php echo remove_junk($employee['domicilio']); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-pushpin"></i>
										</span>
										<input type="number" class="form-control" name="codigo_postal" value="<?php echo remove_junk($employee['codigo_postal']); ?>">
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
										<input type="text" class="form-control" name="ciudad" value="<?php echo remove_junk($employee['ciudad']); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-globe"></i>
										</span>
										<input type="text" class="form-control" name="region" value="<?php echo remove_junk($employee['region']); ?>">
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
										<select class="form-control" name="carnet_conducir">
											<option value=""disabled>Carnet de conducir</option>
											<option value="si"<?php if($employee['carnet_conducir']=="si"){echo "SELECTED";} ?>>Si</option>
											<option value="no"<?php if($employee['carnet_conducir']=="no"){echo "SELECTED";} ?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-list-alt"></i>
										</span>
										<input type="text" class="form-control" name="titulacion" value="<?php echo remove_junk($employee['titulacion']); ?>">
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
										<input type="text" class="form-control" name="puesto" value="<?php echo remove_junk($employee['puesto']); ?>">
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
										<input type="text" class="form-control" name="inicio_contrato" value="<?php echo remove_junk($employee['inicio_contrato']); ?>" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" name="fin_contrato" value="<?php echo remove_junk($employee['fin_contrato']); ?>" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
							</div>
						</div>
					<button type="submit" name="employee" class="btn btn-danger" style="margin-left:200px">Actualizar</button>
					<button type="submit" name="back" class="btn btn-primary" style="margin-left:200px">Volver atras</button>
				</form>
			</div>
        </div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>