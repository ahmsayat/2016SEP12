<?php
include ('header_view.php');
?>
<div class="form" style="color: white;">

		<div id="signup">
			<h1>Complete Registration</h1>

			<form action="/change_password" method="post">

				<div class="field-wrap">
					<label><span class="req"></span> </label>
					<input readonly type="email" name="email" value="<?php if(@$email) echo $email; ?>" required autocomplete="on"/>
				</div>

				<div class="top-row">
					<div class="field-wrap">
						<label> First Name<span class="req">*</span> </label>
						<input readonly type="text" name="fname" value="<?php if(@$fname) echo $fname; ?>" required autocomplete="off" />
					</div>

					<div class="field-wrap">
						<label> Last Name<span class="req">*</span> </label>
						<input readonly type="text" name="lname" value="<?php if(@$lname) echo $lname; ?>" required autocomplete="off"/>
					</div>
				</div>

				<div class="field-wrap">
					<label> Set A New Password<span class="req">*</span> </label>
					<input type="password" name="password" required autocomplete="off"/>
				</div>
				
				<div class="field-wrap">
					<label> Confirm New Password<span class="req">*</span> </label>
					<input type="password" name="passconf" required autocomplete="off"/>
				</div>
				
				<p class="forgot">
					<a style="color:red; text-decoration: none;"><?php echo validation_errors(); ?></a>
				</p>
				
				<br />
				<br />
				<br />
				<br />
				
				<button type="submit" class="button button-block" href="#done" />
				Change Password</button>

			</form>

		</div>
</div>
<!-- /form -->

<?php
	include ('footer_view.php');
?>

<script type="text/javascript">
    //alert('Your email has been verified. Please complete your registration');
</script>
