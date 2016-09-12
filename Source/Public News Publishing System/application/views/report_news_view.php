<?php
include ('header_view.php');
?>
<div class="form">
   <span style="color:green">Welcome, <?=$this -> session -> userdata('email')?></span>
	<p class="forgot">
		<a href="logout">Logout</a>
	</p>
	
	<br />
	
	<ul class="tab-group">
		<li class="tab active">
			<a href="#get_started">My News List</a>
		</li>
		<li class="tab">
			<a href="#login">New Post</a>
		</li>
	</ul>

	<div class="tab-content">
		<div id="get_started">

			<div ng-controller="controller">

				<div ng-repeat="item in articles" class="list-group">
					<a ng-href="/article/{{item.ID}}" class="list-group-item" ng-class="{active: hover}" ng-mouseenter="hover = true" ng-mouseleave="hover = false"> <h4 class="list-group-item-heading">{{item.title}}</h4> <h6 class="list-group-item-heading">{{item.author_email}}</h6>
					<p class="list-group-item-text">
						{{item.CreatedAt}}
					</p> <a ng-href="/unpublish/{{item.ID}}">remove</a> </a>

				</div>

			</div>

		</div>
		<div id="login">
			<h1>Publish News Article</h1>

			<form action="/publish" method="post">

				<div class="field-wrap">
					<label>Title<span class="req">*</span> </label>
					<input type="text" name="title" required autocomplete="off" />
				</div>

				<div class="field-wrap">
					<label>Photo URL<span class="req">*</span> </label>
					<input type="text" name="photo" required autocomplete="off"/>
				</div>

				<div class="field-wrap">
					<label><span class="req"></span></label>
					<textarea rows="9" placeholder="News Text" name="text" required autocomplete="off"></textarea>
				</div>

				<button class="button button-block"/>
				Publish</button>

			</form>
		</div>

	</div><!-- tab-content -->

</div>

<?php echo validation_errors(); ?>
<?php
	include ('footer_view.php');
?>