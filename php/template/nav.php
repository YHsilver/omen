<?php

include "template/buildConn.php";

function f_getOperatorTable($conn, $account){
    $sql = "SELECT * FROM operator WHERE account = '" . $account . "'";

    $queryResult = mysqli_query($conn, $sql);

    $result = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

    mysqli_free_result($queryResult);

    return $result;
}

session_start();

if((!isset($_SESSION['account']))){
    echo "<script>window.location.href = \"log.php\"</script>";
}

$account = $_SESSION['account'];
$operator = f_getOperatorTable(getConn(), $account)[0];

if(!isset($_SESSION['username'])){
    $_SESSION['username'] = $operator['name'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>logIn</title>
    <link rel="stylesheet" href="../css/reset.css">
    <!-- Bootstrap core CSS -->
    <link href="../bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/log.css">
    <!-- Bootstrap core JavaScript-->
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="../bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row" style="margin-top: 50px;">
        <div class="col-sm-2">
            <img src="../images/omenLogo.png" alt="" class="img-responsive">
        </div>
        <div class="col-sm-10">

            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div>
                        <ul class="nav navbar-nav navbar-left">
                            <li id="homeLi"><a href="suit.php">库存中心</a></li>
                            <li id="orderLi"><a href="order.php">订单中心</a></li>
                            <li id="suitAddLi"><a href="suitAdding.php">添加服装</a></li>
                            <li id="cartLi"><a href="cart.php">等待租赁</a></li>
                            <?php
                                if($account == 'master') {
                                    echo "
                                    <li id=\"orderLi\"><a href=\"analysis/analysis.php\">业绩中心</a></li>";
                                }
                            ?>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#"><strong><?php echo $operator['name']; ?></strong></a></li>
                            <li><a href="log.php">退出登录</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

