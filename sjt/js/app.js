window.setPage = function(url) {
    url = encodeURIComponent(url);
    window.location.href = "#/news/list/?url=" + url;
}

window.changePage = function(uri, val) {
    setPage(uri + val);
}

var app = angular.module('SjtBack', ['ngRoute', 'ngSanitize'], function() {});

app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
        when('/', {

        }).when('/modifyPwd', {
            templateUrl: 'tpl/modify_pwd.html',
            controller: 'modifypwdCtrl'
        }).when('/news/:curd', {
            templateUrl: function(params) {
                return 'tpl/news/' + params.curd + '.html';
            },
            controller: 'newsCtrl'
        }).when('/user', {
            templateUrl: 'tpl/user_info.html',
            controller: 'userCtrl'
        });
    }
]);


//會員管理controller
app.controller('userCtrl', ['$scope', '$http', '$location','$routeParams',
    function($scope, $http, $location,$routeParams) {
        var curd = $routeParams.del;

        var $url = $routeParams.url ? $routeParams.url : "../index.php/Admin/user/ajaxGetUsers?page=1";
        $http.get($url).success(function(data) {
                $scope.users = data.data;
                $scope.page = data.page;
                $("#page").html(data.page);

        });
    }
]);

//新聞controller
app.controller('newsCtrl', ['$scope', '$http', '$location', '$routeParams', '$compile',
    function($scope, $http, $location, $routeParams, $compile) {
        var curd = $routeParams.curd;

        $scope.addNews = function() {
            $location.path("/news/add");
        }
        switch (curd) {
            case 'list':
                if ($routeParams.del=='sure') {
                    $delid = $routeParams.id;
                    if ($delid = parseInt($delid)) {
                        var dUrl = "../index.php/Admin/news/delOneNews?id=" + $delid;
                        $http.get(dUrl).success(function(data) {
                            if (data == 1) {
                                alert('刪除成功');
                            } else {
                                alert('刪除失敗');
                            }
                        });
                    }
                }

                var $url = $routeParams.url ? $routeParams.url : "../index.php/Admin/news/ajaxGetNews?page=1";

                $http.get($url).success(function(data) {
                    $scope.list = data.data;
                    $scope.page = data.page;
                    $("#page").html(data.page);
                });
                break;
            case 'add':
                $scope.news = {};
                var id = $routeParams.id;
                var mdUrl = "../index.php/Admin/news/add";
                if (id = parseInt(id)) {
                    mdUrl = "../index.php/Admin/news/update";
                    $scope.news.id = id;

                    $http.get("../index.php/Admin/news/getOneNews?id="+id).success(function(data) {
                        $scope.news.title = data[0].title;
                        $scope.news.isPublic = data[0].status==1?true:false;
                        $("#editor").html(data[0].content);
                         $scope.type = "確認修改";
                        $scope.ueObj = UE.getEditor('editor');
                    });

                } else {
                    $scope.news.isPublic = true;
                    $scope.type = "确认添加";
                     $scope.ueObj = UE.getEditor('editor');
                }

                $scope.public = function() {
                    if ($scope.news.isPublic) {
                        $scope.news.isPublic = false;
                    } else {
                        $scope.news.isPublic = true;
                    }
                }

                $scope.submit = function() {
                    var c = document.getElementsByName("cnm");
                    $scope.news.content = $(c).val();

                    if (!$scope.news.title || !$scope.news.content) {
                        alert("标题或内容不能为空！");
                        return;
                    }

                    $http.post(mdUrl, $scope.news).success(function(data) {
                        if (data.status == 1) {
                            alert(data.msg);
                            $location.path("/news/list")
                        } else {
                            alert(data.msg);
                        }
                    });
                }
                break;
            default:
                $location.path('/');
        }

    }
]);

//修改密码controller
app.controller('modifypwdCtrl', ['$scope', '$http', '$location',
    function($scope, $http, $location) {
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