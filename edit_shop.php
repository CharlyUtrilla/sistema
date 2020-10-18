<?php
	$page_title='Editar tienda';
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$shop=find_by_id('shops',(int)$_GET['id']);
	$all_shops=find_all('shops');
	if(!$shop){
		$session->msg("d","ID de tienda no encontrado.");
		redirect('shops.php');
	}
?>
<?php
	if(isset($_POST['shop'])){
		$req_fields=array('direccion','cod_postal','poblacion','empleado','metros_cuadrados','alquiler','adquisicion');
		validate_fields($req_fields);
		if(empty($errors)){
			$s_direccion=remove_junk($db->escape($_POST['direccion']));
			$s_cod_postal=remove_junk($db->escape($_POST['cod_postal']));
			$s_poblacion=remove_junk($db->escape($_POST['poblacion']));
			$s_empleado=((int)$_POST['empleado']);
			$s_metros_cuadrados=remove_junk($db->escape($_POST['metros_cuadrados']));
			$s_alquiler=remove_junk($db->escape($_POST['alquiler']));
			$s_adquisicion=remove_junk($db->escape($_POST['adquisicion']));
			$query ="UPDATE shops SET ";
			$query.="direccion='{$s_direccion}',cod_postal='{$s_cod_postal}',poblacion='{$s_poblacion}',empleado='{$s_empleado}',metros_cuadrados='{$s_metros_cuadrados}',alquiler='{$s_alquiler}',adquisicion='{$s_adquisicion}'";
			$query.=" WHERE id='{$shop['id']}'";
			$result=$db->query($query);
			if($result&&$db->affected_rows()===1){
				$session->msg('s',"La tienda ha sido actualizada.");
				redirect('shops.php',false);
			}else{
				$session->msg('d','Actualización fallida.');
				redirect('edit_shop.php?id='.$shop['id'],false);
            }
		}else{
			$session->msg("d",$errors);
			redirect('edit_shop.php?id='.$shop['id'],false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: shops.php");
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
				<span>Editar tienda</span>
			</strong>
        </div>
        <div class="panel-body">
			<div class="col-md-12">
				<form method="post" action="edit_shop.php?id=<?php echo (int)$shop['id'] ?>">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-th-large"></i>
							</span>
							<input type="text" class="form-control" name="direccion" value="<?php echo remove_junk($shop['direccion']); ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-flag"></i>
								</span>
								<input type="number" class="form-control" name="cod_postal" placeholder="Código postal" value="<?php echo remove_junk($shop['cod_postal']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-map-marker"></i>
								</span>
								<input type="text" class="form-control" name="poblacion" placeholder="Población" value="<?php echo remove_junk($shop['poblacion']); ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-user"></i>
								</span>
								<input type="number" class="form-control" name="empleado" placeholder="ID empleado" value="<?php echo remove_junk($shop['empleado']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-fullscreen"></i>
								</span>
								<input type="number" class="form-control" name="metros_cuadrados" placeholder="Metros cuadrados" value="<?php echo remove_junk($shop['metros_cuadrados']); ?>">
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
									<option value=""disabled>Alquiler</option>
									<option value="si"<?php if($shop['alquiler']=="si"){echo "SELECTED";} ?>>Si</option>
									<option value="no"<?php if($shop['alquiler']=="no"){echo "SELECTED";} ?>>No</option>
								</select>
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-calendar"></i>
								</span>
								<input type="text" class="form-control" name="adquisicion" placeholder="Fecha de adquisición" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?php echo remove_junk($shop['adquisicion']); ?>">
							</div>
						</div>
					</div>
					<button type="submit" name="shop" class="btn btn-danger" style="margin-left:400px">Actualizar</button>
					<button type="submit" name="back" class="btn btn-primary" style="margin-left:400px">Volver atras</button>
				</form>
			</div>
        </div>
	</div>
</div>
<?php include_once('layouts/footer.php'); ?>