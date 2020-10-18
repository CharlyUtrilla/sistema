<?php
	$page_title='Agregar nómina';
	require_once('includes/load.php');
	page_require_level(2);
	//$all_salarys=find_all('salary');
	//$all_salarys=find_all_salary();
	$employees=employees();
?>
<?php
	if(isset($_POST['add_salary'])){
		$req_fields=array('empleado','fecha','horas_base','horas_extra','pago_base','pago_extra','total_horas','total_pago');
		validate_fields($req_fields);
		if(empty($errors)){
			$s_empleado=$db->escape($_POST['empleado']);
			$s_fecha=$db->escape($_POST['fecha']);
			$s_hb=$db->escape((int)$_POST['horas_base']);
			$s_he=$db->escape($_POST['horas_extra']);
			$s_pb=$db->escape($_POST['pago_base']);
			$s_pe=$db->escape($_POST['pago_extra']);
			$s_th=$db->escape($_POST['total_horas']);
			$s_tp=$db->escape($_POST['total_pago']);
			$sql="INSERT INTO salary (";
			$sql.=" empleado,fecha,horas_base,horas_extra,pago_base,pago_extra,total_horas,total_pago";
			$sql.=") VALUES (";
			$sql.=" '{$s_empleado}','{$s_fecha}','{$s_hb}','{$s_he}','{$s_pb}','{$s_pe}','{$s_th}','{$s_tp}'";
			$sql.=")";
			$sql.=" ON DUPLICATE KEY UPDATE empleado='{$s_empleado}' AND fecha='{$s_fecha}'";
			if($db->query($sql)){
				$session->msg('s',"Nómina agregada.");
				redirect('add_salary.php',false);
            }else{
				$session->msg('d','Nómina no agregada.');
				redirect('add_salary.php',false);
            }
        }else{
			$session->msg("d",$errors);
			redirect('add_salary.php',false);
        }
	}
	if(isset($_POST['back'])){
		header("Location: salary.php");
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
					<span>Agregar nómina</span>
				</strong>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<form method="post" action="add_salary.php" class="clearfix">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-user"></i>
									</span>
									<select class="form-control" name="empleado">
										<option value="">Elige un empleado</option>
										<?php foreach($employees as $employee){ ?>
										<option value="<?php echo implode(',',$employee); ?>"><?php echo implode(',',$employee); ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
									</span>
									<input type="text" class="form-control" name="fecha" placeholder="Fecha" onfocus="(this.type='date')" onblur="(this.type='text')">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-time"></i>
									</span>
									<input type="number" step="0,5" class="form-control" name="horas_base" placeholder="Horas base">
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-time"></i>
									</span>
									<input type="number" step="0,5" class="form-control" name="horas_extra" placeholder="Horas extra">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-eur"></i>
									</span>
									<input type="number" step="0,01" class="form-control" name="pago_base" placeholder="Pago base">
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-eur"></i>
									</span>
									<input type="number" step="0,01" class="form-control" name="pago_extra" placeholder="Pago extra">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-time"></i>
									</span>
									<input type="number" step="0,5" class="form-control" name="total_horas" placeholder="Total horas">
								</div>
								<div class="col-md-6">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-eur"></i>
									</span>
									<input type="number" step="0,01" class="form-control" name="total_pago" placeholder="Total pago">
								</div>
							</div>
						</div>
						<button type="submit" name="add_salary" class="btn btn-danger" style="margin-left:100px">Agregar nómina</button>
						<button type="submit" name="back" class="btn btn-primary" style="margin-left:400px">Volver atras</button>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>