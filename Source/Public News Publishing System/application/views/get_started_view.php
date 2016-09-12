<?php
include ('header_view.php');
?>

<div class="form">

	<ul class="tab-group">
		<li class="tab active">
			<a href="#get_started">Sign Up</a>
		</li>
		<li class="tab">
			<a href="#login">Log In</a>
		</li>
	</ul>

	<div class="tab-content">
		<div id="get_started">
			<h1>Sign Up for Free</h1>

			<form class="sign-in-form" method="post" action="get_started" name="get_started" id="get_started_form">

				<div class="field-wrap">
					<label> Email Address<span class="req">*</span> </label>
					<input type="email" name="email" required autocomplete="off" />
				</div>
				<p class="forgot">
					<a style="color:yellow; text-decoration: none;"><?php echo set_value('email'); ?></a>
					<a style="color:red; text-decoration: none;"><?php echo form_error('email'); ?></a>
				</p>
				
				<br />
				<br />
				<br />
				<br />
				
				<button type="submit" class="button button-block" form="get_started_form" />
				Get Started</button>

			</form>

		</div>

		<div id="login">
			<h1>Welcome Back!</h1>

			<form action="/check_logins" method="post" autocomplete="off">
				<div class="field-wrap">
					<label id="email_show"> Email Address<span class="req">*</span></label>
					<input type="email" name="lemail" value="" required autocomplete="off"/>
				</div>

				<div class="field-wrap">
					<label id="password_show"> Password<span class="req">*</span> </label>
					<input type="password" name="lpassword" value="" required autocomplete="off"/>
				</div>

				<p class="forgot">
					<a href="reset">Forgot Password?</a>
				</p>

				<button class="button button-block"/>
				Log In</button>

			</form>

		</div>

	</div><!-- tab-content -->

</div>
<!-- /form -->
<!-- <?php echo validation_errors(); ?> -->
<?php
	include ('footer_view.php');
?>

<!--
<script type='text/javascript'> 
					  if($('[name=lemail]').val().length == 0 )
					    $('#email_show').show();
					  else
					    $('#email_show').hide();
					    
					  if($('[name=lpassword]').val() == '')
					    $('#password_show').show();
					  else
					    $('#password_show').hide();
</script>
-->