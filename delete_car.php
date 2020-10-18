<?php
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$car=find_by_id('cars',(int)$_GET['id']);
	if(!$car){
		$session->msg("d","ID vacío");
		redirect('cars.php');
	}
?>
<?php
	$delete_id=delete_by_id('cars',(int)$car['id']);
	if($delete_id){
		$session->msg("s","Vehículo eliminado.");
		redirect('cars.php');
	}else{
		$session->msg("d","La eliminación falló.");
		redirect('cars.php');
	}
?>