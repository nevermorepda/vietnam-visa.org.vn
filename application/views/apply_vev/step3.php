<?
	$service_fee_group = array();
	$nationality_group = array();
	foreach ($vev->nationality as $nationality) {
		if (array_key_exists($nationality, $nationality_group)) {
			$nationality_group[$nationality] = $nationality_group[$nationality] + 1;
		} else {
			$nationality_group[$nationality] = 1;
		}
	}
?>

<div class="apply-visa">
	<div class="slide-bar hidden">
		<div class="slide-wrap">
			<div class="slide-content">
				<div class="container">
					<div class="slide-text">
						<h1>APPLY VIETNAM VISA ONLINE</h1>
						<h4>Just a few steps fill in online form, you are confident to have Vietnam visa approval on your hand.</h4>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="visa-form">
		<div class="">
			<div class="container">
				<? require_once(APPPATH."views/module/breadcrumb.php"); ?>
				<div class="tab-step clearfix">
					<h1 class="note">Vietnam E-Visa Application Form</h1>
					<ul class="style-step d-none d-sm-none d-md-block">
						<li class="active"><a style="color: #fff;" href="<?=site_url('apply-e-visa')?>"><font class="number">1.</font> Visa Options</a></li>
						<li class="active"><font class="number">2.</font> Login Account</li>
						<li class="active"><a style="color: #fff;" href="<?=site_url('apply-e-visa/step2')?>"><font class="number">3.</font> Applicant Details</a></li>
						<li class="active"><font class="number">4.</font> Review & Payment</li>
					</ul>
				</div>
				
				<div class="form-apply" style="margin-top: 20px;">
					<form id="frmApply" class="form-horizontal" role="form" action="<?=site_url("apply-e-visa/completed")?>" method="POST">
						<div class="row clearfix">
							<div class="col-sm-12">
								<div class="group hidden">
									<h3 class="group-heading">Visa Option Summary</h3>
									<div class="group-content">
										<table class="table table-bordered table-striped">
											<tr>
												<th>Type of visa</th>
												<th>Purpose of visit</th>
												<th>Processing time</th>
												<th>Arrival date</th>
											</tr>
											<tr>
												<td><?=$this->util->getVisaType2String($vev->visa_type)?></td>
												<td><?=$vev->visit_purpose?></td>
												<td><?=$vev->processing_time?></td>
												<td><?=date("M d, Y", strtotime($vev->arrival_date))?></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="group hidden">
									<h3 class="group-heading">Arrival Port Details</h3>
									<div class="group-content">
										<table class="table table-bordered table-striped">
											<tr>
												<th>Arrival airpport</th>
												<th>Flight No. / Arrival time</th>
												<th>Private letter</th>
												<th>Car Pick-up</th>
												<th>Fast-track</th>
											</tr>
											<tr>
												<td><?=$this->m_arrival_port->load($vev->arrival_port)->airport?></td>
												<td class="text-center"><?=$vev->flightnumber.' - '.$vev->arrivaltime?></td>
												<td class="text-center"><?=($vev->private_visa?"Yes":"No")?></td>
												<td class="text-center"><?=($vev->car_pickup?$vev->car_type." (".$vev->num_seat." seats)":"No")?></td>
												<td class="text-center"><?=($vev->full_package?"Full package":($vev->fast_checkin?"Yes":"No"))?></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="group">
									<h3 class="group-heading">Passport Details</h3>
									<div class="group-content">
										<table class="table table-bordered table-striped">
											<tr>
												<th>No.</th>
												<th>Full name<br><span class="help-block">state in passport</span></th>
												<th>Gender</th>
												<th>Date of birth</th>
												<th>Nationality<br><span class="help-block">current passport</span></th>
												<th>Passport No.</th>
												<!-- <th>Type</th> -->
												<th>Expired date</th>
												<!-- <th>Religion</th> -->
											</tr>
											<? for ($i=1; $i<=$vev->group_size; $i++) { ?>
											<tr>
												<td class="text-center"><?=$i?></td>
												<td><?=$vev->fullname[$i]?></td>
												<td class="text-center"><?=$vev->gender[$i]?></td>
												<td><?=date("M d, Y", strtotime($vev->birthmonth[$i]."/".$vev->birthdate[$i]."/".$vev->birthyear[$i]))?></td>
												<td><?=$vev->nationality[$i]?></td>
												<td><?=$vev->passport[$i]?></td>
												<!-- <td><?//=$vev->passport_type[$i]?></td> -->
												<td><?=date("M d, Y", strtotime($vev->expirymonth[$i].'/'.$vev->expirydate[$i].'/'.$vev->expiryyear[$i]))?></td>
												<!-- <td><?//=$vev->religion[$i]?></td> -->
											</tr>
											<? } ?>
										</table>
									</div>
								</div>
							</div>
							<div class="col-lg-8 col-sm-8">
								<h3 class="group-heading">Payment method</h3>
								<p>Please select one of below payment method to proceed the visa application.</p>
								<br /><br />
								<div class="row">
									<div class="col-xs-4 col-sm-4 text-center">
										<label for="payment3"><img class="img-responsive" src="<?=IMG_URL?>payment/paypal.png" alt="Paypal" /></label>
										<br />
										<div class="radio">
											<label><input id="payment3" type="radio" name="payment" value="Paypal" checked="checked" />Credit Card by Paypal</label>
										</div>
									</div>
									<? if (defined("OP") && OP == "ON" && ($step1->processing_time != "Holiday")) { ?>
									<div class="col-xs-4 col-sm-4 text-center">
										<label for="payment1"><img class="img-responsive" src="<?=IMG_URL?>payment/onepay.png" alt="OnePay" /></label>
										<br />
										<div class="radio">
											<label><input id="payment1" type="radio" name="payment" value="OnePay" /> Credit Card by OnePay</label>
										</div>
									</div>
									<? } ?>
									<!-- <div class="col-xs-4 col-sm-4 text-center">
										<label for="payment4"><img class="img-responsive" src="<?=IMG_URL?>payment/western_union.png" alt="Western Union" /></label>
										<br />
										<div class="radio">
											<label><input id="payment4" type="radio" name="payment" value="Western Union" />Western Union</label>
										</div>
									</div> -->
									<!-- <div class="col-xs-4 col-sm-4 text-center">
										<label for="payment4"><img class="img-responsive" src="<?=IMG_URL?>banktransfer.png" alt="Bank Transfer" /></label>
										<br />
										<div class="radio">
											<label><input id="payment4" type="radio" name="payment" value="Bank Transfer" /> Bank Transfer</label>
										</div>
									</div> -->
								</div>
								<div class="">
									<label class="form-label">CAPTCHA <span class="required">*</span></label>
									<div class="clearfix">
										<div class="left">
											<input type="text" style="width: 100px" value="" id="security_code" name="security_code" required="" class="form-control">
										</div>
										<div class="left" style="margin-left: 10px; line-height: 30px;">
											<label class="security-code"><?=$this->util->createSecurityCode()?></label>
										</div>
									</div>
								</div>
								<div class="text-center">
									<a style="padding-left: 80px;padding-right: 80px;" class="btn btn-danger btn-1x" href="<?=site_url("apply-e-visa/step2")?>"><i class="fa fa-angle-left" aria-hidden="true"></i>&nbsp;&nbsp; BACK</a>
									<button style="    margin: 10px;" class="btn btn-danger btn-1x btn-next" type="submit">SUBMIT TO PAYMENT &nbsp;&nbsp;<i class="fa fa-angle-right" aria-hidden="true"></i></button>
								</div>
							</div>
							<div class="col-lg-4 col-sm-4">
								<div class="panel-fees">
									<h3 class="panel-heading" style="padding: 10px;font-size: 25px;">Visa Fees</h3>
									<div class="panel-body">
										<ul>
											<li class="clearfix hidden">
												<label>Passport holder:</label>
												<span class="passport_holder_t"><?=$vev->passport_holder?></span>
											</li>
											<li class="clearfix">
												<label>Number of persons:</label>
												<span class="group_size_t"><?=$vev->group_size?> <?=($vev->group_size>1?"people":"person")?></span>
											</li>
											<li class="clearfix">
												<label>Type of visa:</label>
												<span class="visa_type_t"><?=$this->util->getVisaType2String($vev->visa_type)?></span>
											</li>
											<li class="clearfix">
												<label>Purpose of visit:</label>
												<span class="visit_purpose_t"><?=$vev->visit_purpose?></span>
											</li>
											<li class="clearfix">
												<label>Arrival airport:</label>
												<span class="arrival_port_t"><?=$vev->arrival_port?></span>
											</li>
											<li class="clearfix">
												<label>Arrival date:</label>
												<span class="arrival_date_t"><?=date("M/d/Y", strtotime($vev->arrival_date))?></span>
											</li>
											<li class="clearfix">
												<label>Exit port:</label>
												<span class="exit_port_t"><?=$vev->exit_port?></span>
											</li>
											<!-- <li class="clearfix">
												<label>Exit date:</label>
												<span class="arrival_date_t"><?//=date("M/d/Y", strtotime($vev->exit_date))?></span>
											</li> -->
											<li class="clearfix">
												<label>Visa stamping fee:</label>
												<span class="total_stamping_fee_t price pointer" data-toggle="collapse" data-target="#stamping-fee-detail"><?=$vev->stamp_fee*$vev->group_size?> $ <i class="fa fa-chevron-circle-down"></i></span>
												<div id="stamping-fee-detail" class="stamping-fee-detail text-right collapse">
													<span class="total_stamping_price price"><?=$vev->stamp_fee." $ x ".$vev->group_size." ".($vev->group_size>1?"people":"person")." = ".$vev->stamp_fee*$vev->group_size?> $</span>
												</div>
											</li>
											<li class="clearfix">
												<label>Visa service fee:</label>
												<span class="total_visa_price_t price pointer" data-toggle="collapse" data-target="#service-fee-detail"><?=$vev->total_service_fee?> $ <i class="fa fa-chevron-circle-down"></i></span>
												<div id="service-fee-detail" class="service-fee-detail text-right collapse">
													<?
													foreach ($nationality_group as $nationality => $count) {
														$visa_fee = $this->m_visa_fee->cal_visa_fee($vev->visa_type, $vev->group_size, $vev->processing_time, $nationality, $vev->visit_purpose,null,2);
														$service_fee_group[$nationality] = $visa_fee->service_fee;
														$service_fee_detail  = '<div class="service-fee-item">';
														$service_fee_detail .= '<div class="text-right"><strong>'.$nationality.'</strong></div>';
														$service_fee_detail .= '<div class="price text-right">'.$visa_fee->service_fee.' $ x '.$count.' '.($count>1?"people":"person").' = '.($visa_fee->service_fee * $count).' $</div>';
														$service_fee_detail .= '</div>';
														echo $service_fee_detail;
													}
													?>
												</div>
											</li>
											<li class="clearfix <?=(($vev->processing_time != 'Normal')?'':'display-none')?>" id="processing_time_li">
												<div class="clearfix">
													<label>Processing time:</label>
													<span class="processing_note_t"><?=$vev->processing_time?></span>
												</div>
												<span class="processing_t price"><?=$vev->rush_fee." $ x ".$vev->group_size." ".($vev->group_size>1?"people":"person")." = ".$vev->rush_fee*$vev->group_size?> $</span>
											</li>
											<li class="clearfix <?=(!empty($vev->private_visa)?'':'display-none')?>" id="private_visa_li">
												<label>Private letter:</label>
												<span class="private_visa_t price"><?=$vev->private_visa_fee?> $</span>
											</li>
											<li class="clearfix <?=(!empty($vev->full_package)?'':'display-none')?>" id="full_package_li">
												<label>Full package service:</label>
												<div class="full_package_services">
													<div class="clearfix"><label>1. Government fee</label><span class='price'><?=$vev->stamp_fee?> $ x <?=$vev->group_size?> <?=($vev->group_size>1?"people":"person")?> = <?=$vev->stamp_fee*$vev->group_size?> $</span></div>
													<div class="clearfix"><label>2. Airport fast check-in</label><span class='price'><?=$vev->full_package_fc_fee?> $ x <?=$vev->group_size?> <?=($vev->group_size>1?"people":"person")?> = <?=$vev->full_package_fc_fee*$vev->group_size?> $</span></div>
												</div>
											</li>
											<li class="clearfix <?=(($vev->fast_checkin||$vev->car_pickup)?'':'display-none')?>" id="extra_service_li">
												<label>Airport assistance services:</label>
												<div class="extra_services">
													<?
														$serviceCnt = 1;
														if ($vev->fast_checkin==1) {
													?>
														<div class="clearfix"><label><?=($serviceCnt++)?>. Fast check-in</label><span class='price'><?=$vev->fast_checkin_fee?> $ x <?=$vev->group_size?> <?=($vev->group_size>1?"people":"person")?> = <?=$vev->fast_checkin_fee*$vev->group_size?> $</span></div>
													<?
														}
														if ($vev->fast_checkin==2) {
													?>
														<div class="clearfix"><label><?=($serviceCnt++)?>. VIP fast check-in</label><span class='price'><?=$vev->fast_checkin_fee?> $ x <?=$vev->group_size?> <?=($vev->group_size>1?"people":"person")?> = <?=$vev->fast_checkin_fee*$vev->group_size?> $</span></div>
													<?	
														}
														if ($vev->car_pickup) {
													?>
														<div class="clearfix"><label><?=($serviceCnt++)?>. Car pick-up</label><span class='price'>(<?=$vev->car_type?>, <?=$vev->num_seat?> seats) = <?=$vev->car_total_fee?> $</span></div>
													<?
														}
													?>
												</div>
											</li>
											<li class="clearfix <?=(!empty($vev->vip_discount)?'':'display-none')?>" id="vipsave_li">
												<label>VIP discount <span class="vipsavepercent_t"><?=$vev->vip_discount?>%</span></label>
												<span class="vipsave_t price">- <?=round($vev->total_service_fee * $vev->vip_discount/100)?> $</span>
											</li>
											<? if (!empty($vev->discount) || !empty($vev->member_discount)) { 
												$title_discount = 'Member discount';
												$discount = $vev->member_discount;
												if ($vev->discount_unit == "USD") {
													round($vev->discount,2);
												} else {
													if ($vev->member_discount < $vev->discount) {
														$title_discount = 'Promotion discount';
														$discount = $vev->discount;
													}
												}
												$discount_fee = round(($vev->total_service_fee * $discount/100),2);
											?>
											<li class="clearfix <?=(!empty($discount)?'':'display-none')?>" id="promotion_li" style="background-color: #F8F8F8;">
												<div class="clearfix">
													<label class="left"><?=$title_discount?>:</label>
													<span class="promotion_t price">
													- <?=$discount_fee?> $
													<?="({$discount}{$vev->discount_unit})"?>
													</span>
												</div>
											</li>
											<? } ?>
											<li class="total clearfix">
												<br>
												<div class="clearfix">
													<label class="pull-left text-color-red">TOTAL FEE:</label>
													<div class="pull-right subtotal-price">
														<div class="price-block">
															<span class="price total_price"><?=$vev->total_fee?> $</span>
														</div>
													</div>
												</div>
												<!-- <div class="text-left" style="font-size: 14px;">
												<?// if ($vev->processing_time == "Holiday" || !empty($vev->full_package)) { ?>
													<i class="stamping_fee_included">(<a target="_blank" title="stamping fee" href="<?//=site_url("vietnam-visa-fees")?>#stamping-fee">stamping fee</a> included, no need to pay any extra fee)</i>
												<?// } else { ?>
													<i class="stamping_fee_excluded">(<a target="_blank" title="stamping fee" href="<?//=site_url("vietnam-visa-fees")?>#stamping-fee">stamping fee</a> is included)</i>
												<?// } ?>
												</div> -->
											</li>
										</ul>
									</div>
								</div>
								<div class="payment-methods">
									<img alt="" src="<?=IMG_URL?>payment-methods.jpg">
								</div>
							</div>
						</div>
						<input type="hidden" id="task" name="task" value=""/>
					</form>
				</div>
				<!-- <br>
				<div class="row">
					<div class="col-xs-4">
						<div class="text-center">
							<a><img alt="" src="<?=IMG_URL?>comodossl.png"></a>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="text-center">
							<a><img alt="" src="<?=IMG_URL?>siteadvisor.gif"></a>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="text-center">
							<a><img alt="" src="<?=IMG_URL?>https.png"></a>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</div>
