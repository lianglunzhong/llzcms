
<div ng-controller="userController">
	<!-- main heading -->
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">Users</h3>
			<page-loading ng-show="!ready"></page-loading>
		</div>
	</div>

	<div ui-view></div>

</div>
