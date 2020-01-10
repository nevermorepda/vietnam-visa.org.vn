<div class="requirement-banner">
	<div class="container">
		<div class="alternative-breadcrumb">
		<? require_once(APPPATH."views/module/breadcrumb.php"); ?>
		</div>
	</div>
</div>

<!-- <div class="" style="background-color: #f5f6f7; padding-top: 30px; padding-bottom: 30px;">
	<div class="container">
		<p>A valid Vietnam visa is required for almost foreign travelers to Vietnam for any purposes from visiting their beloved to going on a business trip or leisure vacation. Fortunately, it is much easier these days for foreign passport holders to apply for visa to Vietnam as there are two available ways to go about this matter:</p>
		<p><span class="glyphicon glyphicon-check"></span> Apply for a <strong>visa at Vietnam Embassy</strong>; OR</p>
		<p><span class="glyphicon glyphicon-check"></span> Apply for a <strong>visa on arrival</strong>.</p>
		<p>Applicants may choose one of the two options above to apply for their visas to Vietnam. But, please keep in mind that these two options for visa application are quite different in terms of application procedure and applicable applicants. While all travelers can apply for a visa at Vietnam Embassy, only those who travel to Vietnam by air can apply for a visa on arrival.</p>
		<p>However, visa on arrival is not available for all those who travel to Vietnam by air and the required documents to apply for a visa on arrival may vary from nationality to nationality.</p>
		<p class="red">Please kindly check the list below and see if visa on arrival is available for your nationality and what you need to provide us to apply for a visa on arrival.</p>
	</div>
</div> -->

<div class="" style="padding-top: 30px; padding-bottom: 30px;">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div id="check-requirement-container" style="padding-bottom: 30px;">
					<div class="content">
						<form id="frmCheckRequirement" action="<?=site_url("visa-requirements")?>" method="POST">
							<div class="clearfix">
								<label class="f24" style="padding-bottom: 10px;">Vietnam visa requirements for citizens of</label>
								<div class="input-group">
									<select name="citizen" id="citizen" class="form-control">
										<option value="">Select your nationality</option>
										<? foreach($nations as $nation) {
											echo "<option value='{$nation->alias}'>{$nation->name}</option>";
										} ?>
									</select>
									<script>$('#citizen').val('<?=$citizen?>');</script>
									<span class="input-group-btn">
									</span>
									<span class="input-group-btn">
										<input type="submit" class="btn btn-danger" value="CHECK REQUIREMENT">
									</span>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h1 class="f18" style="margin-top: 10px; margin-bottom: 10px;"><?=$item->title?></h1>
					</div>
					<div class="panel-body">
					<? if (!empty($item)) { ?>
						<?=$item->content?>
						<div class="center" style="padding-top: 20px;">
							<a class="btn btn-danger" title="Apply Visa" href="<?=site_url("apply-visa")?>"> APPLY VISA NOW <i class="icon-double-angle-right icon-large"></i> </a>
						</div>
					<? } ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="wg wg_1 p-4">
					<div class="wg_h">
						<h3 class="wg_t">Why apply with us</h3>
					</div>
					<div class="wg_m wg_1m">
						<ul class="lt1">
							<li>1-2 working days processing</li>
							<li>No Hidden Charges</li>
							<li>Prompt Support via chat, email, phone</li>
							<li>Accept Credit/Debit Cards</li>
							<li>100% money back guarantee for declined applications</li>
						</ul>
						<a href="<?=site_url("apply-visa")?>" class="btn btn-1 btn-block wg_1b">Apply Now</a>
					</div>
				</div>
				<div class="wg wg_2 p-4">
					<div class="wg_h">
						<h3 class="wg_t">Need more help?</h3>
					</div>
					<div class="wg_m wg_2m">
						<p><span class="d-block">Contact us at:</span></p>
						<p><strong class="wg_2n d-block"><?=HOTLINE?></strong></p>
						<p><time class="wg_2z z_14 d-block">(8.00 AM-16.00 PM, GMT +7, Whatsapp)</time></p>
						<p><span class="wg_2s d-block">or <a href="<?=site_url("contact")?>">submit your inquiry online</a></span></p>
					</div>
	 			</div>
			</div>
		</div>
	</div>
</div>

<script>
	$("#citizen").change(function() {
	  var action = $(this).val();
	  $("#frmCheckRequirement").attr("action", "<?=base_url('visa-requirements')?>/" + action + '.html');
	});
</script>
