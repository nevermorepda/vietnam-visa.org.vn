<style>
i.fa-phone {
	font-size: 15px;
}
i.fa-mobile {
	font-size: 19px;
	top: 6px;
}
i.fa-envelope-o {
	font-size: 12px;
	top: 11px;
}
i.fa {
	width: 20px;
}
</style>
<?
	// var_dump($_COOKIE);
?>
<div class="contact">
	<div class="container">
		<div class="alternative-breadcrumb">
		<? require_once(APPPATH."views/module/breadcrumb.php"); ?>
		</div>
	</div>
	<div class="contact-us-img">
		<div class="container">
			<div class="text">
				<div class="txt-container">
					<div class="value-prop center">
						<h1>Get In Touch!</h1>
						<h5>Whether you need visa service support, we're here to answer your questions.</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="cluster-content">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2 class="home-heading" style="padding-top: 15px; padding-bottom: 15px;">Contact information</h2>
				<div class="clearfix">
					<div class="left" style="width: 100px">
						<p><i class="fa fa-map-marker"></i><strong>Address:</strong></p>
					</div>
					<div class="left">
						<p class="">
							<b><?=COMPANY?></b><br>
							<?=ADDRESS?>
						</p>
					</div>
				</div>
				<div class="clearfix">
					<div class="left" style="width: 100px">
						<p><i class="fa fa-phone"></i><strong>Hotline:</strong></p>
					</div>
					<div class="left">
						<span><?=HOTLINE?></span>
					</div>
				</div>
				<div class="clearfix">
					<div class="left" style="width: 100px">
						<p><i class="fa fa-envelope-o"></i><strong>Email:</strong></p>
					</div>
					<div class="left">
						<a title="Email" href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a>
					</div>
				</div>
				<div class="clearfix">
					<div class="left" style="width: 100px">
						<p><i class="fa fa-facebook"></i><strong>Facebook:</strong></p>
					</div>
					<div class="left">
						<a target="_blank" title="Email" href="https://www.facebook.com/vietnamvisavs">www.facebook.com/vietnamvisavs</a>
					</div>
				</div>
				<!--<div class="googlemap">
					<div id="mapcanvas" style="height: 300px; width: 100%;"></div>
				</div>-->
			</div>
			<div class="col-md-6">
				<h2 class="home-heading" style="padding-top: 15px; padding-bottom: 15px;">Contact form</h2>
				<form id="contact-form" action="<?=site_url("contact/message")?>" method="POST">
					<div class="form-group">
						<label class="form-label">YOUR NAME <span class="required">*</span></label>
						<input type="text" value="" id="fullname" name="fullname" required="" class="form-control">
					</div>
					<div class="form-group">
						<label class="form-label">EMAIL <span class="required">*</span></label>
						<input type="email" value="" id="email" name="email" required="" class="form-control">
					</div>
					<div class="form-group">
						<label class="form-label">PHONE NUMBER</label> <span style="font-size: 12px !important;" class=""> (optional)</span>
						<input type="text" value="" id="phone" name="phone" class="form-control"><br>
					</div>
					<div class="form-group">
						<label class="form-label">MESSAGE <span class="required">*</span></label>
						<textarea required="" style="height: 108px;" id="message" name="message" type="text" class="form-control"></textarea>
					</div>
					<div class="form-group">
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
					<div class="form-group">
						<input type="submit" class="btn btn-danger btn-contact" name="submit" value="SEND MESSAGE">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<? if ($this->session->flashdata('success')) { ?>
<script>
	$(document).ready(function() {
		messageBox("INFO", "Success", "<?=$this->session->flashdata('success')?>");
	});
</script>
<? } ?>

<script>
$(document).ready(function() {
	$(".btn-contact").click(function() {
		var err = 0;
		var msg = new Array();
		if ($("#fullname").val() == "") {
			$("#fullname").addClass("error");
			msg.push("Your name is required.");
			err++;
		} else {
			$("#fullname").removeClass("error");
		}

		if ($("#email").val() == "") {
			$("#email").addClass("error");
			msg.push("Your email is required.");
			err++;
		} else {
			$("#email").removeClass("error");
		}

		if ($("#message").val() == "") {
			$("#message").addClass("error");
			msg.push("Please give us your message.");
			err++;
		} else {
			$("#message").removeClass("error");
		}

		if ($("#security_code").val() == "" || $("#security_code").val().toUpperCase() != $(".security-code").html().toUpperCase()) {
			$("#security_code").addClass("error");
			msg.push("Captcha code does not matched.");
			err++;
		} else {
			$("#security_code").removeClass("error");
		}

		if (err == 0) {
			return true;
		}
		else {
			showErrorMessage(msg);
			return false;
		}
	});
});
</script>