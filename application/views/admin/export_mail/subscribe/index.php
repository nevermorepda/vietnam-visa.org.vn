<div class="cluster">
	<div class="container-fluid">
		<div class="tool-bar clearfix">
			<h1 class="page-title">
				<div class="pull-left">
					Mail subscribe
					<br><button type="button" class="btn btn-success btn-export">Export mail</button><br><br>
				</div>
				<div class="pull-right" style="max-width: 220px;">
					<ul class="action-icon-list">
						<li><a href="#" class="btn-unpublish"><i class="fa fa-eye-slash" aria-hidden="true"></i> Clock</a></li>
						<li><a href="#" class="btn-publish"><i class="fa fa-eye" aria-hidden="true"></i> Unclock</a></li>
						<li><a href="#" class="btn-delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
					</ul>
					<div class="input-group input-group-sm" style="margin-top: 10px;">
						<input type="text" class="form-control daterange">
						<span class="input-group-btn">
							<button class="btn btn-default btn-report" type="submit">Report</button>
						</span>
					</div>
				</div>
			</h1>
		</div>
		<? if (empty($items) || !sizeof($items)) { ?>
		<p class="help-block">No item found.</p>
		<? } else { ?>
		<form id="frm-admin" name="adminForm" action="" method="POST">
			<input type="hidden" id="task" name="task" value="">
			<input type="hidden" id="boxchecked" name="boxchecked" value="0" />
			<input type="hidden" id="fromdate" name="fromdate" value="<?=$fromdate?>" />
			<input type="hidden" id="todate" name="todate" value="<?=$todate?>" />
			<table class="table table-bordered table-hover">
				<tr>
					<th class="text-center" width="30px">#</th>
					<th class="text-center" width="30px">
						<input type="checkbox" id="toggle" name="toggle" onclick="checkAll('<?=sizeof($items)?>');" />
					</th>
					<th>Email</th>
				</tr>
				<?
					$i = 0;
					foreach ($items as $item) {
				?>
				<tr class="row<?=$item->active?>">
					<td class="text-center">
						<?=($i + 1)?>
					</td>
					<td class="text-center">
						<input type="checkbox" id="cb<?=$i?>" name="cid[]" value="<?=$item->id?>" onclick="isChecked(this.checked);">
					</td>
					<td>
						<a><?=$item->email?></a>
						<ul class="action-icon-list">
							<li><a href="#" onclick="return confirmBox('Delete items', 'Are you sure you want to delete the selected items?', 'itemTask', ['cb<?=$i?>', 'delete']);"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
							<? if ($item->active) { ?>
							<li><a href="#" onclick="return itemTask('cb<?=$i?>','unpublish');"><i class="fa fa-eye-slash" aria-hidden="true"></i> Clock</a></li>
							<? } else { ?>
							<li><a href="#" onclick="return itemTask('cb<?=$i?>','publish');"><i class="fa fa-eye" aria-hidden="true"></i> Unclock</a></li>
							<? } ?>
						</ul>
					</td>
				</tr>
				<?
						$i++;
					}
				?>
			</table>
		</form>
		<? } ?>
	</div>
</div>

<script>
$(document).ready(function() {
	if ($(".daterange").length) {
		$(".daterange").daterangepicker({
			startDate: "<?=date('m/d/Y', strtotime((!empty($fromdate)?$fromdate:"now")))?>",
			endDate: "<?=date('m/d/Y', strtotime((!empty($todate)?$todate:"now")))?>"
		});
	}
	$(".btn-publish").click(function(e){
		e.preventDefault();
		if ($("#boxchecked").val() == 0) {
			messageBox("ERROR", "Error", "Please make a selection from the list to publish.");
		}
		else {
			submitButton("publish");
		}
	});
	$(".btn-unpublish").click(function(e){
		e.preventDefault();
		if ($("#boxchecked").val() == 0) {
			messageBox("ERROR", "Error", "Please make a selection from the list to unpublish.");
		}
		else {
			submitButton("unpublish");
		}
	});
	$(".btn-delete").click(function(e){
		e.preventDefault();
		if ($("#boxchecked").val() == 0) {
			messageBox("ERROR", "Error", "Please make a selection from the list to delete.");
		}
		else {
			confirmBox("Delete items", "Are you sure you want to delete the selected items?", "submitButton", "delete");
		}
	});
	$(".btn-report").click(function(){
		$("#fromdate").val($(".daterange").data("daterangepicker").startDate.format('YYYY-MM-DD'));
		$("#todate").val($(".daterange").data("daterangepicker").endDate.format('YYYY-MM-DD'));
		submitButton("report");
	});
	$(".btn-export").click(function(){
		$("#fromdate").val($(".daterange").data("daterangepicker").startDate.format('YYYY-MM-DD'));
		$("#todate").val($(".daterange").data("daterangepicker").endDate.format('YYYY-MM-DD'));
		submitButton("export");
	});
});
</script>