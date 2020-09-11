
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>public\assets\demo\favicon.png">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login</title>
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600|Roboto:400" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link href="<?= base_url(); ?>public\assets\vendors\mono-social-icons\monosocialiconsfont.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>public\assets\vendors\feather-icons\feather.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>public\assets\css\style.css" rel="stylesheet" type="text/css">
    <!-- Head Libs -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
	<style>
.m-title{
	font-weight: bold;
    color: #0c5f87;    font-size: 19px;
}
		</style>
</head>

<body class="body-bg-full profile-page" style="background-image: url(<?= base_url(); ?>public/assets/demo/error-page.jpg)">
    <div id="wrapper" class="row wrapper">
        <div class="container-min-full-height d-flex justify-content-center align-items-center">
            <div class="login-center">
                <div class="navbar-header text-center mb-5">
                    <a href="index.html">
                        <img alt="" src="<?= base_url(); ?>public\assets\demo\logo-expand-dark.png">
					</a>
					<h5 class="m-title"><?php echo lang('change_password_heading');?></h5>
                </div>
				<!-- /.navbar-header -->
				<?php  if($this->session->flashdata('message') || $message){?>
				<div class="alert alert-icon alert-danger border-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						</button> <i class="material-icons list-icon">not_interested</i><?php echo $message;?></div>
				<?php } ?>		
                <form action="<?= site_url('home/change_password'); ?>" method="post">
				<div class="form-group">
						<label class="text-muted" for="example-email">Old password</label>
						<?php $identity= array(
													'name' => 'old',
													'id' => 'old',
													'placeholder' => 'Old Password',
													'value' => '',
													'class'=>'form-control form-control-line',
													'type'=>'password'
													);	
												echo form_input($identity);
									?>
						</div>

                                    <div class="form-group">
						<label class="text-muted" for="example-email">New password</label>
						<?php $identity= array(
													'name' => 'new',
													'id' => 'new',
													'placeholder' => 'New Password',
													'value' => '',
													'class'=>'form-control form-control-line',
													'type'=>'password'
													);	
												echo form_input($identity);
									?>
						</div>
						
                        <div class="form-group">
						<label class="text-muted" for="example-email">Confirm Password</label>
						<?php $password= array(
							'name' => 'new_confirm',
							'id' => 'new_confirm',
							'placeholder' => 'Confirm Password',
							'value' => '',
							'class'=>'form-control form-control-line',
							'type'=>'password'
							);	
						echo form_input($password);
						?>
						 </div>

			<div class="form-group">
			<?php echo form_submit('submit', lang('change_password_submit_btn'), 'class="btn btn-block btn-lg btn-color-scheme text-uppercase fs-12 fw-600"');?>
			</div>
			
                </form>
                <!-- /.form-material -->
                <!-- /.btn-list -->
                <footer class="col-sm-12 text-center">
                    <hr>
                   
                    </p>
                </footer>
            </div>
            <!-- /.login-center -->
        </div>
        <!-- /.d-flex -->
    </div>
    <!-- /.body-container -->
    <!-- Scripts -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>public\assets\js\material-design.js"></script>
</body>

</html>
