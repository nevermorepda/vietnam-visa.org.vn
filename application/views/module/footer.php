<div class="footer">
	<div class="container" style="padding-top: 30px; padding-bottom: 30px;">
		<div class="row">
			<div class="col-md-2 col-sm-6 col-xs-6">
				<h3 class="fnav-title">Company</h3>
				<ul class="fnav-links">
					<li><a title="About Us" href="<?=site_url("about-us")?>">About Us</a></li>
					<li><a title="Why Us" href="<?=site_url("why-us")?>">Why Us</a></li>
					<li><a title="Our Services" href="<?=site_url("services")?>">Our Services</a></li>
					<li><a title="Terms and Conditions" href="<?=site_url("terms-and-conditions")?>">Terms and Conditions</a></li>
					<li><a title="Privacy policy" href="<?=site_url("policy")?>">Privacy policy</a></li>
				</ul>
			</div>
			<div class="col-md-2 col-sm-6 col-xs-6">
				<h3 class="fnav-title">Vietnam Visa Tips</h3>
				<ul class="fnav-links">
					<li><a title="Vietnam visa for Australia" href="<?=site_url("vietnam-visa-tips/view/how-to-get-vietnam-visa-in-australia")?>">Vietnam visa for Australia</a></li>
					<li><a title="Vietnam visa for Canada" href="<?=site_url("vietnam-visa-tips/view/how-to-get-vietnam-visa-in-canada")?>">Vietnam visa for Canada</a></li>
					<li><a title="Vietnam visa for India" href="<?=site_url("vietnam-visa-tips/view/how-to-get-vietnam-visa-in-india")?>">Vietnam visa for India</a></li>
					<li><a title="Vietnam visa for Singapore" href="<?=site_url("vietnam-visa-tips/view/how-to-get-vietnam-visa-in-singapore")?>">Vietnam visa for Singapore</a></li>
					<li><a title="Vietnam visa for UK" href="<?=site_url("vietnam-visa-tips/view/how-to-get-vietnam-visa-in-united-kingdom")?>">Vietnam visa for UK</a></li>
					<li><a title="Vietnam visa for USA" href="<?=site_url("vietnam-visa-tips/view/how-to-get-vietnam-visa-in-united-states")?>">Vietnam visa for USA</a></li>
					<li><a title="Vietnam Visa Tips" href="<?=site_url("vietnam-visa-tips")?>">And more...</a></li>
				</ul>
			</div>
			<div class="col-md-2 col-sm-6 col-xs-6">
				<h3 class="fnav-title">Resource</h3>
				<ul class="fnav-links">
					<li><a title="Vietnam Visa FAQs" href="<?=site_url("faqs")?>">FAQs</a><br />
					<li><a title="Check Visa Requirement" href="<?=site_url("visa-requirements")?>">Check Visa Requirement</a></li>
					<li><a title="Vietnam Visa Tips" href="<?=site_url("vietnam-visa-tips")?>">Vietnam Visa Tips</a></li>
					<li><a title="Vietnam Embassies" href="<?=site_url("vietnam-embassies")?>">Vietnam Embassy List</a></li>
					<li><a title="Vietnam Visa Information" href="<?=site_url("news")?>">Vietnam Visa Information</a></li>
					<li><a title="Vietnam Travel News" href="<?=site_url("news/travel")?>">Vietnam Travel News</a></li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-6">
				<h3 class="fnav-title">Extra Services</h3>
				<ul class="fnav-links">
					<li><a title="Airport Fast-Track Service" href="<?=site_url("services/view/airport-fast-track-service")?>">Airport Fast-Track Service</a></li>
					<li><a title="Car Pick-up Service" href="<?=site_url("services/view/airport-pick-up-service")?>">Car Pick-up Service</a></li>
					<li><a title="Hotel Booking Service" href="<?=site_url("services/view/hotels-reservation")?>">Hotel Booking Service</a></li>
					<li><a title="Tour Booking Service" href="<?=site_url("services/view/tour-and-travel-booking")?>">Tour Booking Service</a></li>
					<li><a title="Extend Visa or Renewal" href="<?=site_url("services/view/vietnam-visa-extension-and-renewal")?>">Extend Visa or Renewal</a></li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-12 col-xs-12">
				<h3 class="fnav-title">Contact</h3>
				<ul class="fnav-links">
					<li><h5><?=COMPANY?></h5></li>
					<li><?=ADDRESS?></li>
					<li><i class="fa fa-phone"></i> <a title="Contact hotline" href="tel:<?=HOTLINE?>"><?=HOTLINE?></a></li>
					<li><i class="fa fa-envelope-o"></i> <a title="Contact email" href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a></li>
					<li><i class="fa fa-envelope-o"></i> <a title="Contact form" href="<?=site_url("contact")?>">Send us an email</a></li>
					<li><i class="fa fa-facebook" style="padding-right: 8px;"></i> <a target="_blank" title="Contact form" href="https://www.facebook.com/vietnamvisavs">Facebook</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="footer-bottom">
	<div class="container">
		<div class="text-center">
			<div class="copyright">
				<p>&copy; <?=date('Y')?> Vietnam Visa Department. All rights reserved.<br>
				Full Vietnam visa services online.</p>
				<?
					ini_set('default_socket_timeout', 3);
					$sa_content = file_get_contents('https://www.shopperapproved.com/feeds/schema.php/?siteid=24798&token=sfx0VK6J');
					$sa_total = substr($sa_content, strpos($sa_content, '<span itemprop="ratingCount">')+strlen('<span itemprop="ratingCount">'), 3);
					$sa_value = 4.8;
					$str = str_replace('>5', '5', $sa_content);
					echo $str;
				?>
				<p style="font-size:13px;">We are pleased to inform that www.vietnam-visa.org.vn is the E-commercial website in Vietnam in processing Vietnam visa. We are not affiliated with the Government. We are offering useful services for helping the Customer to understand visa application, visa processing and visa requirements which is being related to Visa on arrival.
Once you use our services, we have a mission to handle visa applications in Vietnam Immigration Department and provide the legal services to you and on time. You can also obtain Vietnam visa by yourself at Vietnam Embassies in your living country or visit the official website for a lower price. - by <a href="<?=BASE_URL?>">www.vietnam-visa.org.vn</a></p>
			</div>
		</div>
	</div>
</div>

<div id="dialog" class="modal-error modal fade" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Modal title</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				
			</div>
			<div class="modal-body">
				<p>&hellip;</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<a title="UP" class="scrollup" href="#"></a>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PLJZ8XV"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
