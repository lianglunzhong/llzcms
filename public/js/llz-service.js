/**
 * 用户服务
 */
llz.service('UserService', ['$http', function($http) {
	var user = {};
	
	/**
	 * 检查用户名是否已存在
	 * @param  {[string]} name [用户名]
	 * @return 返回ajax请求
	 */
	user.check_name_exist = function(name) {
		//因为ajax异步的原因，在调用该方法是如果直接使用name_exist变量，则undefined,
		//因为此时的ajax请求还没有结束
		//此处直接返回ajax请求，在调用该方法可以继续使用，.then()，即：
		//check_name_exist(name).then(function(){})
		return $http.post('/admin/user/name-exist-check', {name:name})
			.then(function(res) {
				user.name_exist = true;
			}, function(res) {
				user.name_exist = false;
			})
	}

	//检查email是否已存在
	user.check_email_exist = function(email) {
		//因为ajax异步的原因，在调用该方法里面的变量，则undefined,
		//因为此时的ajax请求还没有结束
		//此处直接返回ajax请求，在调用该方法可以继续使用，.then()，即：
		//check_name_exist(name).then(function(){})
		return $http.post('/admin/user/email-exist-check', {email:email})
			.then(function(res) {
				user.email_exist = true;
			}, function(res) {
				user.email_exist = false;
			})
	}

	return user;
}]);