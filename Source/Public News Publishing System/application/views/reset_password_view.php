<?php
include ('header_view.php');
?>

<div class="form" style="color: white;">
<h1>Forgot Password?</h1>

			 

				<div class="field-wrap">
					<label>Enter Your Email Address<span class="req">*</span> </label>
					<input type="email" name='email' required autocomplete="off"/>
				</div>

				<a href="/"><button class="button button-block"/>
				Retrieve Password</button></a>
			 
</div>
	
<?php
	include ('footer_view.php');
?>