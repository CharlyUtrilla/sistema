<?php
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$client=find_by_id('clients',(int)$_GET['id']);
	if(!$client){
		$session->msg("d","ID vacío");
		redirect('clients.php');
	}
?>
<?php
	$delete_id=delete_by_id('clients',(int)$client['id']);
	if($delete_id){
		$session->msg("s","Cliente eliminado.");
		redirect('clients.php');
	}else{
		$session->msg("d","La eliminación falló.");
		redirect('clients.php');
	}
?>