<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>public/img/favicon.png">
        <title>Forgot Password - HRMS admin template</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>public/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>public/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>public/css/style.css">
		<!--[if lt IE 9]>
			<script src="<?= base_url(); ?>public/js/html5shiv.min.js"></script>
			<script src="<?= base_url(); ?>public/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
        <div class="main-wrapper">
			<div class="account-page">
				<div class="container">
					<h3 class="account-title">Reset Login</h3>
					<div class="account-box">
						<div class="account-wrapper">
							<div class="account-logo">
								<a href="index.html"><img src="<?= base_url(); ?>public/img/logo2.png" alt="Focus Technologies"></a>
							</div>
							<div id="infoMessage"><?php echo $message;?></div>
							<form>
								<div class="form-group form-focus">
								<label for="identity"><?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label> 
								<?php $identity= array(
													'name' => 'identity',
													'id' => 'identity',
													'value' => '',
													'class'=>'form-control floating'
													);	
												echo form_input($identity);
									?>
								</div>
								<div class="form-group text-center">
								<?php echo form_submit('submit', lang('forgot_password_submit_btn'), 'class="btn btn-primary btn-block account-btn"');?>
									
								</div>
								<div class="text-center">
								<a href="login"><?php echo 'Back to Login';?></a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
        </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="<?= base_url(); ?>public/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>public/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>public/js/app.js"></script>
    </body>

<!-- Mirrored from dreamguys.co.in/smarthr/light/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Apr 2019 10:19:49 GMT -->
</html>