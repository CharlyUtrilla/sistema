<?php
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$salary=find_by_id('salary',(int)$_GET['id']);
	if(!$salary){
		$session->msg("d","ID vacío");
		redirect('salary.php');
	}
?>
<?php
	$delete_id=delete_by_id('salary',(int)$salary['id']);
	if($delete_id){
		$session->msg("s","Nómina eliminada.");
		redirect('salary.php');
	}else{
		$session->msg("d","La eliminación falló.");
		redirect('salary.php');
	}
?>