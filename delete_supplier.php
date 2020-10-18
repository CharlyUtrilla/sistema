<?php
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$supplier=find_by_id('suppliers',(int)$_GET['id']);
	if(!$supplier){
		$session->msg("d","ID vacío");
		redirect('suppliers.php');
	}
?>
<?php
	$delete_id=delete_by_id('suppliers',(int)$supplier['id']);
	if($delete_id){
		$session->msg("s","Proveedor eliminado.");
		redirect('suppliers.php');
	}else{
		$session->msg("d","La eliminación falló.");
		redirect('suppliers.php');
	}
?>