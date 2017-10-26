var llz = angular.module('llzApp', ['ui.router']);


/**
 * 路由配置
 */
llz.config(['$interpolateProvider', '$stateProvider', '$urlRouterProvider','$locationProvider',
	function($interpolateProvider, $stateProvider, $urlRouterProvider, $locationProvider)
	{
		// $urlRouterProvider.otherwise('/admin/404');

		$stateProvider
		.state('test', {
			url: '/test',
			template: '<div>这是路由测试</div>'
		})

		//dashboard
		.state('dashboard', {
			url: '/admin/dashboard',
			views: {
				'master': {templateUrl: '/admin/views/admin.dashboard.index'}
			}
		})

		//users(父类)
		.state('users', {
			abstract: true,  //抽象，不能直接访问该路由
			url: '/admin/users',
			views: {
				'master': {templateUrl: '/admin/views/admin.users.index'}
			}
		})
		//用户列表
		.state('users.lists', {
			url: '/lists',
			templateUrl: '/admin/views/admin.users.lists'
		})
		//新增用户
		.state('users.create', {
			url: '/create',
			templateUrl: '/admin/views/admin.users.create'
		})
		//编辑
		.state('users.edit', {
			url: '/edit/:user_id',
			templateUrl: '/admin/views/admin.users.edit'
		})

		$locationProvider.html5Mode(true);
	}
]);



/**
 * 路由监听
 */
llz.run(['$rootScope', '$state', '$window', '$location', '$log',
	function ($rootScope, $state, $window, $location, $log) 
	{
		//$stateChangeSuccess- 当模板解析完成后触发
		$rootScope.$on('$stateChangeSuccess',function(event, toState, toParams, fromState, fromParams){
			console.log('stateChangeSuccess');
			$rootScope.mainUrl = $location.url().split('/')[2];
			console.log($rootScope.mainUrl);
		});

		//$stateChangeError- 当模板解析过程中发生错误时触发
	    $rootScope.$on('$stateChangeError',function(event, toState, toParams, fromState, fromParams, error){}) 
	}
]);


/**
 * 过滤器
 */
llz.filter('roles', function() {
	return function(role) {
		//1:普通人员  2：管理员  3：超级管理员
		var roleWords = ['', 'Auth', 'Admin', 'Super Admin'];
		return roleWords[role];
	}
});
