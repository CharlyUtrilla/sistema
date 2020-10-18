<?php
	$page_title='Editar cliente';
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$client=find_by_id('clients',(int)$_GET['id']);
	$all_clients=find_all('clients');
	if(!$client){
		$session->msg("d","ID de cliente no encontrado.");
		redirect('clients.php');
	}
?>
<?php
	if(isset($_POST['client'])){
		$req_fields=array('nombre','direccion','poblacion','estado','telefono','descripcion','fecha_inicio','activo');
		validate_fields($req_fields);
		if(empty($errors)){
			$c_nombre=remove_junk($db->escape($_POST['nombre']));
			$c_direccion=remove_junk($db->escape($_POST['direccion']));
			$c_poblacion=remove_junk($db->escape($_POST['poblacion']));
			$c_estado=remove_junk($db->escape($_POST['estado']));
			$c_telefono=remove_junk($db->escape($_POST['telefono']));
			$c_descripcion=remove_junk($db->escape($_POST['descripcion']));
			$c_fecha=remove_junk($db->escape($_POST['fecha_inicio']));
			$c_activo=remove_junk($db->escape($_POST['activo']));
			$query ="UPDATE clients SET";
			$query.=" nombre='{$c_nombre}',direccion='{$c_direccion}',poblacion='{$c_poblacion}',estado='{$c_estado}',telefono='{$c_telefono}',descripcion='{$c_descripcion}',fecha_inicio='{$c_fecha}',activo='{$c_activo}'";
			$query.=" WHERE id='{$client['id']}'";
			$result=$db->query($query);
			if($result&&$db->affected_rows()===1){
				$session->msg('s',"El cliente ha sido actualizado.");
				redirect('clients.php',false);
			}else{
				$session->msg('d','Actualización fallida.');
				redirect('edit_client.php?id='.$client['id'],false);
            }
		}else{
			$session->msg("d",$errors);
			redirect('edit_client.php?id='.$client['id'],false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: clients.php");
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
				<span>Editar cliente</span>
			</strong>
        </div>
        <div class="panel-body">
			<div class="col-md-12">
				<form method="post" action="edit_client.php?id=<?php echo (int)$client['id'] ?>">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-user"></i>
								</span>
								<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo remove_junk($client['nombre']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-map-marker"></i>
								</span>
								<input type="text" class="form-control" name="direccion" placeholder="Dirección" value="<?php echo remove_junk($client['direccion']); ?>">
							</div> 
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-home"></i>
								</span>
								<input type="text" class="form-control" name="poblacion" placeholder="Población" value="<?php echo remove_junk($client['poblacion']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-flag"></i>
								</span>
								<input type="text" class="form-control" name="estado" placeholder="Estado" value="<?php echo remove_junk($client['estado']); ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-phone"></i>
								</span>
								<input type="number" class="form-control" name="telefono" placeholder="Teléfono" value="<?php echo remove_junk($client['telefono']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-tasks"></i>
								</span>
								<input type="text" class="form-control" name="descripcion" placeholder="Descripción" value="<?php echo remove_junk($client['descripcion']); ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-calendar"></i>
								</span>
								<input type="text" class="form-control" name="fecha_inicio" placeholder="Fecha inicio" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?php echo remove_junk($client['fecha_inicio']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-ok"></i>
								</span>
								<select class="form-control" name="activo">
									<option value=""disabled>Cliente activo?</option>
									<option value="si"<?php if($client['activo']=="si"){echo "SELECTED";} ?>>Si</option>
									<option value="no"<?php if($client['activo']=="no"){echo "SELECTED";} ?>>No</option>
								</select>
								<!--<input type="text" class="form-control" name="activo" placeholder="Cliente activo?" value="<?php echo remove_junk($client['activo']); ?>">-->
							</div>
						</div>
					</div>
					<button type="submit" name="client" class="btn btn-danger" style="margin-left:500px">Actualizar</button>
					<button type="submit" name="back" class="btn btn-primary" style="margin-left:500px">Volver atras</button>
				</form>
			</div>
        </div>
	</div>
</div>
<?php include_once('layouts/footer.php'); ?>