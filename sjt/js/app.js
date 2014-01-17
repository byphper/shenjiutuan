var app = angular.module('SjtBack', [], function() {});

app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
        when('/', {
            template: 'wiri'
        }).when('/modifyPwd', {
            templateUrl: 'tpl/modify_pwd.html',
            controller: 'modifypwdCtrl'
        }).when('/addNews', {
            templateUrl: 'tpl/add_news.html',
            controller: 'newsCtrl'
        }).when('/newsList', {
            template: 'hahaha',
            controller: 'newsCtrl'
        });
    }
]);


/**控制器*/
app.controller('newsCtrl', ['$scope', '$http','$cacheFactory', '$location',
    function($scope, $http,$cacheFactory,$location) {

       $scope.ueObj=UE.getEditor('editor');
      
       if(!window.editorHtml){
            window.editorHtml=$("#warp_editor").html();
       }
       $("#warp_editor").html(window.editorHtml);
    
       $scope.submit=function(){
            var c=document.getElementsByName("editorValue")[0];
            $scope.news.content=$(c).val();
    
            if(!$scope.news.title||!$scope.news.content){
                alert("标题或内容不能为空！");
                return;
            }

            $http.post("../index.php/Admin/news/add", $scope.news).success(function(data){
               if(data.status==1){
                    alert("添加成功");
                    $location.path("/newsList")
               }else{
                    alert(data.msg);
               }
            });
       }
    }
]);

//修改密码controller
app.controller('modifypwdCtrl', ['$scope', '$http', '$location',
    function($scope, $http) {
        $scope.modify = function() {
            if ($scope.pwd.new1.length < 6 || $scope.pwd.new1.length < 6 || $scope.pwd.old.length < 6) {
                alert("密码长度至少是6位！");
                return;
            }
            if ($scope.pwd.new1 != $scope.pwd.new2) {
                alert("两次密码不一致!");
            } else {
                $http.post("../index.php/Admin/user/changePwd", $scope.pwd).success(function(data) {

                    if (data.result == 1) {
                        alert("更新成功");
                        $location.path('/');
                    } else {
                        alert(data.msg)
                    }
                });
            }
        }

    }
]);