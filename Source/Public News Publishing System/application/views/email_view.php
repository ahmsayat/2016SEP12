<?php
include ('header_view.php');
?>

<div class="form" style="color: white;">

	<h1 class="button button-block" style="background: rgba(160, 179, 176, 0.25); color: #a0b3b0;">Public News Publishing System</h1>

	<div id="done">
		<h1>Welcome!</h1><br />
		<p class="forgot">
To activate your account, click confirm button below or open the link in a browser			 
			</p><br />
	</div>
	<form action="<?php if(@$link) {echo base_url() . $link; } ?>" method="post">
		<button class="button button-block"/>
		Confirm Email
		</button>
	</form>
	
	<br />
	<br />
	If you did not request this change, you do not need to do anything. 
	<br /><br />
	This link will expire in 4 hours.
	<br /><br />
	Thanks,
	<br />
	Public News Publishing Support
			
</div>

<?php
include ('footer_view.php');
?>