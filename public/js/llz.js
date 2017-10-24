var llz = angular.module('llzApp', ['ui.router']);


/**
 * 路由
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

		$locationProvider.html5Mode(true);
	}
])
