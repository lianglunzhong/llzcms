/**
 * 检查确认密码是否相同指令
 */
llz.directive('passwordCheck', function()
{
	return {
		restrict: 'AE',
		require: 'ngModel',
		scope: {
			password: '=passwordCheck' //定义该局部的password等于指令passwordCheck的值，
										//而在页面中，该指令的值为ng-model="password"的值
		},
		link: function($scope, ele, attrs, ctrl) {
			//同步验证
			ctrl.$validators.defer = function(value) {
				return value == $scope.password;
			}

			$scope.$watch('password', function() {
				ctrl.$validate();
			});
		}
	}
});

/**
 * 检查用户名是否存在指令
 */
llz.directive('nameCheck', function($q, UserService)
{	
	var NAME_REG = /^[a-zA-Z\u4e00-\u9fa5]+$/;
	return {
		restrict: 'A',
		require: 'ngModel',
		link: function($scope, ele, attrs, ctrl) {
			//同步验证：char为最后验证name是否符合要求的判断属性
			//使用方法：即form.name.$error.char
			ctrl.$validators.char = function(value) {
				if(!NAME_REG.test(value)) {
					return false;
				}
				return true;
			}

			//异步验证: exist为最后验证name是否存在的判断属性
			//使用方法：即form.name.$error.exist
			ctrl.$asyncValidators.exist = function(value) {
				//创建一个deferred对象
				var deferred = $q.defer();

				UserService.check_name_exist(value).then(function() {
					if(UserService.name_exist) {
						//拒绝deferred promise
						deferred.reject(false);
					}
					//执行deferred promise
					deferred.resolve(true);
				});

				return deferred.promise;
			}
		}
	}
});

llz.directive('emailCheck', function($q, UserService)
{
	return {
		restrict: 'A',
		require: 'ngModel',
		link: function($scope, ele, attrs, ctrl) {
			//异步验证: exist为最后验证name是否存在的判断属性
			//使用方法：即form.name.$error.exist
			ctrl.$asyncValidators.exist = function(value) {
				//创建一个deferred对象
				var deferred = $q.defer();

				UserService.check_email_exist(value).then(function() {
					if(UserService.email_exist) {
						//拒绝deferred promise
						deferred.reject(false);
					}
					//执行deferred promise
					deferred.resolve(true);
				});
				
				return deferred.promise;
			}
		}
	}
});


/**
 * 正在加载等待图片显示指令
 */
llz.directive('pageLoading', function() 
{
	return {
		restrict: 'AE',
		scope: {},
		template: '<div class="preloader"><img src="/admin/images/main/preloader.gif" alt="preloader gif"></div>'
	}
})