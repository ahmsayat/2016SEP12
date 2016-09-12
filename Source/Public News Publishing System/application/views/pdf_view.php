<html>
	<head>
		
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>/css/login.css">
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>/css/main.css">

	</head>

	<body ng-app="app" style="">
		

<div class="form" style="color: green;">

	<h1 class=" " style="background: rgba(160, 179, 176, 0.25); color: #a0b3b0;">Public News Publishing System</h1>
	<div id="get_started">
		 
				<div class="field-wrap">
						<h1><?=$title?></h1>
					</div>

					<div class="field-wrap">
						<center>
							<img style="max-width:100%; height:auto;" src="<?=$photo?>" />
						</center>
					</div>
					
					<hr /><br />
				
				<div class="field-wrap">
					<label><span class="req"></span></label>
					<textarea rows="33" style="border: none" placeholder="News Text" name="text" required autocomplete="off"><?=$text?></textarea>
				</div>
				
				Published By: <?=$author_email?>
				<br />
				Publish Date: <?=$CreatedAt?>
				 
		</div>

	 
	<br />
<center><footer style="position: relative; bottom: 0px;  vertical-align: middle;  width:100%; height: 20px; color: white; background-color: black" >(C) All Rights Reserved. By <a href="mailto:nagar@aucegypt.edu">Ahmed Moussa</a></footer></center>

</div>
</body>
</html>