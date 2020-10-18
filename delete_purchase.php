<?php
	require_once('includes/load.php');
	page_require_level(3);
?>
<?php
	$d_purchase=find_by_id('purchases',(int)$_GET['id']);
	if(!$d_sale){
		$session->msg("d","ID vacío.");
		redirect('purchases.php');
	}
?>
<?php
	$delete_id=delete_by_id('purchases',(int)$d_purchase['id']);
	if($delete_id){
		$session->msg("s","Compra eliminada.");
		redirect('purchases.php');
	}else{
		$session->msg("d","Eliminación falló.");
		redirect('purchases.php');
	}
?>