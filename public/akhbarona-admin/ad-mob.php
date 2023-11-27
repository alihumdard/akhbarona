<?php
	include_once 'action/SQLServices.php';
	$sqlObj			=	new SQLServices();
	$query			=	"select * from admob_status";
	$result			=	$sqlObj->executequery($query);
	$arr			=	$sqlObj->getAssoc($result);
?>
<form class="form-horizontal" role="form">
<div class="form-group">
	<label class="col-md-2 control-label">Enable or Disable Ad Mob Banner</label>
	<div class="col-md-10">
		<?php 
			if($arr['admob_status']==1){
		?>
				<input type="checkbox" checked="checked" onclick="onClickAdMobCheckbox(this)">
		<?php 		
			}else{
		?>
				<input type="checkbox" onclick="onClickAdMobCheckbox(this)">
		<?php 		
			}
		
		?>
	</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label">Enable or Disable Ad Mob Full Screen</label>
	<div class="col-md-10">
		<?php 
			if($arr['admob_full_status']==1){
		?>
				<input type="checkbox" checked="checked" onclick="onClickAdMobFullCheckbox(this)">
		<?php 		
			}else{
		?>
				<input type="checkbox" onclick="onClickAdMobFullCheckbox(this)">
		<?php 		
			}
		
		?>
	</div>
</div>
</form>
