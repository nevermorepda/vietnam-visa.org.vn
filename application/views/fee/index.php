<?
	$document_required = $this->m_visa_fee->search($current_nation->id)->document_required;
	
	$tourist_1ms = $this->m_visa_fee->cal_visa_fee("1ms", 1, "", $current_nation->name);
	$tourist_1mm = $this->m_visa_fee->cal_visa_fee("1mm", 1, "", $current_nation->name);
	$tourist_3ms = $this->m_visa_fee->cal_visa_fee("3ms", 1, "", $current_nation->name);
	$tourist_3mm = $this->m_visa_fee->cal_visa_fee("3mm", 1, "", $current_nation->name);
	$tourist_6mm = $this->m_visa_fee->cal_visa_fee("6mm", 1, "", $current_nation->name);
	$tourist_1ym = $this->m_visa_fee->cal_visa_fee("1ym", 1, "", $current_nation->name);
	
	$business_1ms = $this->m_visa_fee->cal_visa_fee("1ms", 1, "", $current_nation->name, "business");
	$business_1mm = $this->m_visa_fee->cal_visa_fee("1mm", 1, "", $current_nation->name, "business");
	$business_3ms = $this->m_visa_fee->cal_visa_fee("3ms", 1, "", $current_nation->name, "business");
	$business_3mm = $this->m_visa_fee->cal_visa_fee("3mm", 1, "", $current_nation->name, "business");
	$business_6mm = $this->m_visa_fee->cal_visa_fee("6mm", 1, "", $current_nation->name, "business");
	$business_1ym = $this->m_visa_fee->cal_visa_fee("1ym", 1, "", $current_nation->name, "business");
	
	$tourist_urgent_fee		= $this->m_processing_fee->search("tourist_1ms_urgent");
	$tourist_emergency_fee	= $this->m_processing_fee->search("tourist_1ms_emergency");
	$business_urgent_fee	= $this->m_processing_fee->search("business_1ms_urgent");
	$business_emergency_fee	= $this->m_processing_fee->search("business_1ms_emergency");

	$processing_fee = $this->m_processing_fee->load(1);
	
	$arrival_ports = $this->m_arrival_port->items(NULL, 1);
	$fc_ports = array();
	$car_ports = array();
	foreach ($arrival_ports as $arrival_port) {
		if (in_array($arrival_port->code, array("SGN", "HAN", "DAN", "CXR"))) {
			$fc_ports[] = $arrival_port;
			$car_ports[] = $arrival_port;
		}
	}
	$price_nation = $this->m_visa_fee->search($current_nation->id);
?>

<div class="fees">
	<div class="container">
		<div class="alternative-breadcrumb">
		<? require_once(APPPATH."views/module/breadcrumb.php"); ?>
		</div>
	</div>
	<div class="slide-bar">
		<div class="slide-wrap">
			<div style="padding-top: 80px; padding-bottom: 80px;">
				<div class="cluster" style="background-color: #008bc8; color: #fff;">
					<div class="container">
						<div class="cluster-body">
							<div class="text-center">
								<h3 class="hw-opt-title">List of eligible countries for a Vietnam visa</h3>
								<p>The following <?=sizeof($nationalities)?> countries and territories can obtain Vietnam visa on arrival</p>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<select class="form-control" id="nation" name="nation">
										<option value="" nation-id="">Choose Nationality</option>
										<? foreach ($nationalities as $nationality) { ?>
											<option value="<?=$nationality->alias?>" nation-id="<?=$nationality->id?>"><?=$nationality->name?></option>
										<? } ?>
									</select>
									<script>
										$('#nation').val('<?=!empty($current_nation->alias) ? $current_nation->alias : null?>');
										$('#nation').on('change', function(e) {
											var get_request = window.location.href;
											get_request = get_request.split('visa-fee');

											if ($(this).val() != "") {
												href_request = get_request[0]+'visa-fee/'+$(this).val()+'.html';
											} else {
												href_request = get_request[0]+'visa-fee.html';
											}
											window.location.href = href_request;
										});
									</script>
									<div class="available-visa display-none">
										<ul class="ul-processing">
											<li class="voa-not-available">The Vietnam visa on arrival is not available for your nationality. Please contact to <a style="color: #fff; text-decoration: underline;" href="<?=site_url("vietnam-embassies")?>">Vietnam Embassies</a> at your country to apply.</li>
											<li class="voa-available">You are eligible to apply for visa Vietnam</li>
											<li class="voa-business">Business visa available</li>
											<li class="voa-tourist">Tourist visa available</li>
										</ul>
										<div class="text-center voa-button">
											<a class="btn btn-success" href="<?=site_url("apply-visa")?>">APPLY VISA</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="cluster"> 
	<div class="container">
		<div class="cluster-heading" >
			<div class="text-center">
				<h1 style="text-shadow: 3px 3px #bdbdbd;font-family: Roboto,Tahoma,sans-serif;font-size: 35px;">VIETNAM E-VISA<? if (!empty($current_nation)) { ?> FOR <span class="text-color-red"><?=strtoupper($current_nation->name)?></span><? } ?></h1>
				<div class="heading-div"></div>
				<? if (!sizeof($tourist_visa_types) && !sizeof($business_visa_types)) { ?>
				<h4 class="text-color-red">The Vietnam visa on arrival (VOA) is not available for your nationality. Please contact to <a class="text-color-red" href="<?=site_url("vietnam-embassies/{$current_nation->alias}")?>"><u>Vietnam Embassies</u></a> at your country to apply.</h4>
				<? } ?>
			</div>
		</div>
		<div class="cluster-body wow fadeInUp " style="padding-bottom:30px;" >
			<div class="service-fees">
				<? if ($document_required) { ?>
				<br>
				<div class="alert alert-warning">
					<p>We are pleased to inform that <span class="red f16"><?=$current_nation->name?></span> is listed in the special nation list of the Vietnam Immigration Department. It takes more time for Vietnam Immigration Department to check carefully and process visa.</p>
					<p>In order to process your visa, please contact us via email address <a class="red" title="email" href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a> and supply us your:</p>
					<ul>
						<li><strong>Passport scan (personal informative page)</strong></li>
						<li><strong>Date of arrival and exit</strong></li>
						<li><strong>Purpose to enter Vietnam: business invitation letter or booking tour voucher of travel agency in Vietnam</strong></li>
						<li><strong>Flight ticket</strong></li>
						<li><strong>Hotel booking or staying address</strong></li>
					</ul>
					<p>The Vietnam Immigration Department will check your status within 2 days. Then we will inform the result for you. If your visa application is approved, we will send you the notification including the visa letter.</p>
					<p>For further questions please feel free to contact us via email <a class="red" title="email" href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a></p>
				</div>
				<? } ?>
				<div class="visa-fee">
					<?
						$normal_pr_time = "24-48 working hours";
						$can_rush = TRUE;
						if ($document_required) {
							$normal_pr_time = "5-7 working days";
							$can_rush = FALSE;
						}
					
						if (sizeof($tourist_visa_types)) {
							$row_number_service = 2;
							$col_number_service = 3;
					?>
					<div class="tourist-visa-fee">
						<table class="table table-bordered pricing-table">
							<tr>
								<th class="text-left" rowspan="<?=$row_number_service?>">TYPES OF VISA</th>
								<th class="text-center" colspan="<?=$col_number_service?>">VIETNAM TOURIST E-VISA FEE</th>
								<th class="text-center" rowspan="<?=$row_number_service?>">STAMPING FEE</th>
							</tr>
							<tr>
								<th class="sub-heading text-center" colspan="<?=$col_number_service-2?>">NORMAL PROCESSING <br>(<?=$normal_pr_time?>)</th>
								<th class="sub-heading text-center red" rowspan="<?=$row_number_service-1?>">URGENT <br>(4-8 working hours)</th>
								<th class="sub-heading text-center red" rowspan="<?=$row_number_service-1?>">EMERGENCY <br>(1-4 working hours)</th>
							</tr>
							<tr>
								<td class="text-left">For tourist</td>
								<td class="text-center"><?=$price_nation->evisa_tourist_1ms?></td>
								<td class="text-center">
									<? if ($can_rush) { ?>
									<span class="red">Plus <?=$processing_fee->evisa_tourist_1ms_urgent?> USD/pax</span>
									<? } else { ?>
									NA
									<? } ?>
								</td>
								<td class="text-center">
									<? if ($can_rush) { ?>
									<span class="red">Plus <?=$processing_fee->evisa_tourist_1ms_emergency?> USD/pax</span>
									<? } else { ?>
									NA
									<? } ?>
								</td>
								<td class="text-center">25 USD/pax</td>
							</tr>
							<tr>
								<td class="text-left">For business</td>
								<td class="text-center"><?=$price_nation->evisa_business_1ms?></td>
								<td class="text-center">
									<? if ($can_rush) { ?>
									<span class="red">Plus <?=$processing_fee->evisa_business_1ms_urgent?> USD/pax</span>
									<? } else { ?>
									NA
									<? } ?>
								</td>
								<td class="text-center">
									<? if ($can_rush) { ?>
									<span class="red">Plus <?=$processing_fee->evisa_business_1ms_emergency?> USD/pax</span>
									<? } else { ?>
									NA
									<? } ?>
								</td>
								<td class="text-center">25 USD/pax</td>
							</tr>
						</table>
					</div>
					<? } ?>
				</div>
			</div>
		</div>


		<div class="cluster-heading">
			<div class="text-center">
				<h1 style="text-shadow: 3px 3px #bdbdbd;font-family: Roboto,Tahoma,sans-serif;font-size: 35px;">VIETNAM VISA ON ARRIVAL<? if (!empty($current_nation)) { ?> FOR <span class="text-color-red"><?=strtoupper($current_nation->name)?></span><? } ?></h1>
				<div class="heading-div"></div>
				<? if (!sizeof($tourist_visa_types) && !sizeof($business_visa_types)) { ?>
				<h4 class="text-color-red">The Vietnam visa on arrival (VOA) is not available for your nationality. Please contact to <a class="text-color-red" href="<?=site_url("vietnam-embassies/{$current_nation->alias}")?>"><u>Vietnam Embassies</u></a> at your country to apply.</h4>
				<? } ?>
			</div>
		</div>
		<div class="cluster-body wow fadeInUp">
			<div class="service-fees">
				<? if ($document_required) { ?>
				<br>
				<div class="alert alert-warning">
					<p>We are pleased to inform that <span class="red f16"><?=$current_nation->name?></span> is listed in the special nation list of the Vietnam Immigration Department. It takes more time for Vietnam Immigration Department to check carefully and process visa.</p>
					<p>In order to process your visa, please contact us via email address <a class="red" title="email" href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a> and supply us your:</p>
					<ul>
						<li><strong>Passport scan (personal informative page)</strong></li>
						<li><strong>Date of arrival and exit</strong></li>
						<li><strong>Purpose to enter Vietnam: business invitation letter or booking tour voucher of travel agency in Vietnam</strong></li>
						<li><strong>Flight ticket</strong></li>
						<li><strong>Hotel booking or staying address</strong></li>
					</ul>
					<p>The Vietnam Immigration Department will check your status within 2 days. Then we will inform the result for you. If your visa application is approved, we will send you the notification including the visa letter.</p>
					<p>For further questions please feel free to contact us via email <a class="red" title="email" href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a></p>
				</div>
				<? } ?>
				<div class="visa-fee">
					<?
						$normal_pr_time = "24-48 working hours";
						$can_rush = TRUE;
						if ($document_required) {
							$normal_pr_time = "5-7 working days";
							$can_rush = FALSE;
						}
					
						if (sizeof($tourist_visa_types)) {
							$row_number_service = 2;
							$col_number_service = 3;
					?>
					<div class="row fees-callout-tourist-visa">
						<div class="col-sm-6">
							<h3>VIETNAM TOURIST VISA</h3>
							<p>Vietnam Tourist Visa or Vietnam Travel Visa (DL Category) is issued to those who wish to arrive in Vietnam for the purpose of visiting family members or friends or other personal affairs. In general, Tourist Visa is good for TOURISM purposes only.</p>
							<br>
						</div>
						<div class="col-sm-6" style="padding: 0px;">
							<img class="full-width" alt="" src="<?=IMG_URL?>fees/tourist-visa-fee.jpg">
						</div>
					</div>
					<div class="tourist-visa-fee">
						<table class="table table-bordered pricing-table">
							<tr>
								<th class="text-left" rowspan="<?=$row_number_service?>">TYPES OF VISA</th>
								<th class="text-center" colspan="<?=$col_number_service?>">VIETNAM TOURIST VISA FEE</th>
								<th class="text-center" rowspan="<?=$row_number_service?>">STAMPING FEE</th>
							</tr>
							<tr>
								<th class="sub-heading text-center" colspan="<?=$col_number_service-2?>">NORMAL PROCESSING <br>(<?=$normal_pr_time?>)</th>
								<th class="sub-heading text-center red" rowspan="<?=$row_number_service-1?>">URGENT <br>(4-8 working hours)</th>
								<th class="sub-heading text-center red" rowspan="<?=$row_number_service-1?>">EMERGENCY <br>(1-4 working hours)</th>
							</tr>
							<?
								foreach ($tourist_visa_types as $visa_type) { 
							?>
							<tr>
								<td class="text-left"><?=$this->m_visa_type->load($visa_type)->name?></td>
								<td class="text-center"><?=${"tourist_{$visa_type}"}->service_fee?></td>
								<td class="text-center">
									<? if ($can_rush) { ?>
									<span class="red">Plus <?=$processing_fee->{"tourist_{$visa_type}_urgent"}?> USD/pax</span>
									<? } else { ?>
									NA
									<? } ?>
								</td>
								<td class="text-center">
									<? if ($can_rush) { ?>
									<span class="red">Plus <?=$processing_fee->{"tourist_{$visa_type}_emergency"}?> USD/pax</span>
									<? } else { ?>
									NA
									<? } ?>
								</td>
								<td class="text-center"><?=${"tourist_{$visa_type}"}->stamp_fee?> USD/pax</td>
							</tr>
							<? } ?>
						</table>
					</div>
					<? } ?>
					
					<?
						if (sizeof($business_visa_types)) {
							$row_number_service = 2;
							$col_number_service = 3;
					?>
					<div class="row fees-callout-business-visa">
						<div class="col-sm-6">
							<h3>VIETNAM BUSINESS VISA</h3>
							<p>Business Visa (DN Category) is issued to those who intend to go to Vietnam for business purposes, such as the negotiation of contracts, estate settlement, consultation with business associates, and participation in scientific, educational, professional or business conventions, conferences or seminars and other legitimate activities of a commercial or professional nature.</p>
							<br>
						</div>
						<div class="col-sm-6" style="padding: 0px;">
							<img class="full-width" alt="" src="<?=IMG_URL?>fees/business-visa-fee.jpg">
						</div>
					</div>
					<div class="business-visa-fee">
						<table class="table table-bordered pricing-table">
							<tr>
								<th class="text-left" rowspan="<?=$row_number_service?>">TYPES OF VISA</th>
								<th class="text-center" colspan="<?=$col_number_service?>">VIETNAM BUSSINESS VISA FEE</th>
								<th class="text-center" rowspan="<?=$row_number_service?>">STAMPING FEE</th>
							</tr>
							<tr>
								<th class="sub-heading text-center" colspan="<?=$col_number_service-2?>">NORMAL PROCESSING <br>(<?=$normal_pr_time?>)</th>
								<th class="sub-heading text-center red" rowspan="<?=$row_number_service-1?>">URGENT <br>(4-8 working hours)</th>
								<th class="sub-heading text-center red" rowspan="<?=$row_number_service-1?>">EMERGENCY <br>(1-4 working hours)</th>
							</tr>
							<?
								foreach ($tourist_visa_types as $visa_type) { 
								$price_nation = $this->m_visa_fee->search($current_nation->id);
							?>
							<tr>
								<td class="text-left"><?=$this->m_visa_type->load($visa_type)->name?></td>
								<td class="text-center"><?=${"business_{$visa_type}"}->service_fee?></td>
								<td class="text-center">
									<? if ($can_rush) { ?>
									<span class="red">Plus <?=$processing_fee->{"business_{$visa_type}_urgent"}?> USD/pax</span>
									<? } else { ?>
									NA
									<? } ?>
								</td>
								<td class="text-center">
									<? if ($can_rush) { ?>
									<span class="red">Plus <?=$processing_fee->{"business_{$visa_type}_emergency"}?> USD/pax</span>
									<? } else { ?>
									NA
									<? } ?>
								</td>
								<td class="text-center"><?=${"business_{$visa_type}"}->stamp_fee?> USD/pax</td>
							</tr>
							<? } ?>
						</table>
						
					</div>
					<? } ?>
					<? if (sizeof($tourist_visa_types) || sizeof($business_visa_types)) {?>
					<div style="margin-top: 15px;">
						<div class="vs-callout">
							<p><strong>There are 2 types of Vietnam visa fees you must be aware before applying for visa on arrival:</strong></p>
							<div id="stamping-fee">
								<h5 class="text-color-red"><strong>1. SERVICE FEE</strong></h5>
								<p>The service fee is for visa approval letter processing. Applicants may choose to pay the fee online with their bank account, Credit or Debit Card, PayPal or Western Union.</p>
								<br>
								<h5 class="text-color-red"><strong>2. STAMPING FEE</strong></h5>
								<p>The stamping fee is paid IN CASH to the Vietnam Immigration Officers at the arrival airport to get the visa stamp. Credit cards are not accepted.</p>
							</div>
						</div>
						<div class="text-center">
							<a title="Apply Visa" href="<?=BASE_URL_HTTPS."/apply-visa.html"?>" class="btn btn-danger"> APPLY FOR VIETNAM VISA </a>
						</div>
					</div>
					<? } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="cluster">
	<div class="container">
		<div class="cluster-heading wow fadeInUp">
			<div class="text-center">
				<h2>EXTRA SERVICES UPON ARRIVAL</h2>
				<div class="heading-div"></div>
				<h4>We specialize in airport fast track and pickup services to help passengers avoid endless hassles at the arrival airport.</h4>
			</div>
		</div>
		<div class="cluster-body wow fadeInUp">
			<div class="row fees-callout-fast-track">
				<div class="col-sm-6">
					<h3>AIRPORT FAST TRACK SERVICE</h3>
					<p>We provide Vietnam Visa Fast-Track Immigration Service as an alternative for those who get impatient waiting in queue at the Immigration Counter. Avoid the queues at the Vietnam international airport and treat yourself to a stress free service that will make your arrival smoother and easier.</p>
					<br>
				</div>
				<div class="col-sm-6" style="padding: 0px;">
					<img class="full-width" alt="" src="<?=IMG_URL?>fees/airport-fast-track.jpg">
				</div>
			</div>
			<table class="table table-bordered pricing-table">
				<tbody>
					<tr>
						<th class="text-left" rowspan="2">TYPES OF FAST TRACK</th>
						<th class="text-center" colspan="<?=sizeof($fc_ports)?>">AIRPORT</th>
					</tr>
					<tr>
					<? foreach ($fc_ports as $port) { ?>
						<th class="sub-heading text-center"><?=strtoupper($port->short_name)?></th>
					<? } ?>
					</tr>
					<tr>
						<td class="text-left">Airport Fast Track</td>
						<? foreach ($fc_ports as $port) { ?>
							<td class="text-center"><?=$this->m_fast_checkin_fee->search(1, $port->id)?> USD/<span class="pax-number">pax</span></td>
						<? } ?>
					</tr>
					<tr>
						<td class="text-left">Airport VIP Fast Track</td>
						<? foreach ($fc_ports as $port) { ?>
							<td class="text-center"><?=$this->m_fast_checkin_fee->search(2, $port->id)?> USD/<span class="pax-number">pax</span></td>
						<? } ?>
					</tr>
				</tbody>
			</table>
			<div class="vs-callout">
				<p><strong>Airport Fast Track</strong>: Passengers will be met at the Landing Visa Counter with their name on the welcome board and assisted in getting visa stamped without getting line. Our staff will ensure that all procedures are expedited at the airport.</p>
				<p><strong>VIP Airport Fast Track</strong>: Passengers will be met at the Landing Visa Counter with their name on the welcome board and assisted in getting visa stamped without getting line. We take care of collecting luggage at the baggage claim area and bring them to passengers’ vehicle. Alternatively, passengers will be escorted up to the arrival hall to the waiting driver.</p>
			</div>
			<br>
			<div class="row fees-callout-car-pickup">
				<div class="col-sm-6">
					<h3>AIRPORT PICKUP SERVICE</h3>
					<p>We offer Pickup Service with considerate and well-trained drivers to take you to your hotel door quickly and safely so as to help you feel comfortable at most.</p>
					<br>
				</div>
				<div class="col-sm-6" style="padding: 0px;">
					<img class="full-width" alt="" src="<?=IMG_URL?>fees/car-pickup.jpg">
				</div>
			</div>
			<table class="table table-bordered pricing-table">
				<tbody>
					<tr>
						<th class="text-left" rowspan="2">ECONOMY CAR PICK-UP</th>
						<th class="text-center" colspan="<?=sizeof($car_ports)?>">AIRPORT</th>
					</tr>
					<tr>
					<? foreach ($car_ports as $port) { ?>
						<th class="sub-heading text-center"><?=strtoupper($port->short_name)?></th>
					<? } ?>
					</tr>
					<tr>
						<td class="text-left">4 seats</td>
						<? foreach ($car_ports as $port) { ?>
							<td class="text-center"><?=$this->m_car_fee->search(4, $port->id)?> USD</td>
						<? } ?>
					</tr>
					<tr>
						<td class="text-left">7 seats</td>
						<? foreach ($car_ports as $port) { ?>
							<td class="text-center"><?=$this->m_car_fee->search(7, $port->id)?> USD</td>
						<? } ?>
					</tr>
					<tr>
						<td class="text-left">16 seats</td>
						<? foreach ($car_ports as $port) { ?>
							<td class="text-center"><?=$this->m_car_fee->search(16, $port->id)?> USD</td>
						<? } ?>
					</tr>
					<tr>
						<td class="text-left">24 seats</td>
						<? foreach ($car_ports as $port) { ?>
							<td class="text-center"><?=$this->m_car_fee->search(24, $port->id)?> USD</td>
						<? } ?>
					</tr>
				</tbody>
			</table>
			<div class="vs-callout">
				<p><strong>Economy Class Cars</strong>: Toyota Innova, Ford Everest, Chevrolet Captiva, Honda Civic</p>
			</div>
			<br>
			<div class="row fees-callout-visa-extension">
				<div class="col-sm-6">
					<h3>VIETNAM VISA EXTENSION</h3>
					<p>With the hope of offering clients more valuable assistance, we provide visa extension/renewal services for those whose Vietnam visas have come close to expiration dates and still wish to stay longer.</p>
					<br>
				</div>
				<div class="col-sm-6" style="padding: 0px;">
					<img class="full-width" alt="" src="<?=IMG_URL?>fees/visa-extension.jpg">
				</div>
			</div>
			<table class="table pricing-table">
				<tr>
					<th><strong>TYPE OF VISA</strong></th>
					<th><strong>EXTEND VIETNAM VISA</strong></th>
					<th><strong>RENEW VIETNAM VISA</strong></th>
				</tr>
				<tr>
					<td style="text-align: left">1 month single</td>
					<td class="text-center">60 USD - 155 USD</td>
					<td class="text-center">200 USD</td>
				</tr>
				<tr>
					<td style="text-align: left">1 month multiple</td>
					<td class="text-center">NA</td>
					<td class="text-center">NA</td>
				</tr>
				<tr>
					<td style="text-align: left">3 months single</td>
					<td class="text-center">180 USD - 310 USD</td>
					<td class="text-center">330 USD</td>
				</tr>
				<tr>
					<td style="text-align: left">3 months multiple</td>
					<td class="text-center">320 USD - 350 USD</td>
					<td class="text-center">350 USD</td>
				</tr>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function($) {
		$('.btn-check').click(function(event) {
			window.location.href = "<?=BASE_URL?>" + "/visa-fee/" + $("#nation").val() + ".html";
		});

		$("#nation").change(function(){
			$(".available-visa").hide();
			if ($(this).val() != "") {
				var p = {};
				p["nation_id"] = $(this).find("option:selected").attr("nation-id");
				
				$.ajax({
					type: "POST",
					url: BASE_URL + "/Visa-processing/ajax-check-visa-available.html",
					data: p,
					dataType: "json",
					success: function(result) {
						var types_of_tourist = result[0];
						var types_of_business = result[1];
						
						if (!types_of_tourist && !types_of_business) {
							$(".voa-not-available").show();
							$(".voa-available").hide();
							$(".voa-business").hide();
							$(".voa-tourist").hide();
							$(".voa-button").hide();
						} else {
							$(".voa-not-available").hide();
							$(".voa-available").show();
							$(".voa-button").show();
						}
						if (types_of_tourist) {
							$(".voa-tourist").show();
						} else {
							$(".voa-tourist").hide();
						}
						if (types_of_business) {
							$(".voa-business").show();
						} else {
							$(".voa-business").hide();
						}
						
						$(".available-visa").show();
					}
				});
			}
		});
	});
</script>