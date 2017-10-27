
<div class="row" ng-show="ready">
    <!-- Confirm delete modal -->
    <div delete-model ng-if="deleteModel" cancel="hideDeleteModel()" delete="deleteUser()"></div>

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
            					<td>
                                    <a ui-sref="users.edit({user_id: user.id})" ng-click="getUser(user.id)">编辑</a>
                                    <span>/</span>
                                    <span ng-click="showDeleteModel(user)" class="delete-model">删除</span>
                                </td>
            				</tr>
            			</tbody>
					</table>
					<llzpage></llzpage>
            	</div>
            </div>
		</div>
	</div>
</div>