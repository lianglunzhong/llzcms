

<div>
	<!-- flash message -->
	<flash-message></flash-message>

	<div class="row">
		<div class="panel panel-default">
			<!-- heading -->
			<div class="panel-heading">Create user</div>
			<div class="panel-body">
				<form name="form" class="form-horizontal" ng-submit="create()">
					{{ csrf_field() }}
					<!-- name -->
                    <div class="form-group" ng-class="{'has-error': form.name.$touched && (form.name.$error.required || form.name.$error.maxlength || form.name.$error.minlength || form.name.$error.char || form.name.$error.exist)}">
                        <label for="name" class="col-md-2 control-label">Name</label>
                        <div class="col-md-9">
                            <input id="name" 
                            		type="text" 
                            		class="form-control" 
                            		name="name"
                            		ng-model="create_data.name" 
                            		ng-minlength="2"
                            		ng-maxlength="16"
                                    name-check
                            		required
                                    ng-model-options="{ debounce: 500 }">
                            <div ng-if="form.name.$touched">
                                <span ng-if="form.name.$error.required" class="help-block">
                                    <strong>name field is required !</strong>
                                </span>
                                <span ng-if="form.name.$error.char" class="help-block">
                                    <strong>name may only contain letters !</strong>
                                </span>
                                <span ng-if="form.name.$error.exist" class="help-block">
                                    <strong>name has already been taken !</strong>
                                </span>
                                <span ng-if="form.name.$error.maxlength || form.name.$error.minlength" class="help-block">
                                    <strong>name must be between :2 and :16!</strong>
                                </span>
                            </div>
                        </div>
                    </div>
						
					<!-- email -->
                    <div class="form-group" ng-class="{'has-error': form.email.$touched && (form.email.$error.required || form.email.$error.email || form.email.$error.exist)}">
                        <label for="email" class="col-md-2 control-label">E-Mail Address</label>
                        <div class="col-md-9">
                            <input id="email" 
                            		type="email" 
                            		class="form-control" 
                            		name="email"
                            		ng-model="create_data.email"
                                    email-check
                            		required
                                    ng-model-options="{ debounce: 500 }">
                            <div ng-if="form.email.$touched">
                                <span ng-if="form.email.$error.required" class="help-block">
                                    <strong>email field is required !</strong>
                                </span>
                                <span ng-if="form.email.$error.exist" class="help-block">
                                    <strong>email has already been taken !</strong>
                                </span>
                                <span ng-if="form.email.$error.email" class="help-block">
                                    <strong>email is invalid !</strong>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Role</label>
                        <div class="col-md-9">
                            <select class="form-control" ng-model="create_data.role">
                                <option value="1">1: 普通人员</option>
                                <option value="2">2: 管理员</option>
                                <option value="3">3: 超级管理员</option>
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
                                Create
                            </button>
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>

