

<div>
	<!-- flash message -->
	<flash-message></flash-message>

	<div class="row">
		<div class="panel panel-default">
			<!-- heading -->
			<div class="panel-heading" ng-bind="user.name"></div>
			<div class="panel-body">
				<form name="form" class="form-horizontal" ng-submit="edit()">
					{{ csrf_field() }}
					<!-- name -->
                    <div class="form-group" ng-class="{'has-error': form.name.$touched && (form.name.$error.required || form.name.$error.maxlength || form.name.$error.minlength)}">
                        <label for="name" class="col-md-2 control-label">Name</label>
                        <div class="col-md-9">
                            <input id="name" 
                            		type="text" 
                            		class="form-control" 
                            		name="name"
                            		ng-model="user.name" 
                            		ng-minlength="2"
                            		ng-maxlength="16"
                            		required>
                            <div ng-if="form.name.$touched">
                                <span ng-if="form.name.$error.required" class="help-block">
                                    <strong>name field is required !</strong>
                                </span>
                                <span ng-if="form.name.$error.char" class="help-block">
                                    <strong>name may only contain letters !</strong>
                                </span>
                                <span ng-if="form.name.$error.maxlength || form.name.$error.minlength" class="help-block">
                                    <strong>name must be between :2 and :16!</strong>
                                </span>
                            </div>
                        </div>
                    </div>
						
					<!-- email -->
                    <div class="form-group" ng-class="{'has-error': form.email.$touched && (form.email.$error.required || form.email.$error.email)}">
                        <label for="email" class="col-md-2 control-label">E-Mail Address</label>
                        <div class="col-md-9">
                            <input id="email" 
                            		type="email" 
                            		class="form-control" 
                            		name="email"
                            		ng-model="user.email"
                            		required">
                            <div ng-if="form.email.$touched">
                                <span ng-if="form.email.$error.required" class="help-block">
                                    <strong>email field is required !</strong>
                                </span>
                                <span ng-if="form.email.$error.email" class="help-block">
                                    <strong>email is invalid !</strong>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- password -->
                    <div class="form-group">
                        <label for="password" class="col-md-2 control-label">Reset Password</label>
                        <div class="col-md-9">
                            <input id="password" 
                                    type="password" 
                                    class="form-control" 
                                    name="password"
                                    ng-model="user.password">
                        </div>
                    </div>
                

                    <div class="form-group">
                        <label class="col-md-2 control-label">Role</label>
                        <div class="col-md-9">
                            <select class="form-control" ng-model="create_data.role">
                                <option value="1" ng-selected="user.user_role.role === 1">1: Auth</option>
                                <option value="2" ng-selected="user.user_role.role === 2">2: Admin</option>
                                <option value="3" ng-selected="user.user_role.role === 3">3: Super Admin</option>
                            </select>
                        </div>
                    </div>

                    <!-- 提交服务器之后的错误提示 -->
                    <div class="form-group" ng-if="errors">
                        <div class="col-md-9 col-md-offset-2">
                            <ul class="res-error">
                            	<li ng-repeat="error in errors">
                            		<ul class="res-error">
                            			<li class="res-error-li" ng-repeat="mes in error">@{{ mes }}</li>
                            		</ul>
                            	</li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- cteate -->
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary" ng-disabled="form.$invalid">
                                Update
                            </button>
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>

