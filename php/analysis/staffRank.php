<?php

include "../template/buildConn.php";
@$conn = getConn();


function f_getStaffTable($conn){
    $sql = "SELECT * FROM operator ORDER BY sale DESC";

    $queryResult = mysqli_query($conn, $sql);

    $result = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

    mysqli_free_result($queryResult);

    return $result;
}

function f_getStaffRentOrder($conn, $staffID){
    $sql = "SELECT * FROM rentorder WHERE operatorID = $staffID AND status = 'off'";

    $queryResult = mysqli_query($conn, $sql);

    $result = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

    mysqli_free_result($queryResult);

    return $result;
}

function f_getStaffCustomOrder($conn, $staffID){
    $sql = "SELECT * FROM customorder WHERE operatorID = $staffID AND status = 'off'";

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

function printStaff($staff, $conn){
    echo "<div style=\"margin-top: 45px;\"> </div>";

    foreach ($staff as $currentStaff) {
        if($currentStaff['account'] != "master"){
            echo "<div style='margin-top: 10px; background: #f5f5f5; opacity: 0.75; padding: 8px;'>";
            printCurrentStaff($currentStaff, $conn);
            echo "</div>";
        }
    }

}

function printCurrentStaff($currentStaff, $conn){
    echo "<h4><strong>姓名</strong> ：<strong>" . $currentStaff['name'] . "</strong> </h4>";
    echo "<p><strong>账号</strong> ：" . $currentStaff['account'] . " </p>";
    echo "<p><strong>密码</strong> ：" . $currentStaff['password'] . " </p>";
    echo "<p><strong>销售额</strong> ：￥" . $currentStaff['sale'] . " </p>";
    echo "<p><strong>租赁订单数</strong> ：" . getRentOrderNum($currentStaff['operatorID'], $conn);
    echo "<p><strong>定制订单数</strong> ：" . getCustomOrderNum($currentStaff['operatorID'], $conn);
}

function getRentOrderNum($staffID, $conn){

    $rentOrder = f_getStaffRentOrder($conn, $staffID);

    return count($rentOrder);
}

function getCustomOrderNum($staffID, $conn){
    $customOrder = f_getStaffCustomOrder($conn, $staffID);

    return count($customOrder);
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
                            <li class="active"><a href="staffRank.php">个人业绩</a></li>
                            <li><a href="saleSearch.php">销售额</a></li>
                            <li><a href="clientRange.php">客户来源</a></li>
                            <li><a href="../home.php">库存与订单</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <?php
                printStaff(f_getStaffTable($conn), $conn);
            ?>

        </div>
    </div>
</div>




</body>
</html>
