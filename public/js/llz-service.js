/**
 * 用户服务
 */
llz.service('UserService', ['$http', '$rootScope', function($http, $rootScope) {
	var userService = {};

	//用户列表
	userService.users = {};
	//用户分页
	userService.pages = {};
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

	//获取用户列表数据
	userService.getUsers = function(page=1) {
		$http.post('/api/user/getUsers?page='+page)
			.then(function(res) {
				if(res.data) {
					userService.users = res.data.data;
					//广播事件，即：当服务中的uers发生改变是，通知下级需要更新，下级使用$on监听;
					$rootScope.$broadcast('users', userService.users);
				}
			})
	}

	//获取用户分页数据
	userService.getPages = function(page=1) {
		return $http.post('/api/user/getUsers?page='+page)
			.then(function(res) {
				if(res.data) {
					//当前页
					userService.pages['current_page'] = res.data.current_page;
					//每页显示数量
					userService.pages['per_page'] = res.data.per_page;
					//用户总数
					userService.pages['total'] = res.data.total;

					return userService.pages;
				}
			})
	}

	//获取单个用户数据
	userService.getUser = function(id) {
		$http.post('/api/user/getUser', {id:id})
			.then(function(res) {
				if(res.data) {
					userService.user = res.data;
					//广播事件，即：当服务中的uers发生改变是，通知下级需要更新，下级使用$on监听;
					$rootScope.$broadcast('user', userService.user);
				}
			})
	}

	//获取当前登录用户信息
	userService.getAdmin = function() {
		$http.post('/api/user/getAdmin', create_data)
			.then(function(res) {
				console.log(res);
			})
	}

	//删除用户
	userService.deleteUser = function(id) {
		return $http.post('/api/user/delete', {id: id});
	}

	return userService;
}]);