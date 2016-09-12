<?php
include ('header_view.php');
?>

<div class="form" style="color: white;">

	<h1 class="button button-block" style="background: rgba(160, 179, 176, 0.25); color: #a0b3b0;">Error</h1>

	<div id="error">
		<h1 style="color:red;"><?php if(@$message) echo $message; ?></h1>
	</div>
	
	<a href="/"><button class="button button-block"/>Dismiss</button></a>
	 
</div>
<?php
include ('footer_view.php');
?>