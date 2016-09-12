<?php
include ('header_view.php');
?>

<div class="form" style="color: white;">

	<h1 class="button button-block" style="background: rgba(160, 179, 176, 0.25); color: #a0b3b0;">Done Successfully</h1>

	<div id="done">
		<h1>Thank You!</h1>
		<p class="forgot"><?php if(@$message) echo $message; ?></p>
	</div>

	<a href="/"><button class="button button-block"/>Dismiss</button></a>
</div>
<?php
include ('footer_view.php');
?>