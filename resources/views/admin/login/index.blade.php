@include('admin.layouts.header')

<div class="container" ng-controller="LoginController">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default login-box">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" name="form" ng-submit="login()">
                        {{ csrf_field() }}
						
						<!-- email -->
                        <div class="form-group" ng-class="{'has-error':form.email.$touched && (form.email.$error.email || form.email.$error.required)}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" 
                                        type="email" 
                                        class="form-control" 
                                        name="email"
                                        ng-model="login_data.email" 
                                        required>
                                <div ng-if="form.email.$touched">
                                    <span ng-if="form.email.$error.email" class="help-block">
                                        <strong>email is invalid!</strong>
                                    </span>
                                    <span ng-if="form.email.$error.required" class="help-block">
                                        <strong>email is required!</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
						
						<!-- password -->
                        <div class="form-group" ng-class="{'has-error': form.password.$touched && (form.password.$error.maxlength || form.password.$error.minlength || form.password.$error.required)}">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" 
                                        type="password" 
                                        class="form-control" 
                                        name="password" 
                                        ng-model="login_data.password"
                                        ng-maxlength="24"
                                        ng-minlength="6"
                                        required>
                                <div ng-if="form.password.$touched">
                                    <span ng-if="form.password.$error.maxlength || form.password.$error.minlength" class="help-block">
                                        <strong>password between 6 and 24!</strong>
                                    </span>
                                    <span ng-if="form.password.$error.required" class="help-block">
                                        <strong>password is required!</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
						
						<!-- Remember -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" 
                                                name="remember"
                                                ng-model="login_data.remember" 
                                                value="1">
                                            Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- 错误提示 -->
                        <div ng-if="form.errors" class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <ul class="res-error">
                                    <li class="res-error-li">
                                       The email or password you entered is not correct!
                                    </li>
                                </ul>
                            </div>
                        </div>
						
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button ng-disabled="form.$invalid" type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                                <a class="btn btn-link" href="/admin/register" target="_self">
                                    Register
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