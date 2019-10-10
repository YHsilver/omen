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

function f_getRentOrderTable($conn, $year, $month){
    if($month <= 9){
        $monthString = "0" . $month;
    }else{
        $monthString = "" . $month;
    }
    $searchString = $year . $monthString;
    $sql = "SELECT * FROM rentorder WHERE orderID LIKE 'RE".$searchString."%' AND status = 'off'";

    $queryResult = mysqli_query($conn, $sql);
    //echo "<script>alert(".$queryResult.")</script>";
    $result = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

    mysqli_free_result($queryResult);

    return $result;
}

function f_getCustomOrderTable($conn, $year, $month){
    if($month <= 9){
        $monthString = "0" . $month;
    }else{
        $monthString = "" . $month;
    }
    $searchString = $year . $monthString;
    $sql = "SELECT * FROM customorder WHERE orderID LIKE 'CU".$searchString."%' AND status = 'off'";

    $queryResult = mysqli_query($conn, $sql);

    $result = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

    mysqli_free_result($queryResult);

    return $result;
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
                            <li class="active"><a href="saleSearch.php">销售额</a></li>
                            <li><a href="clientRange.php">客户来源</a></li>
                            <li><a href="../home.php">库存与订单</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">销售额查询</a>
                    </div>
                    <form class="navbar-form navbar-left" role="search" action="saleSearch.php" method="post" autocomplete="off">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="年份" name="searchText" id="searchText">
                        </div>
                        <button type="submit" class="btn btn-default">查询</button>
                    </form>
                </div>
            </nav>
            <?php
                if(isset($_POST['searchText'])){
                    $yearSaleSum = 0;

                    $year = intval($_POST['searchText']);

                    echo "<table class=\"table table-striped\"><caption>" . $year . "年销售情况</caption><thead><tr><th>月份</th>
                        <th>租赁订单数</th><th>租赁订单额</th><th>定制订单数</th><th>定制订单额</th><th>月总订单额</th></tr></thead><tbody>";

                    for($i = 1; $i <= 12; $i++){
                        $rentOrder = f_getRentOrderTable($conn, $year, $i);
                        $customOrder = f_getCustomOrderTable($conn, $year, $i);

                        echo "<tr>";
                        //月份
                        echo "<td>" . $i . "</td>";
                        //租赁订单数
                        echo "<td>" . count($rentOrder) . "</td>";
                        //租赁订单额
                        $rentSaleSumInMonth = 0;
                        foreach ($rentOrder as $currentRentOrder) {
                            $rentSaleSumInMonth += $currentRentOrder['price'];
                        }
                        echo "<td>" . $rentSaleSumInMonth . "</td>";
                        //定制订单数
                        echo "<td>" . count($customOrder) . "</td>";
                        //定制订单额
                        $customSaleSumInMonth = 0;
                        foreach ($customOrder as $currentCustomOrder) {
                            $customSaleSumInMonth += $currentCustomOrder['price'];
                        }
                        echo "<td>" . $customSaleSumInMonth . "</td>";
                        //月总订单额
                        $totalInMonth = $rentSaleSumInMonth + $customSaleSumInMonth;
                        echo "<td>" . $totalInMonth . "</td>";
                        $yearSaleSum += $totalInMonth;
                        echo "</tr>";
                    }
                    echo "</tbody></table>";

                    echo "<h4>年总销售额 ：￥" . $yearSaleSum;
                }
            ?>

        </div>
    </div>
</div>
