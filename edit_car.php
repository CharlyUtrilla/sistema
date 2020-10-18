<?php
	$page_title='Editar vehiculo';
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$car=find_by_id('cars',(int)$_GET['id']);
	$all_cars=find_all('cars');
	if(!$car){
		$session->msg("d","ID de coche no encontrado.");
		redirect('cars.php');
	}
?>
<?php
	if(isset($_POST['car'])){
		$req_fields=array('marca_modelo','poblacion','empleado','matricula','estado','fecha_compra','ultima_revision');
		validate_fields($req_fields);
		if(empty($errors)){
			$c_marca=remove_junk($db->escape($_POST['marca_modelo']));
			$c_poblacion=remove_junk($db->escape($_POST['poblacion']));
			$c_empleado=((int)$_POST['empleado']);
			$c_matricula=remove_junk($db->escape($_POST['matricula']));
			$c_estado=remove_junk($db->escape($_POST['estado']));
			$c_compra=remove_junk($db->escape($_POST['fecha_compra']));
			$c_revision=remove_junk($db->escape($_POST['ultima_revision']));
			$query ="UPDATE cars SET";
			$query.=" marca_modelo='{$c_marca}',poblacion='{$c_poblacion}',empleado='{$c_empleado}',matricula='{$c_matricula}',estado='{$c_estado}',fecha_compra='{$c_compra}',ultima_revision='{$c_revision}'";
			$query.=" WHERE id='{$car['id']}'";
			$result=$db->query($query);
			if($result&&$db->affected_rows()===1){
				$session->msg('s',"El vehículo ha sido actualizado.");
				redirect('cars.php',false);
			}else{
				$session->msg('d','Actualización fallida.');
				redirect('edit_car.php?id='.$car['id'],false);
            }
		}else{
			$session->msg("d",$errors);
			redirect('edit_car.php?id='.$car['id'],false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: cars.php");
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
				<span>Editar vehículo</span>
			</strong>
        </div>
        <div class="panel-body">
			<div class="col-md-12">
				<form method="post" action="edit_car.php?id=<?php echo (int)$car['id'] ?>">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-th-large"></i>
							</span>
							<input type="text" class="form-control" name="marca_modelo" value="<?php echo remove_junk($car['marca_modelo']); ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-map-marker"></i>
								</span>
								<input type="text" class="form-control" name="poblacion" placeholder="Población" value="<?php echo remove_junk($car['poblacion']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-user"></i>
								</span>
								<input type="number" class="form-control" name="empleado" placeholder="ID empleado" value="<?php echo remove_junk($car['empleado']); ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-subtitles"></i>
								</span>
								<input type="text" class="form-control" name="matricula" placeholder="Matrícula" value="<?php echo remove_junk($car['matricula']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-blackboard"></i>
								</span>
								<select class="form-control" name="estado" placeholder="estado">
									<option value=""disabled>Estado</option>
									<option value="activo"<?php if($car['estado']=="activo"){echo "SELECTED";} ?>>Activo</option>
									<option value="inactivo"<?php if($car['estado']=="inactivo"){echo "SELECTED";} ?>>Inactivo</option>
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
								<input type="text" class="form-control" name="fecha_compra" placeholder="Fecha de compra" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?php echo remove_junk($car['fecha_compra']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-calendar"></i>
								</span>
								<input type="text" class="form-control" name="ultima_revision" placeholder="Última revisión" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?php echo remove_junk($car['ultima_revision']); ?>">
							</div>
						</div>
					</div>
					<button type="submit" name="car" class="btn btn-danger" style="margin-left:500px">Actualizar</button>
					<button type="submit" name="back" class="btn btn-primary" style="margin-left:500px">Volver atras</button>
				</form>
			</div>
        </div>
	</div>
</div>
<?php include_once('layouts/footer.php'); ?>