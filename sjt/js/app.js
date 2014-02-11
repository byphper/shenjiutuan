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
            templateUrl: 'tpl/welcome.html'
        }).when('/modifyPwd', {
            templateUrl: 'tpl/modify_pwd.html',
            controller: 'modifypwdCtrl'
        }).when('/news/:curd', {
            templateUrl: function(params) {
                return 'tpl/news/' + params.curd + '.html';
            },
            controller: 'newsCtrl'
        }).when('/user/:curd', {
            templateUrl: function(parms) {
                return 'tpl/' + parms.curd + '.html';
            },
            controller: 'userCtrl'
        }).when('/ball/:curd', {
            templateUrl: function(parms) {
                return 'tpl/' + parms.curd + '.html';
            },
            controller: 'ballCtrl'
        }).when('/party/:curd', {
            templateUrl: function(parms) {
                return 'tpl/' + parms.curd + '.html';
            },
            controller: 'partyCtrl'
        }).when('/about', {
            templateUrl:"tpl/about.html",
            controller: 'aboutCtrl'
        });
    }
]);

app.controller('aboutCtrl', ['$scope', '$http', '$location', '$routeParams',
    function($scope, $http, $location, $routeParams) {
            $http.get("../index.php/Admin/about/get").success(function(data){
                $("#editor").html(data.data[0].content);
                UE.getEditor('editor');
                 
            });

            $scope.about=function(){
                 var c = document.getElementsByName("cnm");
                 $http.post("../index.php/Admin/about/add",{content:$(c).val()}).success(function(data){
                    if(data=='1'){
                        alert("修改成功");
                    }
                 });
            }
    }
]);

//聚会管理controller
app.controller('partyCtrl', ['$scope', '$http', '$location', '$routeParams',
    function($scope, $http, $location, $routeParams) {
        var id = $routeParams.id;
        var curd = $routeParams.curd;

        var $url = "../index.php/Admin/party/add";

        if (curd == 'party_list') {
            var del = $routeParams.del;
            if (del == 'true') {
                var flag = window.confirm("确认删除？");
                if (flag) {
                    if (id = parseInt(id)) {
                        $http.get("../index.php/Admin/party/del?id=" + id).success(function(data) {
                            if (data.status == '-1') {
                                alert("删除失败!");
                            } else {
                                alert("删除成功！");
                            }
                            window.location.href = "./main.php#party/party_list";
                        });
                    }
                }
            }

            var $url = $routeParams.url ? $routeParams.url : "../index.php/Admin/party/ajaxGetParty?page=1";
            $http.get($url).success(function(data) {
                $scope.party = data.data;
                $scope.page = data.page;

                $("#page").html(data.page);
            });

        } else if (curd == "add_party") {

            if (id = parseInt(id)) {
                $url = "../index.php/Admin/party/update";
                $http.get("../index.php/Admin/party/getOneParty?id=" + id).success(function(data) {
                    if (data != '-1') {
                        $scope.party = {};
                        $scope.party.title = data[0].title;
                        $scope.party.status = data[0].status;
                        $scope.party.content = data[0].content;
                        $scope.type = "确认修改";
                    }

                });
            } else {

                $scope.type = "确认添加";
            }
        } else if (curd == "party_logs") {
            var del = $routeParams.del;
            var lid=$routeParams.lid;
            if (del == 'true') {
                var flag = window.confirm("确认删除？");
                if (flag) {
                    if (lid = parseInt(lid)) {
                        $http.get("../index.php/Admin/party/dellog?lid=" + lid).success(function(data) {
                            if (data!= '1') {
                                alert("删除失败!");
                            } else {
                                alert("删除成功！");
                            }
                            window.location.href = "./main.php#party/party_logs?id="+id;
                        });
                    }
                }
            }

            if (id = parseInt(id)) {
                $http.get("../index.php/Admin/party/partylog?id=" + id).success(function(data) {
                    if (data != "-1") {
                        $scope.logs = data.data;
                        $scope.title = data.title[0].title;
                        $scope.id=data.title[0].id;
                    }

                });
            }
        } else if (curd == "partylog_edit") {
             var lid=$routeParams.lid;
            if (lid = parseInt(lid)) {
                $http.get("../index.php/Admin/party/getOnePartyLog?id=" + lid).success(function(data) {
                    if (data != "-1") {
                        $scope.log = data[0];
                    }

                });
            }
        }

        $scope.edit_log = function() {
            var $url = "../index.php/Admin/party/updatelog";
             var lid=$routeParams.lid;
            if (lid = parseInt(lid)){
                $scope.log.id = lid;
                $http.post($url, $scope.log).success(function(data) {
                    if (data.status != '1') {
                        alert(data.msg);
                    } else {
                        alert(data.msg);
                         window.location.href = "./main.php#party/party_logs?id="+id;
                    }
                });
            }
        }

        $scope.addParty = function() {
            $location.path("/party/add_party");
        }

        $scope.add = function() {
            $scope.party.id=id;
            $http.post($url, $scope.party).success(function(data) {
                if (data.status) {
                    alert(data.msg);
                    $location.path("/party/party_list");
                } else {
                    alert(data.msg);
                }
            });
        }
    }
]);


//球票預定管理controller
app.controller('ballCtrl', ['$scope', '$http', '$location', '$routeParams',
    function($scope, $http, $location, $routeParams) {
        var id = $routeParams.id;
        var curd = $routeParams.curd;

        var $url = "../index.php/Admin/ball/add";

        if (curd == 'ball_list') {
            var del = $routeParams.del;
            if (del == 'true') {
                var flag = window.confirm("确认删除？");
                if (flag) {
                    if (id = parseInt(id)) {
                        $http.get("../index.php/Admin/ball/del?id=" + id).success(function(data) {
                            if (data.status == '-1') {
                                alert("删除失败!");
                            } else {
                                alert("删除成功！");
                            }
                            window.location.href = "./main.php#ball/ball_list";
                        });
                    }
                }
            }

            var $url = $routeParams.url ? $routeParams.url : "../index.php/Admin/ball/ajaxGetBalls?page=1";
            $http.get($url).success(function(data) {
                $scope.ball = data.data;
                $scope.page = data.page;

                $("#page").html(data.page);
            });

        } else if (curd == "add_match") {
            if (id = parseInt(id)) {
                $url = "../index.php/Admin/ball/update";
                $http.get("../index.php/Admin/ball/getOneBall?id=" + id).success(function(data) {
                    if (data != '-1') {
                        $scope.ball = {};
                        $scope.ball.title = data[0].title;
                        $scope.ball.match_op = data[0].match_op;
                        $scope.ball.match_address = data[0].match_address;
                        $scope.ball.ticket_cost = data[0].ticket_cost;
                        $scope.ball.car_cost = data[0].car_cost;
                        $scope.ball.status = data[0].status;
                        $("#match_time").val(data[0].match_time);
                        $scope.type = "确认修改";
                    }

                });
            } else {

                $scope.type = "确认添加";
            }
        } else if (curd == "ball_deatils") {
            var lid=$routeParams.lid;
             var del = $routeParams.del;
            if (del == 'true') {
                var flag = window.confirm("确认删除？");
                if (flag) {
                    if (lid = parseInt(lid)) {
                        $http.get("../index.php/Admin/ball/dellog?lid=" + lid).success(function(data) {
                            if (data!= '1') {
                                alert("删除失败!");
                            } else {
                                alert("删除成功！");
                            }
                            window.location.href = "./main.php#ball/ball_deatils?id="+id;
                        });
                    }
                }
            }

            if (id = parseInt(id)) {
                $http.get("../index.php/Admin/ball/balllog?id=" + id).success(function(data) {
                    if (data != "-1") {
                        $scope.logs = data.data;
                        $scope.title = data.title[0].title;
                        $scope.id = data.title[0].id;
                    }

                });
            }
        } else if (curd == "log_edit") {
            if (id = parseInt(id)) {
                $http.get("../index.php/Admin/ball/getOneBallLog?id=" + id).success(function(data) {
                    if (data != "-1") {
                        $scope.log = data[0];
                    }

                });
            }
        }

        $scope.edit_log = function() {

            var $url = "../index.php/Admin/ball/updatelog";
           var bid=$routeParams.bid;
            if($scope.log.style=='0'){
                $scope.log.goadd="不跟車";
                $scope.log.car_nums=0;
            }
            $http.post($url, $scope.log).success(function(data) {
                if (data == '0') {
                    alert(data.msg)
                } else {
                    alert(data.msg);
                   window.location.href = "./main.php#ball/ball_deatils?id="+bid;
                }
            });
        }

        $scope.addMatch = function() {
            $location.path("/ball/add_match");
        }

        $scope.add = function() {

            $date = $("#match_time").val();
            $scope.ball.match_time = $date;
            $scope.ball.id = id;
            $http.post($url, $scope.ball).success(function(data) {
                if (data.status) {
                    $location.path("/ball/ball_list");
                } else {
                    alert(data.msg);
                }
            });
        }
    }
]);


//會員管理controller
app.controller('userCtrl', ['$scope', '$http', '$location', '$routeParams',
    function($scope, $http, $location, $routeParams) {
        var curd = $routeParams.curd;

        $scope.modify = function() {
            var $url = "../index.php/Admin/user/update";
            $http.post($url, $scope.user).success(function(data) {
                if (data == '0') {
                    alert(data.msg)
                } else {
                    alert(data.msg);
                    $location.path("/user/user_info");
                }
            });

        }
        switch (curd) {
            case 'user_edite':
                var id = $routeParams.id;
                var $url = "../index.php/Admin/user/getOneUser?id=" + id;
                $http.get($url).success(function(data) {
                    if (data != '-1') {
                        $scope.user = data[0];
                        $scope.user.isVip = data[0].isVip == 1 ? true : false;
                        $scope.user.isYear = data[0].isYear == 1 ? true : false;
                        $scope.user.isAdmin = data[0].isAdmin == 1 ? true : false;
                    }

                });
                break;
            default:
                var $url = $routeParams.url ? $routeParams.url : "../index.php/Admin/user/ajaxGetUsers?page=1";
                $http.get($url).success(function(data) {
                    $scope.users = data.data;
                    $scope.page = data.page;
                    $("#page").html(data.page);
                });

        }

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
                if ($routeParams.del == 'sure') {
                    var flag = window.confirm("确认删除？");
                    if (flag) {
                        $delid = $routeParams.id;
                        if ($delid = parseInt($delid)) {
                            var dUrl = "../index.php/Admin/news/delOneNews?id=" + $delid;
                            $http.get(dUrl).success(function(data) {
                                if (data == 1) {
                                    alert('刪除成功');
                                } else {
                                    alert('刪除失敗');
                                }
                                window.location.href = "./main.php#news/list";
                            });
                        }
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

                    $http.get("../index.php/Admin/news/getOneNews?id=" + id).success(function(data) {
                        $scope.news.title = data[0].title;
                        $scope.news.isPublic = data[0].status == 1 ? true : false;
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