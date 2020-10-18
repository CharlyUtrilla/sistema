<?php
	$page_title='Editar nómina';
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$salary=find_by_id('salary',(int)$_GET['id']);
	$all_salarys=find_all('salary');
	$employees=employees();
	if(!$salary){
		$session->msg("d","ID de nómina no encontrado.");
		redirect('salary.php');
	}
?>
<?php
	if(isset($_POST['salary'])){
		$req_fields=array('empleado','fecha','horas_base','horas_extra','pago_base','pago_extra','total_horas','total_pago');
		validate_fields($req_fields);
		if(empty($errors)){
			$s_empleado=remove_junk($db->escape($_POST['empleado']));
			$s_fecha=remove_junk($db->escape($_POST['fecha']));
			$s_hb=((int)$_POST['horas_base']);
			$s_he=((int)$_POST['horas_extra']);
			$s_pb=remove_junk($db->escape($_POST['pago_base']));
			$s_pe=remove_junk($db->escape($_POST['pago_extra']));
			$s_th=((int)$_POST['total_horas']);
			$s_tp=remove_junk($db->escape($_POST['total_pago']));
			$query ="UPDATE salary SET";
			$query.=" empleado='{$s_empleado}',fecha='{$s_fecha}',horas_base='{$s_hb}',horas_extra='{$s_he}',pago_base='{$s_pb}',pago_extra='{$s_pe}',total_horas='{$s_th}',total_pago='{$s_tp}'";
			$query.=" WHERE id='{$salary['id']}'";
			$result=$db->query($query);
			if($result&&$db->affected_rows()===1){
				$session->msg('s',"La nómina ha sido actualizada.");
				redirect('salary.php',false);
			}else{
				$session->msg('d','Actualización fallida.');
				redirect('edit_salary.php?id='.$salary['id'],false);
            }
		}else{
			$session->msg("d",$errors);
			redirect('edit_salary.php?id='.$salary['id'],false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: salary.php");
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
				<span>Editar nómina</span>
			</strong>
        </div>
        <div class="panel-body">
			<div class="col-md-12">
				<form method="post" action="edit_salary.php?id=<?php echo (int)$salary['id'] ?>">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-user"></i>
								</span>
								<select class="form-control" name="estado" placeholder="estado">
									<option value="">Empleado</option>
									<?php foreach($employees as $employee){ ?>
									<option value="<?php echo implode(',',$employee); ?>"<?php if($salary['empleado']==$employee){echo "SELECTED";} ?>disabled><?php echo implode(',',$employee); ?></option>
									<?php } ?>
								</select>
								<input type="text" disabled class="form-control" name="empleado" value="<?php echo remove_junk($salary['empleado']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-calendar"></i>
								</span>
								<input type="text" class="form-control" name="fecha" placeholder="Fecha" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?php echo remove_junk($salary['fecha']); ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-time"></i>
								</span>
								<input type="number" step="0,5" class="form-control" name="horas_base" placeholder="Horas base" value="<?php echo remove_junk($salary['horas_base']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-time"></i>
								</span>
								<input type="number" step="0,5" class="form-control" name="horas_extra" placeholder="Horas extra" value="<?php echo remove_junk($salary['horas_extra']); ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-eur"></i>
								</span>
								<input type="number" step="0,01" class="form-control" name="pago_base" placeholder="Pago base" value="<?php echo remove_junk($salary['pago_base']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-eur"></i>
								</span>
								<input type="number" step="0,01" class="form-control" name="pago_extra" placeholder="Pago extra" value="<?php echo remove_junk($salary['pago_extra']); ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-time"></i>
								</span>
								<input type="number" step="0,5" class="form-control" name="total_horas" placeholder="Total horas" value="<?php echo remove_junk($salary['total_horas']); ?>">
							</div>
							<div class="col-md-6">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-eur"></i>
								</span>
								<input type="number" step="0,01" class="form-control" name="total_pago" placeholder="Total pago" value="<?php echo remove_junk($salary['total_pago']); ?>">
							</div>
						</div>
					</div>
					<button type="submit" name="salary" class="btn btn-danger" style="margin-left:500px">Actualizar</button>
					<button type="submit" name="back" class="btn btn-primary" style="margin-left:500px">Volver atras</button>
				</form>
			</div>
        </div>
	</div>
</div>
<?php include_once('layouts/footer.php'); ?>