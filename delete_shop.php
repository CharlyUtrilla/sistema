<?php
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$shop=find_by_id('shops',(int)$_GET['id']);
	if(!$shop){
		$session->msg("d","ID vacío");
		redirect('shops.php');
	}
?>
<?php
	$delete_id=delete_by_id('shops',(int)$shop['id']);
	if($delete_id){
		$session->msg("s","Tienda eliminada.");
		redirect('shops.php');
	}else{
		$session->msg("d","La eliminación falló.");
		redirect('shops.php');
	}
?>