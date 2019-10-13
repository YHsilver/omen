<?php

include "../template/buildConn.php";
@$conn = getConn();
//mysqli_set_charset($conn, 'utf8');

function f_getClientTable($conn){
    $sql = "SELECT * FROM clients";

    $queryResult = mysqli_query($conn, $sql);

    $result = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

    mysqli_free_result($queryResult);

    return $result;
}

function f_getSourceTable($conn){
    $sql = "SELECT source,COUNT(*) FROM clients GROUP BY source";

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
                            <li class="active"><a href="clientRange.php">客户来源</a></li>
                            <li><a href="../home.php">库存与订单</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <?php

                $sum = count(f_getClientTable($conn));
               // echo "<h4 style=\"margin-top: 45px;\"> </h4>";
                $sourceTable = f_getSourceTable($conn);
//            $row = mysqli_fetch_all($sourceTable);
//
//            $clientTable = f_getClientTable($conn);
//            $i = 0;
//            foreach ($clientTable as $currentClient){
//
//            }
                echo "        <div class=\"panel panel-default\">
            <div class=\"panel-heading \">
                <p class=\"panel-title \">客户总数 ：" . $sum . " </p>
            </div>";
                echo "<table class=\"table table-hover panel-body table-responsive\"><thead><tr><td>客户来源</td><td>人数</td><td>比例</td></tr></thead>";
                foreach ($sourceTable as $currentSource){
                    //$rate = ($value / $sum) * 100;
//                    echo "<div style='background: #f5f5f5; margin: 5px; opacity: 0.75; padding: 5px;'>";
                    echo "<tr><td>" . $currentSource['source'] . "</td><td> " . $currentSource['COUNT(*)'] . "</td> <td> " .sprintf("%01.2f", ($currentSource['COUNT(*)'] / $sum)*100).'%' . "</td></tr>";

                }
                echo "</table></div>";
            ?>

        </div>
    </div>
</div>
