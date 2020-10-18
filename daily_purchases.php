<?php
	$page_title='Compra diaria';
	require_once('includes/load.php');
	page_require_level(3);
?>
<?php
	$year=date('Y');
	$month=date('m');
	$purchases=dailyPurchases($year,$month);
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
	<div class="col-md-6">
		<?php echo display_msg($msg); ?>
	</div>
</div>
<div class="row">
    <center><img src="libs/images/logo.jpg" alt="logo"></center><br>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<strong>
					<span class="glyphicon glyphicon-th"></span>
					<span>Compra diaria</span>
				</strong>
			</div>
			<div class="panel-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center" style="width:50px;">#</th>
							<th>Descripción</th>
							<th class="text-center" style="width:15%;">Cantidad comprada</th>
							<th class="text-center" style="width:15%;">Total (€)</th>
							<th class="text-center" style="width:15%;">Fecha</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($purchases as $purchase): ?>
						<tr>
							<td class="text-center"><?php echo count_id(); ?></td>
							<td><?php echo remove_junk($purchase['name']); ?></td>
							<td class="text-center"><?php echo (int)$purchase['qty']; ?></td>
							<td class="text-center"><?php echo remove_junk($purchase['total_purchasing_price']); ?></td>
							<td class="text-center"><?php echo date("d/m/Y",strtotime ($purchase['date'])); ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>