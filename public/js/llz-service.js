/**
 * 用户服务
 */
llz.service('UserService', ['$http', function($http) {
	var userService = {};

	//用户列表
	userService.users = {};
	//单个用户
	userService.user = {};
	//当前登录用户
	userService.admin = {};
	
	/**
	 * 检查用户名是否已存在
	 * @param  {[string]} name [用户名]
	 * @return 返回ajax请求
	 */
	userService.check_name_exist = function(name) {
		//因为ajax异步的原因，在调用该方法是如果直接使用name_exist变量，则undefined,
		//因为此时的ajax请求还没有结束
		//此处直接返回ajax请求，在调用该方法可以继续使用，.then()，即：
		//check_name_exist(name).then(function(){})
		return $http.post('/admin/user/name-exist-check', {name:name})
			.then(function(res) {
				userService.name_exist = true;
			}, function(res) {
				userService.name_exist = false;
			})
	}

	//检查email是否已存在
	userService.check_email_exist = function(email) {
		//因为ajax异步的原因，在调用该方法里面的变量，则undefined,
		//因为此时的ajax请求还没有结束
		//此处直接返回ajax请求，在调用该方法可以继续使用，.then()，即：
		//check_name_exist(name).then(function(){})
		return $http.post('/admin/user/email-exist-check', {email:email})
			.then(function(res) {
				userService.email_exist = true;
			}, function(res) {
				userService.email_exist = false;
			})
	}

	//获取当前登录用户信息
	userService.getAdmin = function() {
		$http.post('/api/user/getAdmin', create_data)
			.then(function(res) {
				console.log(res);
			})
	}

	//后台新增用户
	userService.create = function(create_data) {
		console.log(create_data);
		return $http.post('/api/user/create', create_data)
	}

	return userService;
}]);