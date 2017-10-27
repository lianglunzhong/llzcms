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
	//新增或编辑时的错误数据
	$scope.errors = false;

	//当前页的所有用户
	$scope.users = {};
	//用户分页
	$scope.pages = {}
	//监听服务users，当服务中的用户数据发生变化时，该控制器中的users也要跟着更新
	$scope.$on('users', function(e, users){
		$scope.users = UserService.users;
		$scope.ready = true;
	});

	//获取用户列表数据
	$scope.getPages = function(page) {
		return UserService.getPages(page)
	}

	//获取用户列表数据
	$scope.getLists = function(page) {
		return UserService.getUsers(page)
	}

	//编辑时的单个用户信息
	$scope.user = {};
	//在新标签中打开<a>连接时，根据当前的参数去获取用户
	if($stateParams.user_id) {
		UserService.getUser($stateParams.user_id);
	}
	//在当前页面中编辑，触发
	$scope.getUser = function(id) {
		UserService.getUser(id);
	}
	$scope.$on('user', function(e, user){
		$scope.user = UserService.user;
		$scope.ready = true;
	});


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

	$scope.edit = function() {
		$http.post('/api/user/edit', $scope.user)
			.then(function(res) {
				$scope.errors = false;
				layui.use('layer', function(){
				  	var layer = layui.layer;
				  	layer.msg('update user success !');
				}); 
				// $window.location.href = '/admin/users/lists';
			}, function(res) {
				var data = res.data;
				//后台的验证，错误处理
				$scope.errors = data;
			});
	}

	$scope.hideDeleteModel = function() {
		$scope.deleteModel = false;
	}
	$scope.showDeleteModel = function(user) {
		$scope.deleteModel = true;
		//把当前需要删除的用户信息赋给$scope.user,提交数据的时候直接提交该用户的id
		$scope.user = user;
	}
	$scope.deleteUser = function() {
		$scope.deleteModel = false;
		//当前分页，删除成功后更新当前页数据
		var page = $stateParams.page;
		//删除用户
		UserService.deleteUser($scope.user.id).then(function() {

			UserService.getUsers(page)

			layui.use('layer', function(){
			  	var layer = layui.layer;
			  	layer.msg('delete user success !');
			});

		}, function() {
			layui.use('layer', function(){
			  	var layer = layui.layer;
			  	layer.msg('delete user fail !');
			});
		});
	}
}])