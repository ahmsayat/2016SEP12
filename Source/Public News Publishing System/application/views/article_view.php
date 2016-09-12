<?php include('header_view.php'); ?>

<div class="form">

	<ul class="tab-group">
		<li class="tab active">
			<a href="#get_started">Read</a>
		</li>
		<li class="tab">
			<a href="#login">Export</a>
		</li>
	</ul>

	<div class="tab-content">
		<div id="get_started">
		 
				<div class="field-wrap">
						<h1><?=$title?></h1>
					</div>

					<div class="field-wrap">
						<center>
							<img style="max-width:100%; height:auto;" src="<?=$photo?>" />
						</center>
					</div>
				
				<div class="field-wrap">
					<label><span class="req"></span></label>
					<textarea rows="33" style="border: none" placeholder="News Text" name="text" required autocomplete="off"><?=$text?></textarea>
				</div>
				
				<p style="color: yellow">
				Published By: <?=$author_email?>
				<br /><br />
				Publish Date: <?=$CreatedAt?>
				<br /><br />
				</p>
				
				
			<hr />
				<br />
				<p class="forgot">
					<a href="/download_as_pdf/<?=$ID?>">Download As PDF</a> <span style="color:white;"> | </span> <a href="/pdf/<?=$ID?>">Printer-friendly Version</a>
				</p>
			
		</div>
		
		<div id="login">
			<h1>Export to Pdf</h1>

			<form action="/download_as_pdf/<?=$ID?>" method="post">

				<button class="button button-block"/>
				Download</button>

			</form>

		</div>

	</div><!-- tab-content -->

</div>
<?php include('footer_view.php'); ?>