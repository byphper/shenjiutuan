var app = angular.module('SjtBack',[],function(){});

 app.config(['$routeProvider', function($routeProvider){
        $routeProvider.
            when('/', {
                template: 'wiri'
            }).when('/modifyPwd', {
                templateUrl: 'tpl/modifypwd.html',
                controller:'modifypwdCtrl'
            }).when('/bookticket', {
                template: '预定球票'
            });
}]);

 /**控制器*/
 app.controller('modifypwdCtrl', ['$scope',  function($scope){
        $scope.modify=function(){
            if($scope.pwd.new1!=$scope.pwd.new2){
                alert("两次密码不一致!");
            }else{

            }
        }  

}]);

 


