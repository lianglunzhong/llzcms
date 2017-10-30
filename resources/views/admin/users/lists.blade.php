
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
            	<div class="count-search">
                    <div class="row">
                        <div class="col-md-2">
                            <span>23 Users</span>
                        </div>
                        <div class="col-md-4 filter">
                            <span>Filter By : </span>
                            <select class="form-control">
                                <option value="1">Auth</option>
                                <option value="2">Admin</option>
                                <option value="3">Super Admin</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-md-offset-3">
                            <input type="text" class="form-control" name="" placeholder="Search">
                        </div>
                    </div>
                </div>

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
            	</div>

                <!-- page -->
                <llzpage></llzpage>
            </div>
		</div>
	</div>
</div>