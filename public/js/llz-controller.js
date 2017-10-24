/**
 * 登录控制器
 */
llz.controller('LoginController', ['$scope', '$http', '$window', function($scope, $http, $window)
{
	$scope.login_data = {};

	$scope.login = function() {
		$http.post('/admin/login', $scope.login_data)
			.then(function(res) {
				$window.location.href = '/admin/dashboard';
			}, function(res) {
				$scope.form.errors = true;
			})
	}
}]);


/**
 * 注册控制器
 */
llz.controller('RegisterController', ['$scope', '$http', '$window', 'UserService', function($scope, $http, $window, UserService)
{	
	//使用服务
	$scope.user = UserService;
	//保存注册的数据
	$scope.register_data = {};

	//注册（提交数据方法）
	$scope.register = function() 
	{
		$http.post('/admin/register', $scope.register_data)
			.then(function(res) {
				$window.location.href = '/admin/dashboard';
			}, function(res) {
				var data = res.data;
				//后台的验证，错误处理
				$scope.form.name.$error.res = $scope.form.password.$error.res = $scope.form.email.$error.res = $scope.form.errors = false;
				if(data.name){
					$scope.form.name.$error.res = true;
				}
				if(data.email){
					$scope.form.email.$error.res = true;
				}
				if(data.password){
					$scope.form.password.$error.res = true;
				}

				$scope.form.errors = data;
			})
	}
}]);


/**
 * dashboard控制器
 */
llz.controller('dashboardController', ['$scope', function($scope) 
{
	$scope.ready = true;
}]);


/**
 * user控制器
 */
llz.controller('userController', ['$scope', function($scope)
{
	$scope.ready = true;
}])