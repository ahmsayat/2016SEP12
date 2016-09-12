<?php
include ('header_view.php');
?>
<div class="form" style="color: white;">

		<div id="signup">
			<h1>Complete Registration</h1>

			<form action="/complete_registration" method="post">

				<div class="field-wrap">
					<label><span class="req"></span> </label>
					<input readonly type="email" name="email" value="<?php if(@$email) echo $email; ?>" required autocomplete="on"/>
				</div>

				<div class="top-row">
					<div class="field-wrap">
						<label> First Name<span class="req">*</span> </label>
						<input type="text" name="fname" required autocomplete="off" />
					</div>

					<div class="field-wrap">
						<label> Last Name<span class="req">*</span> </label>
						<input type="text" name="lname" required autocomplete="off"/>
					</div>
				</div>

				<div class="field-wrap">
					<label> Set A Password<span class="req">*</span> </label>
					<input type="password" name="password" required autocomplete="off"/>
				</div>
				
				<div class="field-wrap">
					<label> Confirm Password<span class="req">*</span> </label>
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
				Complete Registration</button>

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
