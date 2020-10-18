<?php
	$page_title='Agregar grupo';
	require_once('includes/load.php');
	page_require_level(1);
?>
<?php
	if(isset($_POST['add'])){
		$req_fields=array('group-name','group-level');
		validate_fields($req_fields);
		if(find_by_groupName($_POST['group-name'])===false ){
			$session->msg('d','<b>Error!</b> El nombre de grupo ya existe en la base de datos.');
			redirect('add_group.php',false);
		}elseif(find_by_groupLevel($_POST['group-level'])===false){
			$session->msg('d','<b>Error!</b> El nombre de grupo ya existe en la base de datos.');
			redirect('add_group.php',false);
		}
		if(empty($errors)){
			$name=remove_junk($db->escape($_POST['group-name']));
			$level=remove_junk($db->escape($_POST['group-level']));
			$status=remove_junk($db->escape($_POST['status']));
			$query= "INSERT INTO user_groups (";
			$query.="group_name,group_level,group_status";
			$query.=") VALUES (";
			$query.="'{$name}','{$level}','{$status}'";
			$query.=")";
			if($db->query($query)){
				$session->msg('s',"El grupo ha sido creado.");
				redirect('add_group.php',false);
			}else{
				$session->msg('d','No se pudo crear el grupo.');
				redirect('add_group.php',false);
			}
		}else{
			$session->msg("d",$errors);
			redirect('add_group.php',false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: group.php");
	}
?>
<?php include_once('layouts/header.php'); ?>
<div align="center"><img src="libs/images/logo.jpg" alt="logo"></div>
<div class="login-page">
    <div class="text-center">
        <h3>Agregar grupo de usurios</h3>
    </div>
    <?php echo display_msg($msg); ?>
    <form method="post" action="add_group.php" class="clearfix">
        <div class="form-group">
            <label for="name" class="control-label">Nombre del grupo</label>
            <input type="name" class="form-control" name="group-name" required>
        </div>
        <div class="form-group">
            <label for="level" class="control-label">Nivel del grupo</label>
            <input type="number" class="form-control" name="group-level">
        </div>
        <div class="form-group">
			<label for="status">Estado</label>
            <select class="form-control" name="status">
				<option value="1">Activo</option>
				<option value="0">Inactivo</option>
            </select>
        </div>
		<div class="form-group clearfix">
			<button type="submit" name="add" class="btn btn-danger" style="margin-left:20px">Guardar</button>
		</div>
	</form>
	<form action="group.php" method="posr">
		<button type="submit" name="back" class="btn btn-primary" style="margin-left:20px">Volver atras</button>
	</form>
</div>
<?php include_once('layouts/footer.php'); ?>