<?
	// setcookie( "cookieOneDay", 'One day', strtotime( '+1 day'));
	//var_dump(setcookie( "cookieOneDay", 'One day', strtotime( '+1 day')));
// if (isset($_SERVER['HTTP_COOKIE'])) {
//     $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
//     foreach($cookies as $cookie) {
//         $parts = explode('=', $cookie);
//         $name = trim($parts[0]);
//         setcookie($name, '', time()-1000);
//         setcookie($name, '', time()-1000, '/');
//     }
// }
	$fee = $this->m_visa_fee->search(0);
	$processing_fee = $this->m_processing_fee->items()[0];
?>
<div class="slide-bar">
	<div class="slide-wrap">
		<div id="slideshow" class="slider">
			<div class="flexslider" style="background-image: url(<?=IMG_URL?>wizban/banner-visa-slider.jpg);"></div>
		</div>
		<div class="slide-content">
			<div class="container">
				<div class="slide-text">
					<h1>THE FASTEST WAY TO<br><span style="font-size: 62px;">GET A VISA</span></h1>
					<ul class="checklist d-none d-sm-none d-md-block">
						<li><i class="fa fa-check" aria-hidden="true"></i> <strong>Quick and easy</strong> – Only 4 steps to get the visa to Vietnam</li>
						<li><i class="fa fa-check" aria-hidden="true"></i> <strong>Accept credit cards</strong> – Low processing rates</li>
						<li><i class="fa fa-check" aria-hidden="true"></i> <strong>Free 24/7 support</strong> – Call our experts anytime</li>
						<li><i class="fa fa-check" aria-hidden="true"></i> <strong>Trusted and reliable</strong> – 5,000,000+ travellers worldwide</li>
					</ul>
				</div>
				<div class="slide-button">
					<a class="btn btn-danger" href="<?=site_url("visa-processing")?>">GET STARTED</a>
					<a class="btn btn-light" href="<?=site_url("apply-visa")?>">APPLY NOW</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?
	$holiday_info = new stdClass();
	$holiday_info->current_date = date("Y-m-d");
	$holidays = $this->m_holiday->items($holiday_info, 1);
	if (!empty($holidays)) {
		$holiday = array_shift($holidays);
		$current_time = time();
		if ($current_time >= strtotime(date("Y-m-d 14:30:00", strtotime($holiday->start_date))) && $current_time < strtotime($holiday->end_date)) {
			?>
			<div class="cluster" style="background-color: #008bc8; color: #fff;">
				<div class="container">
					<div class="cluster-body">
						<h3><span class="glyphicon glyphicon-bullhorn"></span> <?=strtoupper($holiday->name)?></h3>
						<p>Dear all valued Customers,</p>
						<p>In celebration of <?=$holiday->name?>, Vietnam Immigration Department will temporarily close its business hours from <?=date("M/d/Y", strtotime($holiday->start_date))?> to <?=date("M/d/Y", strtotime($holiday->end_date." -1 day"))?>, and they will be back to work on <?=date("M/d/Y", strtotime($holiday->end_date))?>.</p>
						<p>All procedure at the airport are still working 24/7. <b>Holiday</b> case will be applied and penalty fee will be charged for who need to arrive Vietnam on these days, but forget or have not got visa approval letter.</p>
						<p>We, Support team is still working 24/7 to assist you to get visa to Vietnam.</p>
						<ul>
							<li>In case, if you wish to arrive Vietnam between these days, please <a style="color:#fff;" href="<?=site_url("apply-visa")?>"><u>apply Visa online</u></a> and choose <b>Holiday</b> case option to get the visa approval letter within 30 minutes.</li>
							<li>For all applicants who will arrive in Vietnam after the Holiday, your Approval Letter will be guaranteed sent to you on <?=date("M/d/Y", strtotime($holiday->end_date." +1 day"))?> at 18h00PM GMT +7 (Vietnam local time).</li>
						</ul>
						<p>Any Emergency case, do not hesitate to contact us at : <a title="email" style="color:#fff;" href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a> or hotline : <a title="hotline" style="color:#fff;" href="tel:<?=HOTLINE?>"><?=HOTLINE?></a> or <a title="tollfree" style="color:#fff;" href="tel:<?=TOLL_FREE?>"><?=TOLL_FREE?></a></p>
					</div>
				</div>
			</div>
			<?
		}
	}
	
?>
<!-- Step apply visa -->
<div class="cluster">
	<div class="container">
		<div class="cluster-heading wow fadeInUp">
			<div class="text-center title">
				<h2 class="text-center heading">TYPES <span class="text-color-red">OF VISA</span></h2>
			</div>
		</div>
		<div class="cluster-body pr-section-bg wow fadeInUp">
			<div class="wrap-type-visa">
				<div class="row">
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6 d-none d-lg-block">
								<a href="<?=site_url('visa-processing')?>"><img class="img-thumnail full-width img-responsive img-pr" alt="" src="<?=IMG_URL?>voa-home.png"></a>
							</div>
							<div class="description col-sm-6">
								<h4><a class="title" title="Vietnam Visa On Arrival" href="<?=site_url('visa-processing')?>">Vietnam Visa On Arrival</a></h4>
								<ul>
									<li> Valid in 1 month or 3 months with single or multiple entries</li>
									<li>For those who enter Vietnam by airports only</li>
									<li>Visitors can enter Vietnam at either Ho Chi Minh, Ha Noi, Cam Ranh or Da Nang airport with this type of visa.</li>
								</ul>
								<p><a href="<?=site_url('visa-processing')?>" class="btn btn-danger" style="font-size: 13px;">READ MORE</a></p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6 d-none d-lg-block">
								<a href="<?=site_url('vietnam-e-visa')?>"><img class="img-thumnail full-width img-responsive img-pr" alt="" src="<?=IMG_URL?>evisa-home.png"></a>
							</div>
							<div class="description col-sm-6">
								<h4><a class="title" title="Vietnam E-visa" href="<?=site_url('vietnam-e-visa')?>">Vietnam E-visa</a></h4>
								<ul>
									<li> Valid in 1 month only with a single entry.</li>
									<li> For those who enter Vietnam by airports, land ports, seaports.</li>
									<li> With this visa, tourists can only enter Vietnam at the port that issued.</li>
								</ul>
								<p><a href="<?=site_url('vietnam-e-visa')?>" class="btn btn-danger" style="font-size: 13px;">READ MORE</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="service-fees d-none d-lg-block">
		<div class="tourist-visa-fee">
			<table class="table table-bordered pricing-table">
				<tbody>
					<tr>
						<th class="text-left" rowspan="2">TOURIST VISA</th>
						<th class="text-center" colspan="3">SERVICE FEE</th>
						<th class="text-center" rowspan="2">STAMPING FEE</th>
					</tr>
					<tr>
						<th class="sub-heading text-center" rowspan="1" colspan="1">NORMAL PROCESSING <br>(24-48 working hours)</th>
						<th class="sub-heading text-center red" rowspan="1">URGENT <br>(4-8 working hours)</th>
						<th class="sub-heading text-center red" rowspan="1">EMERGENCY <br>(1-4 working hours)</th>
					</tr>
					<tr>
						<td class="text-left">1 month single (E-visa)</td>
						<td class="text-center"><?=$fee->evisa_tourist_1ms?> USD</td>
						<td class="text-center red">Plus <?=$processing_fee->evisa_tourist_1ms_urgent?> USD/pax</td>
						<td class="text-center red">Plus <?=$processing_fee->evisa_tourist_1ms_emergency?> USD/pax</td>
						<td class="text-center">25 USD/pax</td>
					</tr>
					<tr>
						<td class="text-left">1 month single</td>
						<td class="text-center"><?=$fee->tourist_1ms?> USD</td>
						<td class="text-center">
							<div class="red">Plus <?=$processing_fee->tourist_1ms_urgent?> USD/pax</div>
						</td>
						<td class="text-center">
							<div class="red">Plus <?=$processing_fee->tourist_1ms_emergency?> USD/pax</div>
						</td>
						<td class="text-center">25 USD/pax</td>
					</tr>
					<tr>
						<td class="text-left">1 month multiple</td>
						<td class="text-center"><?=$fee->tourist_1mm?> USD</td>
						<td class="text-center">
							<div class="red">Plus <?=$processing_fee->tourist_1mm_urgent?> USD/pax</div>
						</td>
						<td class="text-center">
							<div class="red">Plus <?=$processing_fee->tourist_1mm_emergency?> USD/pax</div>
						</td>
						<td class="text-center">50 USD/pax</td>
					</tr>
					<tr>
						<td class="text-left">3 months single</td>
						<td class="text-center"><?=$fee->tourist_3ms?> USD</td>
						<td class="text-center">
							<div class="red">Plus <?=$processing_fee->tourist_3ms_urgent?> USD/pax</div>
						</td>
						<td class="text-center">
							<div class="red">Plus <?=$processing_fee->tourist_3ms_emergency?> USD/pax</div>
						</td>
						<td class="text-center">25 USD/pax</td>
					</tr>
					<tr>
						<td class="text-left">3 months multiple</td>
						<td class="text-center"><?=$fee->tourist_3mm?> USD</td>
						<td class="text-center">
							<div class="red">Plus <?=$processing_fee->tourist_3mm_urgent?> USD/pax</div>
						</td>
						<td class="text-center">
							<div class="red">Plus <?=$processing_fee->tourist_3mm_emergency?> USD/pax</div>
						</td>
						<td class="text-center">50 USD/pax</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="service-fees d-none d-lg-block">
		<div class="tourist-visa-fee">
			<table class="table table-bordered pricing-table">
				<tbody>
					<tr>
						<th class="text-left" rowspan="2">BUSINESS VISA</th>
						<th class="text-center" colspan="3">SERVICE FEE</th>
						<th class="text-center" rowspan="2">STAMPING FEE</th>
					</tr>
					<tr>
						<th class="sub-heading text-center" rowspan="1" colspan="1">NORMAL PROCESSING <br>(24-48 working hours)</th>
						<th class="sub-heading text-center red" rowspan="1">URGENT <br>(4-8 working hours)</th>
						<th class="sub-heading text-center red" rowspan="1">EMERGENCY <br>(1-4 working hours)</th>
					</tr>
					<tr>
						<td class="text-left">1 month single (E-visa)</td>
						<td class="text-center"><?=$fee->evisa_business_1ms?> USD</td>
						<td class="text-center red">Plus <?=$processing_fee->evisa_business_1ms_urgent?> USD/pax</td>
						<td class="text-center red">Plus <?=$processing_fee->evisa_business_1ms_emergency?> USD/pax</td>
						<td class="text-center">25 USD/pax</td>
					</tr>
					<tr>
						<td class="text-left">1 month single</td>
						<td class="text-center"><?=$fee->business_1ms?> USD</td>
						<td class="text-center">
							<div class="red">Plus <?=$processing_fee->business_1ms_urgent?> USD/pax</div>
						</td>
						<td class="text-center">
							<div class="red">Plus <?=$processing_fee->business_1ms_emergency?> USD/pax</div>
						</td>
						<td class="text-center">25 USD/pax</td>
					</tr>
					<tr>
						<td class="text-left">1 month multiple</td>
						<td class="text-center"><?=$fee->business_1mm?> USD</td>
						<td class="text-center">
							<div class="red">Plus <?=$processing_fee->business_1mm_urgent?> USD/pax</div>
						</td>
						<td class="text-center">
							<div class="red">Plus <?=$processing_fee->business_1mm_emergency?> USD/pax</div>
						</td>
						<td class="text-center">50 USD/pax</td>
					</tr>
					<tr>
						<td class="text-left">3 months single</td>
						<td class="text-center"><?=$fee->business_3ms?> USD</td>
						<td class="text-center">
							<div class="red">Plus <?=$processing_fee->business_3ms_urgent?> USD/pax</div>
						</td>
						<td class="text-center">
							<div class="red">Plus <?=$processing_fee->business_3ms_emergency?> USD/pax</div>
						</td>
						<td class="text-center">25 USD/pax</td>
					</tr>
					<tr>
						<td class="text-left">3 months multiple</td>
						<td class="text-center"><?=$fee->business_3mm?> USD</td>
						<td class="text-center">
							<div class="red">Plus <?=$processing_fee->business_3mm_urgent?> USD/pax</div>
						</td>
						<td class="text-center">
							<div class="red">Plus <?=$processing_fee->business_3mm_emergency?> USD/pax</div>
						</td>
						<td class="text-center">50 USD/pax</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="service-fees d-block d-sm-block d-md-none">
		<div class="tourist-visa-fee">
			<table class="table table-bordered pricing-table">
				<tbody>
					<tr>
						<th class="text-left" rowspan="2">TOURIST VISA</th>
						<th class="text-center">SERVICE FEE</th>
						<th class="text-center" rowspan="2">STAMPING FEE</th>
					</tr>
					<tr>
						<th class="sub-heading text-center" rowspan="1" colspan="1">NORMAL PROCESSING <br>(24-48 working hours)</th>
					</tr>
					<tr>
						<td class="text-left">1 month single (E-visa)</td>
						<td class="text-center"><?=$fee->evisa_tourist_1ms?> USD</td>
						<td class="text-center">25 USD/pax</td>
					</tr>
					<tr>
						<td class="text-left">1 month single</td>
						<td class="text-center"><?=$fee->tourist_1ms?> USD</td>
						<td class="text-center">25 USD/pax</td>
					</tr>
					<tr>
						<td class="text-left">1 month multiple</td>
						<td class="text-center"><?=$fee->tourist_1mm?> USD</td>
						<td class="text-center">50 USD/pax</td>
					</tr>
					<tr>
						<td class="text-left">3 months single</td>
						<td class="text-center"><?=$fee->tourist_3ms?> USD</td>
						<td class="text-center">25 USD/pax</td>
					</tr>
					<tr>
						<td class="text-left">3 months multiple</td>
						<td class="text-center"><?=$fee->tourist_3mm?> USD</td>
						<td class="text-center">50 USD/pax</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="service-fees d-block d-sm-block d-md-none">
		<div class="tourist-visa-fee">
			<table class="table table-bordered pricing-table">
				<tbody>
					<tr>
						<th class="text-left" rowspan="2">BUSINESS VISA</th>
						<th class="text-center">SERVICE FEE</th>
						<th class="text-center" rowspan="2">STAMPING FEE</th>
					</tr>
					<tr>
						<th class="sub-heading text-center" rowspan="1" colspan="1">NORMAL PROCESSING <br>(24-48 working hours)</th>
					</tr>
					<tr>
						<td class="text-left">1 month single (E-visa)</td>
						<td class="text-center"><?=$fee->evisa_business_1ms?> USD</td>
						<td class="text-center">25 USD/pax</td>
					</tr>
					<tr>
						<td class="text-left">1 month single</td>
						<td class="text-center"><?=$fee->business_1ms?> USD</td>
						<td class="text-center">25 USD/pax</td>
					</tr>
					<tr>
						<td class="text-left">1 month multiple</td>
						<td class="text-center"><?=$fee->business_1mm?> USD</td>
						<td class="text-center">50 USD/pax</td>
					</tr>
					<tr>
						<td class="text-left">3 months single</td>
						<td class="text-center"><?=$fee->business_3ms?> USD</td>
						<td class="text-center">25 USD/pax</td>
					</tr>
					<tr>
						<td class="text-left">3 months multiple</td>
						<td class="text-center"><?=$fee->business_3mm?> USD</td>
						<td class="text-center">50 USD/pax</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- <div class="cluster cluster-our-services">
	<div class="container wow fadeInUp">
		<div class="title">
			<h2 class="heading">AIRPORT SERVICES</h2>
		</div>
		<div class="cluster-content">
			<div class="row">
				<div class="col-md-3">
					<div class=""><a title="Airport concierge service" href="<?=site_url("services/view/airport-fast-track-service")?>"><img alt="Airport concierge service" class="lazy full-width" src="<?=CF_IMG_URL?>service/thumb/fast-track.png"></a></div>
					<h3><a title="Airport concierge service" href="<?=site_url("services/view/airport-fast-track-service")?>">Airport Concierge</a></h3>
					<p class="summary">Our staff will meet you at the aircraft gate with your name on the welcome board and assist you to get visa stamp and visa sticker without getting line as other. Just 5-10 minutes you will at the luggage lounge to wait for your belonging.</p>
				</div>
				<div class="col-md-3">
					<div class=""><a title="Car pickup service" href="<?=site_url("services/view/airport-pick-up-service")?>"><img alt="Car pickup service" class="lazy full-width" src="<?=CF_IMG_URL?>service/thumb/car-pickup.png"></a></div>
					<h3><a title="Car pickup service" href="<?=site_url("services/view/airport-pick-up-service")?>">Airport Car Pickup</a></h3>
					<p class="summary">You are tired in the plane during the flight and you want to rest in hotel immediately to be ready for an interesting vacation. We highly recommend the car pick-up service beside Applying Vietnam Visa Online Service.</p>
				</div>
				<div class="col-md-3">
					<div class=""><a title="Vietnam hotel booking" href="<?=site_url("services/view/vietnam-visa-extension-and-renewal")?>"><img alt="Visa Extension and Renewal" class="lazy full-width" src="https://www.vietnam-visa.org.vn/files/upload/image/vietnam-visa-extension-and-renewal.jpg"></a></div>
					<h3><a title="Vietnam hotel booking" href="<?=site_url("services/view/vietnam-visa-extension-and-renewal")?>">Visa Extension and Renewal</a></h3>
					<p class="summary">This section explains the customer how to apply to their visa extension for the temporary staying permission in Vietnam with the purpose for visiting relatives, traveling, business or others.</p>
				</div>
				<div class="col-md-3">
					<div class=""><a title="Vietnam tour and travel booking" href="<?=site_url("services/view/tour-and-travel-booking")?>"><img alt="Vietnam tour and travel booking" class="lazy full-width" src="<?=CF_IMG_URL?>service/thumb/tour-booking.png"></a></div>
					<h3><a title="Vietnam tour and travel booking" href="<?=site_url("services/view/tour-and-travel-booking")?>">Tour Booking</a></h3>
					<p class="summary">With a deep knowledge about people and country of Vietnam is our advantage , we will help you to understand of experience History, Culture, Traditional culinary of Indochina in general and Vietnam in particular.</p>
				</div>
			</div>
		</div>
	</div>
</div> -->
<!-- About us -->
<div class="cluster d-none d-sm-none d-md-block">
	<div class="container wow fadeInUp">
		<div class="title">
			<h2 class="heading">ABOUT US</h2>
			<div class="separator"></div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<p>It is our great pleasure to assist you in obtaining Vietnam Visa and we would like to get this opportunity to say “thank you” for your interest in our site Vietnam Visa Org Vn.</p>
				<p>With 10-year-experience in Vietnam visa service and enthusiastic visa team, Vietnam Visa Org Vn is always proud of our excellent services for the clients who would like to avoid the long visa procedures at their local Vietnam's Embassies. Vietnam Visa on arrival is helpful for overseas tourists and businessmen because it is the most convenient, simple and secured way to get Vietnam visa stamp. It is legitimated and supported by the Vietnamese Immigration Department.</p>
				<p>Let’s save your money, your time in the first time to visit our country! Whatever service you need, we are happy to tailor a package reflecting your needs and budget.</p>
				<p><a href="<?=site_url('about-us')?>" class="btn btn-danger">READ MORE</a></p>
			</div>
			<div class="col-sm-6">
				<div class="about-us-images">
					<img src="<?=IMG_URL?>about-us.jpg" class="img-responsive full-width" alt="About Us">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End about us -->

<div class="cluster">
	<div class="container">
		<div class="clearfix">
			<h2 class="text-center mb-4">Advantages of processing your application to Vietnam with our agency</h2>
			<table class="table table-bordered" style="font-size:15px;">
				<tr class="text-center" style="font-weight: 600; background-color: #f0f0f0;">
					<td>Services</td>
					<td>Others</td>
					<td>Vietnam-visa.org.vn</td>
				</tr>
				<tr>
					<td><strong>Online application available 24/7/365.</strong></td>
					<td class="text-center"><span style="color: green;"><i class="fa fa-check" aria-hidden="true"></i></span></td>
					<td class="text-center"><span style="color: green;"><i class="fa fa-check" aria-hidden="true"></i></span></td>
				</tr>
				<tr>
					<td><strong>24/7/365 email support and assistance by visa experts.</strong></td>
					<td class="text-center"><span style="color:red"><i class="fa fa-times" aria-hidden="true"></i></span></td>
					<td class="text-center"><span style="color: green;"><i class="fa fa-check" aria-hidden="true"></i></span></td>
				</tr>
				<tr>
					<td><strong>Phone support 7 days a week.</strong></td>
					<td class="text-center"><span style="color:red"><i class="fa fa-times" aria-hidden="true"></i></span></td>
					<td class="text-center"><span style="color: green;"><i class="fa fa-check" aria-hidden="true"></i></span></td>
				</tr>
				<tr>
					<td><strong>Review of application by visa experts</strong> before submission to the government.</td>
					<td class="text-center"><span style="color:red"><i class="fa fa-times" aria-hidden="true"></i></span></td>
					<td class="text-center"><span style="color: green;"><i class="fa fa-check" aria-hidden="true"></i></span></td>
				</tr>
				<tr>
					<td><strong>Correction of missing/incorrect information</strong> by visa experts.</td>
					<td class="text-center"><span style="color:red"><i class="fa fa-times" aria-hidden="true"></i></span></td>
					<td class="text-center"><span style="color: green;"><i class="fa fa-check" aria-hidden="true"></i></span></td>
				</tr>
				<tr>
					<td><strong>Verification/validation of information by visa experts.</strong></td>
					<td class="text-center"><span style="color:red"><i class="fa fa-times" aria-hidden="true"></i></span></td>
					<td class="text-center"><span style="color: green;"><i class="fa fa-check" aria-hidden="true"></i></span></td>
				</tr>
				<tr>
					<td><strong>Simplified application process.</strong></td>
					<td class="text-center"><span style="color:red"><i class="fa fa-times" aria-hidden="true"></i></span></td>
					<td class="text-center"><span style="color: green;"><i class="fa fa-check" aria-hidden="true"></i></span></td>
				</tr>
				<tr>
					<td><strong>Privacy protection and secure form.</strong></td>
					<td class="text-center"><span style="color: green;"><i class="fa fa-check" aria-hidden="true"></i></span></td>
					<td class="text-center"><span style="color: green;"><i class="fa fa-check" aria-hidden="true"></i></span></td>
				</tr>
				<tr>
					<td><strong>Photo and document editing.</strong> We accept all formats (PDF, JPG, PNG), with no limit on file size.</td>
					<td class="text-center"><span style="color:red"><i class="fa fa-times" aria-hidden="true"></i></span></td>
					<td class="text-center"><span style="color: green;"><i class="fa fa-check" aria-hidden="true"></i></span></td>
				</tr>
				<tr>
					<td><strong>Your approved visa letter will be sent by email.</strong></td>
					<td class="text-center"><span style="color: green;"><i class="fa fa-check" aria-hidden="true"></i></span></td>
					<td class="text-center"><span style="color: green;"><i class="fa fa-check" aria-hidden="true"></i></span></td>
				</tr>
				<tr>
					<td><strong>Recovery of your Visa via email</strong> in the event of loss or misplacement.</td>
					<td class="text-center"><span style="color:red"><i class="fa fa-times" aria-hidden="true"></i></span></td>
					<td class="text-center"><span style="color: green;"><i class="fa fa-check" aria-hidden="true"></i></span></td>
				</tr>
				<tr>
					<td><strong>Multiple methods of payment used worldwide.</strong></td>
					<td class="text-center"><span style="color:red"><i class="fa fa-times" aria-hidden="true"></i></span></td>
					<td class="text-center"><span style="color: green;"><i class="fa fa-check" aria-hidden="true"></i></span></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<?
	ini_set('default_socket_timeout', 3);
	$sa_content = file_get_contents('https://www.shopperapproved.com/feeds/schema.php/?siteid=24798&token=sfx0VK6J');
	// $sa_total = substr($sa_content, strpos($sa_content, '<span itemprop="ratingCount">')+strlen('<span itemprop="ratingCount">'), 3);
	// echo $sa_content;
	$str = explode('based on', $sa_content);
	$str = explode(' ', $str[1]);
	$sa_total = $str[1];
?>
<div class="shopperapproved d-block d-sm-block d-md-none text-center">
	<h2 class="text-center home-sub-heading">Testimonial</h2>
	<a class="sa-medal" title="Customer ratings" target="_blank" rel="noopener" href="http://www.shopperapproved.com/reviews/vietnam-visa.org.vn/">
		<img alt="Customer ratings" class="medal-red lazy" src="<?=IMG_URL?>medal-red.png" style="display: inline;">
		<span class="sa-total"><?=$sa_total?></span>
	</a>
</div>
<div class="testimonial d-none d-sm-none d-md-block">
	<div class="container" style="padding-top: 30px; padding-bottom: 30px;">
		<h2 class="text-center home-sub-heading">Testimonial</h2>
		<h3 class="text-center" style="color: #AAA;">A few words of our travellers.</h3>
		<div class="cluster-content">
			<div style="min-height: 100px; overflow: hidden;" class="shopperapproved_widget sa_rotate sa_horizontal sa_count5 sa_rounded sa_colorBlack sa_borderGray sa_bgWhite sa_showdate sa_jMY"></div><script type="text/javascript">var sa_interval = 10000;function saLoadScript(src) { var js = window.document.createElement('script'); js.src = src; js.type = 'text/javascript'; document.getElementsByTagName("head")[0].appendChild(js); } if (typeof(shopper_first) == 'undefined') saLoadScript('//www.shopperapproved.com/widgets/testimonial/3.0/24798.js'); shopper_first = true; </script><div style="text-align:right;"><a href="http://www.shopperapproved.com/reviews/vietnam-visa.org.vn/" target="_blank" rel="nofollow" class="sa_footer"><img class="sa_widget_footer" alt="Customer reviews" src="//www.shopperapproved.com/widgets/widgetfooter-darklogo.png" style="border: 0;"></a></div>
		</div>
	</div>
</div>
<!-- Consular service -->
<!-- <div class="recommended-cluster d-none d-sm-none d-md-block">
	<div class="container" style="padding-top: 30px; padding-bottom: 30px;">
		<h2 class="home-heading text-center">Our partners</h2>
		<h3 class="text-center" style="color: #AAA;">We are recommended on world wide.</h3>
		<div class="cluster-content">
			<div class="row">
				<div class="col-sm-2">
					<a class="item-partner" style="font-family: 'Segoe UI';" target="_blank" href="https://www.beetrip.net">
						<strong style="color:#FFD55B;">Bee</strong><strong style="color:#512C1E">trip</strong><strong style="font-size: 10px;color: #512C1E;">.net</strong>
					</a>
				</div>
				<div class="col-sm-2">
					<a class="item-partner" target="_blank" href="https://www.google.com">
						<strong style="color:#4285F4;">G</strong><strong style="color:#EB4E41">o</strong><strong style="color:#FBBC05">o</strong><strong style="color:#4285F4">g</strong><strong style="color:#34A853">l</strong><strong style="color:#EB4E41">e</strong>
					</a>
				</div>
				<div class="col-sm-2">
					<a class="item-partner" style="font-family: 'Segoe UI';font-style: italic;" target="_blank" href="https://www.paypal.com">
						<i class="fa fa-paypal" aria-hidden="true" style="color:#253B80;"></i><strong style="color:#253B80;font-size: 25px;font-weight: 900;">Pay</strong><strong style="color:#179BD7;font-size: 25px;font-weight: 900;">Pal</strong>
					</a>
				</div>
				<div class="col-sm-2">
					<a class="item-partner" style="font-family: fantasy;" target="_blank" href="https://www.youtube.com">
						<i class="fa fa-youtube-play" aria-hidden="true" style="color:#FF0000;"></i> <span style="font-size: 20px;color:#000;">Youtube</span>
					</a>
				</div>
				<div class="col-sm-2">
					<a class="item-partner" style="font-family: sans-serif;" target="_blank" href="https://twitter.com">
						<i class="fa fa-twitter" aria-hidden="true" style="color:#1DA1F2;"></i><strong style="font-size: 24px;color:#000;">Twitter</strong>
					</a>
				</div>
				<div class="col-sm-2">
					<a class="item-partner" style="font-family: sans-serif;" target="_blank" href="https://www.facebook.com">
						<strong style="font-size: 25px;color: #004F9C;font-weight: bold;">Facebook</strong>
					</a>
				</div>
			</div>
		</div>
	</div>
</div> -->