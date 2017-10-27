@include('admin.layouts.header')

<div class="container" ng-controller="RegisterController">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default register-box">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" name="form" ng-submit="register()">
                        {{ csrf_field() }}
                        <!-- name -->
                        <div class="form-group" ng-class="{'has-error': form.name.$touched && (form.name.$error.required || form.name.$error.maxlength || form.name.$error.minlength || form.name.$error.char || form.name.$error.exist || form.name.$error.res)}">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" 
                                		type="text" 
                                		class="form-control" 
                                		name="name"
                                		ng-model="register_data.name" 
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
                        <div class="form-group" ng-class="{'has-error': form.email.$touched && (form.email.$error.required || form.email.$error.email || form.email.$error.exist || form.email.$error.res)}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" 
                                		type="email" 
                                		class="form-control" 
                                		name="email"
                                		ng-model="register_data.email"
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
						
						<!-- password -->
                        <div class="form-group" ng-class="{'has-error': form.password.$touched && (form.password.$error.required || form.password.$error.minlength || form.password.$error.maxlength || form.password.$error.res)}">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" 
                                		type="password" 
                                		class="form-control" 
                                		name="password"
                                		ng-model="register_data.password"
                                		ng-maxlength="24"
                                		ng-minlength="6"
                                		required>
								<div ng-if="form.password.$touched">
	                                <span ng-if="form.password.$error.required" class="help-block">
	                                	<strong >password is required !</strong>
	                                </span>
	                                <span ng-if="form.password.$error.maxlength || form.password.$error.minlength" class="help-block">
	                                    <strong>password must be between 6 and 24 !</strong>
	                                </span>
								</div>
                            </div>
                        </div>
						
						<!-- Confirm Password -->
                        <div class="form-group" ng-class="{'has-error': form.password_confirmation.$touched && form.password_confirmation.$error.defer || form.password.$error.res}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" 
                                		type="password" 
                                		class="form-control" 
                                		name="password_confirmation" 
                                		password-check="register_data.password"
                                		ng-model="register_data.password_confirmation">
                                <div ng-if="form.password_confirmation.$touched">
	                                <span ng-if="form.password_confirmation.$error.defer" class="help-block">
	                                    <strong >the two passwords do not match !</strong>
	                                </span>
								</div>
                            </div>
                        </div>

                        <div class="form-group" ng-if="form.errors">
                            <div class="col-md-6 col-md-offset-4">
                                <ul class="res-error">
                                	<li ng-repeat="error in form.errors">
                                		<ul class="res-error">
                                			<li class="res-error-li" ng-repeat="mes in error">@{{ mes }}</li>
                                		</ul>
                                	</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="layui-btn" ng-disabled="form.$invalid">
                                    Register
                                </button>
                                <a class="btn btn-link" href="/admin/login" target="_self">
                                    Login
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@include('admin.layouts.footer')