<?php

include "../template/buildConn.php";
@$conn = getConn();
mysqli_set_charset($conn, 'utf8');

function f_getOperatorTable($conn, $account){
    $sql = "SELECT * FROM operator WHERE account = '" . $account . "'";

    $queryResult = mysqli_query($conn, $sql);

    $result = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

    mysqli_free_result($queryResult);

    return $result;
}

session_start();
if(!isset($_SESSION['account'])){
    echo "<script>window.location.href = \"../log.php\";</script>";
}

if($_SESSION['account'] != 'master'){
    echo "<script>window.location.href = \"../log.php\";</script>";
}

//用户

if(isset($_POST['account'])){
    //echo "<script>alert(\"进入密码修改！\");</script>";
    $account = $_POST['account'];
    $oldPassword = $_POST['password'];
    $newPassword = $_POST['newPassword'];

    $operator = f_getOperatorTable($conn, $account);
    if($operator != null){
        $operator = $operator[0];
        if($operator['password'] == $oldPassword){
            if(strlen($newPassword) >= 6){
                $sql = "UPDATE operator SET password = " . $newPassword . " WHERE account = '" . $account . "'";
                mysqli_query($conn, $sql);
                echo "<script>alert(\"密码修改成功！\");</script>";
            }else{
                echo "<script>alert(\"新密码长度过短！\");</script>";
            }

        }else{
            echo "<script>alert(\"原密码错误！\");</script>";
        }
    }else{
        echo "<script>alert(\"账号不存在！\");</script>";
    }


    unset($_POST['account']);
    unset($_POST['password']);
    unset($_POST['newPassword']);


}

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



        </div>
    </div>
</div>




</body>
</html>