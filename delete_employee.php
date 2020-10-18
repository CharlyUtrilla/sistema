<?php
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$employee=find_by_id('employees',(int)$_GET['id']);
	if(!$employee){
		$session->msg("d","ID vacío");
		redirect('employees.php');
	}
?>
<?php
	$delete_id=delete_by_id('employees',(int)$employee['id']);
	if($delete_id){
		$session->msg("s","Empleado eliminado.");
		redirect('employees.php');
	}else{
		$session->msg("d","La eliminación falló.");
		redirect('employees.php');
	}
?>