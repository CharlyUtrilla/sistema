<?php
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$material=find_by_id('materials',(int)$_GET['id']);
	if(!$material){
		$session->msg("d","ID vacío");
		redirect('materials.php');
	}
?>
<?php
	$delete_id=delete_by_id('materials',(int)$material['id']);
	if($delete_id){
		$session->msg("s","Material eliminado.");
		redirect('materials.php');
	}else{
		$session->msg("d","La eliminación falló.");
		redirect('materials.php');
	}
?>