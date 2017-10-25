
<div class="row" ng-show="ready">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<!-- panel heading -->
            <div class="panel-heading">
                <a ui-sref="users.create">
                    Create User
                </a>
            </div>
			
			<!-- panel body -->
            <div class="panel-body">
            	<div class="count-search"></div>

            	<!-- data table -->
            	<div class="table-responsive">
            		<table class="table table-hover">
            			<thead>
            				<tr>
            					<th>Name</th>
            					<th>Role</th>
            					<th>Email</th>
            					<th>Action</th>
            				</tr>
            			</thead>
            			<tbody>
            				<tr ng-repeat="user in users">
            					<td ng-bind="user.name"></td>
            					<td ng-bind="user.user_role.role | roles"></td>
            					<td ng-bind="user.email"></td>
            					<td>编辑、删除</td>
            				</tr>
            			</tbody>
					</table>
					<userpage></userpage>
            	</div>
            </div>
		</div>
	</div>
</div>