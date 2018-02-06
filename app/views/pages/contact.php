<?php require APPROOT . '/views/inc/header.php'; ?>
<title><?php echo SITENAME." | Contact Us"; ?></title>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
$( "input[type='radio']" ).checkboxradio({
icon: false
});
} );
</script>
<style>
#pref-contact{
	transform: translateY(115%);
	margin-bottom: 0.1rem;
}
strong {
	color: #ff0000;
}
</style>
</head>
<body>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<div class="container">
	<?php echo (!empty(flash('contact_success')))? "<div class='alert'>". flash('contact_success')."</div>" :  '<div class="alert">'.flash('contact_fail').'</div>' ;?>
	<div class="card card-body bg-light">
		<h2>Contact Us</h2>
		<p>Please fill out this form to send us an email with your message.</p>
		<form action="<?php echo URLROOT; ?>/emails/sendEmail/" method="post">
			<div class="row mb-2">
				<div class="col-lg-6">
					<label for="name" class="mb-0">Name <?php echo (!empty($data['name_err']))? "<strong>". $data['name_err']."</strong>" :  '' ;?></label>
					
					<input type="text" name="name" id="name" class="form-control" value="<?php echo $data['name']; ?>" required="">
				</div>
				<div class="col-lg-6">
					<label for="email" class="mb-0">Email <?php echo (!empty($data['email_err']))? "<strong>". $data['email_err']."</strong>" :  '' ;?></label>
					<input type="text" name="email" id="email" class="form-control"  value="<?php echo $data['email']; ?>" required="">
				</div>
			</div>
			<div class="row mb-2">
				<div class="col-lg-6">
					<label for="phone" class="mb-0">Phone Number <?php echo (!empty($data['phone_err']))? "<strong>". $data['phone_err']."</strong>" :  '' ;?></label>
					<input type="text" name="phone" id="phone" class="form-control"  value="<?php echo $data['email']; ?>"  required="">
				</div>
				<div class="col-lg-6" >
					<p id="pref-contact">Preferred Method of Contact <?php echo (!empty($data['contact_err']))? "<strong>". $data['contact_err']."</strong>" :  '' ;?></p>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="contactMethod" id="contactMethod-email" class="form-control"  <?php echo (isset($_POST['contactMethod'])?(($_POST['contactMethod']=="contactMethod-email")? "checked='checked'" :"" ): ""); ?>  required="">
						<label class="form-check-label" for="contactMethod-email">Email</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="contactMethod" id="contactMethod-phone" class="form-control" <?php echo (isset($_POST['contactMethod'])?(($_POST['contactMethod']=="contactMethod-phone")? "checked='checked'" :""): "" ); ?>  required="">
						<label class="form-check-label" for="contactMethod-phone">Phone Call</label>
					</div>
				</div>
			</div>
			<label for="message" class="mb-0" >Message <?php echo (!empty($data['msg_err']))? "<strong>". $data['msg_err']."</strong>" :  '' ;?></label>
			<div class="row mb-1">
				<div class="col-lg-12">
					<textarea rows="6" name="message" id="message" class="form-control" required=""><?php $data['message']; ?></textarea>
				</div>
			</div>
			<button type="submit" class="btn btn-success btn-lg float-right mt-2">Send Message</button>
		</form>
	</div>
</div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>