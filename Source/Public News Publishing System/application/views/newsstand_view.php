<?php include('header_view.php'); ?>

<div ng-controller="controller">

<div ng-repeat="item in categories" class="list-group">
  <a href="#" class="list-group-item" ng-class="{active: hover}" ng-mouseenter="hover = true" ng-mouseleave="hover = false">
    <h4 class="list-group-item-heading">{{item.name}}</h4>
    <p class="list-group-item-text">{{item.CreatedAt}}</p>
  </a>
</div>

</div>

<?php include('footer_view.php'); ?>