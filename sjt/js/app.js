var app = angular.module('SjtBack',[],function(){});

 app.config(['$routeProvider', function($routeProvider){
        $routeProvider.
            when('/', {
                template: 'wiri'
            }).when('/modifyPwd', {
                templateUrl: 'tpl/modifypwd.html'
            }).when('/bookticket', {
                template: '预定球票'
            }).when('/party', {
                template: '参加聚会'
            }).when('/playfootball', {
                template: '组织踢球'
            }).when('/joinus', {
                template: '加入我们'
            }).when('/picture', {
                template: '助威图片'
            }).when('/video', {
                template: '助威视频'
            }).when('/about', {
                template: '关于深九团'
            });
}]);