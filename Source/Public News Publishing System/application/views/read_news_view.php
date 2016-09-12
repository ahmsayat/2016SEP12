<?php include('header_view.php'); ?>
<h1>Latest News Articles</h1>
	<div ng-controller="controller_2">

				<div ng-repeat="item in articles" class="list-group">
					<a ng-href="/article/{{item.ID}}" class="list-group-item" ng-class="{active: hover}" ng-mouseenter="hover = true" ng-mouseleave="hover = false"> <h4 class="list-group-item-heading">{{item.title}}</h4> <h6 class="list-group-item-heading">{{item.author_email}}</h6>
					<p class="list-group-item-text">
						{{item.CreatedAt}}
					</p></a>

				</div>

			</div>
<?php include('footer_view.php'); ?>