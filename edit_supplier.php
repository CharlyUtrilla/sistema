<?php
	$page_title='Editar proveedor';
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$supplier=find_by_id('suppliers',(int)$_GET['id']);
	$all_suppliers=find_all('suppliers');
	if(!$supplier){
		$session->msg("d","ID de proveedor no encontrado.");
		redirect('suppliers.php');
	}
?>
<?php
	if(isset($_POST['supplier'])){
		$req_fields=array('nombre','direccion','poblacion','estado','telefono','descripcion','fecha_inicio','activo');
		validate_fields($req_fields);
		if(empty($errors)){
			$s_nombre=remove_junk($db->escape($_POST['nombre']));
			$s_direccion=remove_junk($db->escape($_POST['direccion']));
			$s_poblacion=remove_junk($db->escape($_POST['poblacion']));
			$s_estado=remove_junk($db->escape($_POST['estado']));
			$s_telefono=remove_junk($db->escape($_POST['telefono']));
			$s_descripcion=remove_junk($db->escape($_POST['descripcion']));
			$s_fecha=remove_junk($db->escape($_POST['fecha_inicio']));
			$s_activo=remove_junk($db->escape($_POST['activo']));
			$query ="UPDATE suppliers SET";
			$query.=" nombre='{$s_nombre}',direccion='{$s_direccion}',poblacion='{$s_poblacion}',estado='{$s_estado}',telefono='{$s_telefono}',descripcion='{$s_descripcion}',fecha_inicio='{$s_fecha}',activo='{$s_activo}'";
			$query.=" WHERE id='{$supplier['id']}'";
			$result=$db->query($query);
			if($result&&$db->affected_rows()===1){
				$session->msg('s',"El proveedor ha sido actualizado.");
				redirect('suppliers.php',false);
			}else{
				$session->msg('d','Actualización fallida.');
				redirect('edit_supplier.php?id='.$supplier['id'],false);
            }
		}else{
			$session->msg("d",$errors);
			redirect('edit_supplier.php?id='.$supplier['id'],false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: suppliers.php");
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
				<span>Editar proveedor</span>
			</strong>
        </div>
        <div class="panel-body">
			<div class="col-md-12">
				<form method="post" action="edit_supplier.php?id=<?php echo (int)$supplier['id'] ?>">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-user"></i>
								</span>
								<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo remove_junk($supplier['nombre']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-map-marker"></i>
								</span>
								<input type="text" class="form-control" name="direccion" placeholder="Dirección" value="<?php echo remove_junk($supplier['direccion']); ?>">
							</div> 
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-home"></i>
								</span>
								<input type="text" class="form-control" name="poblacion" placeholder="Población" value="<?php echo remove_junk($supplier['poblacion']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-flag"></i>
								</span>
								<input type="text" class="form-control" name="estado" placeholder="Estado" value="<?php echo remove_junk($supplier['estado']); ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-phone"></i>
								</span>
								<input type="number" class="form-control" name="telefono" placeholder="Teléfono" value="<?php echo remove_junk($supplier['telefono']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-tasks"></i>
								</span>
								<input type="text" class="form-control" name="descripcion" placeholder="Descripción" value="<?php echo remove_junk($supplier['descripcion']); ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-calendar"></i>
								</span>
								<input type="text" class="form-control" name="fecha_inicio" placeholder="Fecha inicio" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?php echo remove_junk($supplier['fecha_inicio']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-ok"></i>
								</span>
								<select class="form-control" name="activo">
									<option value=""disabled>Proveedor activo?</option>
									<option value="si"<?php if($supplier['activo']=="si"){echo "SELECTED";} ?>>Si</option>
									<option value="no"<?php if($supplier['activo']=="no"){echo "SELECTED";} ?>>No</option>
								</select>
								<!--<input type="text" class="form-control" name="activo" placeholder="Proveedor activo?" value="<?php echo remove_junk($supplier['activo']); ?>">-->
							</div>
						</div>
					</div>
					<button type="submit" name="supplier" class="btn btn-danger" style="margin-left:500px">Actualizar</button>
					<button type="submit" name="back" class="btn btn-primary" style="margin-left:500px">Volver atras</button>
				</form>
			</div>
        </div>
	</div>
</div>
<?php include_once('layouts/footer.php'); ?>