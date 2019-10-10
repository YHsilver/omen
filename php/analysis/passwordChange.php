<?php

include "../template/buildConn.php";
@$conn = getConn();
mysqli_set_charset($conn, 'utf8');

session_start();
if(!isset($_SESSION['account'])){
    echo "<script>window.location.href = \"../log.php\";</script>";
}

if($_SESSION['account'] != 'master'){
    echo "<script>window.location.href = \"../log.php\";</script>";
}

//用户

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Omen Master Page</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <!-- Bootstrap core CSS -->
    <link href="../../bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../css/log.css">

</head>
<body>
<div class="container" style="margin-top: 40px">
    <div class="row">
        <div class="col-sm-3">
            <img src="../../images/omenLogo.png" alt="" class="img-responsive">
            <div class="row" style="margin-top: 50px;">
                <div class="col-sm-6 text-center">
                    <a class="btn btn-default" href="passwordChange.php">修改密码</a>
                </div>
                <div class="col-sm-6 text-center">
                    <a class="btn btn-default" href="../log.php">退出登录</a>
                </div>
            </div>

        </div>
        <div class="col-sm-9">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">业绩查询</a>
                    </div>
                    <div>
                        <ul class="nav navbar-nav">
                            <li><a href="staffRank.php">个人业绩</a></li>
                            <li><a href="saleSearch.php">销售额</a></li>
                            <li><a href="clientRange.php">客户来源</a></li>
                            <li><a href="../home.php">库存与订单</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <form class="form-horizontal" role="form" style="margin-top: 45px;" action="analysis.php" method="post" autocomplete="off">
                <div class="form-group">
                    <label for="account" class="col-sm-2 control-label">账号</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="account" id="account" placeholder="请输入账号">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">原密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="password" placeholder="请输入原密码">
                    </div>
                </div>
                <div class="form-group">
                    <label for="newPassword" class="col-sm-2 control-label">新密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="请输入新密码">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">提交修改</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
