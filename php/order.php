<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>logIn</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link href="../bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body style="overflow: hidden">

<?php
require_once 'config.php';
$pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>


<div class="panel panel-default col-md-8 col-md-offset-2 row "
     style="margin-top: 20px;margin-bottom: 20px;max-height: 300px ;overflow-y: scroll ">

    <div class="panel-heading row">
        <p class="panel-title  col-md-4">已租赁订单： </p>
        <div class="col-md-3 col-md-offset-9 input-group">
            <input type="text" name="search" placeholder="Search..." id="renting_search" class="form-control"  onchange="set()">
            <a href="order.php" class="input-group-addon" id="renting_search_link"> <span class="glyphicon glyphicon-search " ></span></a>
        </div>
    </div>
    <table class="table table-hover panel-body table-responsive">
        <thead>
        <tr>
            <td>订单号</td>
            <td>衣服型号</td>
            <td>客户名</td>
            <td>客户微信</td>
            <td>租赁时间</td>
            <td>租赁费用</td>
            <td>操作员</td>
            <td>操作</td>
        </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM rentorder  WHERE status='on' order by orderID desc ";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['orderID'] . "</td>";
            echo "<td>";
            $model = explode(',', $row['suitModel']);
            for ($index = 0; $index < count($model); $index++) {
                echo $model[$index] . " ";
            }
            echo "</td>";
            echo "<td>" . $row['client'] . "</td>";
            echo "<td>" . $row['weChat'] . "</td>";
            echo "<td>" . $row['rentTime'] ."---".$row['returnTime']. "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['operatorName'] . "</td>";
            echo "<td><button type='button'  onclick='rentCancel()' class='btn btn-default' id='rentCancel'>取消</button></td>";
            echo "  </tr>";
        }
        ?>
    </table>
</div>



<div class="panel panel-default col-md-8 col-md-offset-2 row "
     style="margin-top: 20px;margin-bottom: 20px;max-height: 300px ;overflow-y: scroll ">
    <div class="panel-heading row">
        <p class="panel-title  col-md-4">定制下单订单： </p>
        <div class="col-md-3 col-md-offset-9 input-group">
            <input type="text" name="search" placeholder="Search..." id="customing_search" class="form-control"  onchange="set()">
            <a href="order.php" class="input-group-addon" id="customing_search_link"> <span class="glyphicon glyphicon-search "></span></a>
        </div>
    </div>
    <table class="table table-hover panel-body table-responsive">
        <thead>
        <tr>
            <td>订单号</td>
            <td>客户名</td>
            <td>客户微信</td>
            <td>定制时间</td>
            <td>定制费用</td>
            <td>备注</td>
            <td>操作员</td>
            <td>操作</td>
        </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM customorder WHERE status='on' order by orderID desc ";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['orderID'] . "</td>";
            echo "<td>" . $row['client'] . "</td>";
            echo "<td>" . $row['weChat'] . "</td>";
            echo "<td>" . $row['customTime'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['note'] . "</td>";
            echo "<td>" . $row['operatorName'] . "</td>";
            echo "<td>
                  <button type='button'  onclick='customCancel()' class='btn btn-default' id='rentCancel'>取消</button>
                  <button type='button'  onclick='customComplete()' class='btn btn-default' id='rentCancel'>完成</button>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>


<div class="panel panel-default col-md-8 col-md-offset-2 row "
     style="margin-top: 20px;margin-bottom: 20px;max-height: 300px ;overflow-y: scroll ">
    <div class="panel-heading row">
        <p class="panel-title  col-md-4">租赁完成订单： </p>
        <div class="col-md-3 col-md-offset-9 input-group">
            <input type="text" name="search" placeholder="Search..." id="rented_search" class="form-control"  onchange="set()">
            <a href="order.php" class="input-group-addon" id="rented_search_link"> <span class="glyphicon glyphicon-search " ></span></a>
        </div>
    </div>
    <table class="table table-hover panel-body table-responsive">
        <thead>
        <tr>
            <td>订单号</td>
            <td>衣服型号</td>
            <td>客户名</td>
            <td>客户微信</td>
            <td>租赁时间</td>

            <td>租赁费用</td>
            <td>操作员</td>
        </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM rentorder WHERE status='off' order by orderID desc ";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['orderID'] . "</td>";
            echo "<td>";
            $model = explode(',', $row['suitModel']);
            for ($index = 0; $index < count($model); $index++) {
                echo $model[$index] . "  ";
            }
            echo "</td>";
            echo "<td>" . $row['client'] . "</td>";
            echo "<td>" . $row['weChat'] . "</td>";
            echo "<td>" . $row['rentTime'] ."---".$row['returnTime']. "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['operatorName'] . "</td>";
            echo "  </tr>";
        }
        ?>
    </table>
</div>


<div class="panel panel-default col-md-8 col-md-offset-2 row "
     style="margin-top: 20px;margin-bottom: 20px;max-height: 300px ;overflow-y: scroll ">
    <div class="panel-heading row">
        <p class="panel-title  col-md-4">定制完成订单： </p>
        <div class="col-md-3 col-md-offset-9 input-group">
            <input type="text" name="search" placeholder="Search..." id="customed_search" class="form-control"  onchange="set()">
            <a href="order.php" class="input-group-addon" id="customed_search_link"> <span class="glyphicon glyphicon-search " ></span></a>
        </div>
    </div>
    <table class="table table-hover panel-body table-responsive">
        <thead>
        <tr>
            <td>订单号</td>
            <td>客户名</td>
            <td>客户微信</td>
            <td>定制时间</td>
            <td>取衣时间</td>
            <td>定制费用</td>
            <td>操作员</td>

        </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM customorder WHERE status='off' order by orderID desc ";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['orderID'] . "</td>";
            echo "<td>" . $row['client'] . "</td>";
            echo "<td>" . $row['weChat'] . "</td>";
            echo "<td>" . $row['customTime'] . "</td>";
            echo "<td>" . $row['fetchTime'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['operatorName'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

</body>