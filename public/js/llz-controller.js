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
llz.controller('userController', ['$scope', '$http', '$window', '$stateParams', '$location', 'UserService', function($scope, $http, $window, $stateParams, $location, UserService)
{
	$scope.ready = true;

	//当前页的所有用户
	$scope.users = {};
	//用户分页
	$scope.pages = {}
	//监听服务users，当服务中的用户数据发生变化时，该控制器中的users也要跟着更新
	$scope.$on('users', function(e, users){
		$scope.users = UserService.users;
	});

	//新增或编辑时的错误数据
	$scope.errors = false;
	//新增用户时候的数据保存
	$scope.create_data = {};
	//新增用户
	$scope.create = function() {
		$http.post('/api/user/create', $scope.create_data)
			.then(function(res) {
				$window.location.href = '/admin/users/lists';
			}, function(res) {
				var data = res.data;
				//后台的验证，错误处理
				$scope.errors = data;
			});
	}
}])