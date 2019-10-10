<?php

include "template/nav.php";

?>

<script>
    document.getElementById("orderLi").className = "active";
</script>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">订单查询</a>
            </div>
            <form class="navbar-form navbar-left" role="search" action="order.php" method="post" autocomplete="off">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="订单号" name="orderText" id="orderText">
                </div>
                <div class="form-group" style="margin-left: 20px; margin-right: 20px">
                    <label class="radio-inline">
                        <input type="radio" name="optionsRadiosInline" id="optionsRadios3" value="all" checked> 全部
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="optionsRadiosInline" id="optionsRadios4"  value="on"> 未完成
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="optionsRadiosInline" id="optionsRadios4"  value="off"> 已完成
                    </label>
                </div>
                <button type="submit" class="btn btn-default">查询</button>
            </form>
            <form class="navbar-form navbar-right" action="newOrder.php" method="post">
                <button type="submit" class="btn btn-default">定制下单</button>
            </form>
        </div>
    </nav>

<?php

if(isset($_POST['orderText'])){
    $orderText = $_POST['orderText'];
    if(strlen($orderText) >= 2){
        $mode = substr($orderText, 0,2);
        if($mode == "RE" || $mode == "CU"){
            $timeCommand = "" . substr($orderText, 2, strlen($orderText) - 2);
            showResult($mode, $timeCommand, $_POST['optionsRadiosInline'], getConn());
        }
    }
}

function showResult($mode, $timeCommand, $status, $conn){
    if($status == "all"){
        showResult($mode, $timeCommand, "on", $conn);
        showResult($mode, $timeCommand, "off", $conn);
    }else{
        $length = strlen($timeCommand);
        if(($timeCommand == "") || ($length >= 4 && $length <= 10 && $length % 2 == 0 && is_numeric($timeCommand))){
            $orderText = $mode . $timeCommand;
            if($mode == "RE"){
                $modeText = "rentorder";
            }else{
                $modeText = "customorder";
            }
            $sql_orderSearch = "SELECT * FROM " . $modeText . " WHERE status = '" . $status . "' AND orderID LIKE '" . $orderText . "%'  ORDER BY orderTime DESC";
            $orderArray = mysqli_query($conn, $sql_orderSearch);
            if($mode == "RE"){
                //echo "<script>alert('RE called!');</script>";
                if($status == "on"){
                    //echo "<script>alert('RE on called!');</script>";
                    showRentOrders_statusOn($orderArray);
                }else{
                    //echo "<script>alert('RE off called!');</script>";
                    showRentOrders_statusOff($orderArray);
                }
            }else{
                if($status == "on"){
                    showCustomOrders_statusOn($orderArray);
                }else{
                    showCustomOrders_statusOff($orderArray);
                }
            }
        }
    }
}

function showRentOrders_statusOn($rentOrderArray){
    foreach ($rentOrderArray as $currentOrder){
        echo "<div style='background: #f5f5f5; opacity: 0.75; border-radius: 5px; margin-top: 10px; padding: 4px;'>";
        echo "<p>";
        echo "<span> <strong> 订单号： </strong> " . $currentOrder['orderID'] . "</span><br>";
        echo "<span> <strong> 衣服型号： </strong> " . $currentOrder['suitModel'] . "</span><br>";
        echo "<span> <strong> 销售： </strong> " . $currentOrder['operatorName'] . "&nbsp&nbsp&nbsp&nbsp<strong> 金额：￥</strong> "
            . $currentOrder['price'] . "&nbsp&nbsp&nbsp&nbsp<strong> 订单状态： </strong> 未完成 </span><br>";
        echo "<span> <strong> 客户： </strong> " . $currentOrder['client'] . "&nbsp&nbsp&nbsp&nbsp<strong> 微信： </strong> " . $currentOrder['weChat']
            . "</span><br>";
        echo "<span> <strong> 租赁时间： </strong> " . $currentOrder['orderTime'] . "</span><br>";
        echo "<span> <strong> 归还时间： </strong> " . $currentOrder['returnTime'] . "</span><br>";
        echo "</p>";
        echo "
        <button type=\"button\" class=\"btn btn-default\" onclick=\"finishRentOrder(' " . $currentOrder['rentID'] . "')\">完成租赁订单</button>
        <button type=\"button\" class=\"btn btn-default\" onclick=\"deleteRentOrder(' " . $currentOrder['rentID'] . "')\">删除租赁订单</button>
        ";
        echo "</div>";
    }
}

function showRentOrders_statusOff($rentOrderArray){
    foreach ($rentOrderArray as $currentOrder){
        echo "<div style='background: #f5f5f5; opacity: 0.75; border-radius: 5px; margin-top: 10px; padding: 4px;'>";
            echo "<p>";
                echo "<span> <strong> 订单号： </strong> " . $currentOrder['orderID'] . "</span><br>";
                echo "<span> <strong> 衣服型号： </strong> " . $currentOrder['suitModel'] . "</span><br>";
                echo "<span> <strong> 销售： </strong> " . $currentOrder['operatorName'] . "&nbsp&nbsp&nbsp&nbsp<strong> 金额：￥</strong> "
                    . $currentOrder['price'] . "&nbsp&nbsp&nbsp&nbsp<strong> 订单状态： </strong> 已完成 </span><br>";
                echo "<span> <strong> 客户： </strong> " . $currentOrder['client'] . "&nbsp&nbsp&nbsp&nbsp<strong> 微信： </strong> " . $currentOrder['weChat']
                    . "</span><br>";
                echo "<span> <strong> 租赁时间： </strong> " . $currentOrder['orderTime'] . "</span><br>";
                echo "<span> <strong> 归还时间： </strong> " . $currentOrder['returnTime'] . "</span><br>";
            echo "</p>";
        echo "</div>";
    }
}

function showCustomOrders_statusOn($customOrderArray){
    foreach ($customOrderArray as $currentOrder){
        echo "<div style='background: #f5f5f5; opacity: 0.75; border-radius: 5px; margin-top: 10px; padding: 4px;'>";
        echo "<p>";
        echo "<span> <strong> 订单号： </strong> " . $currentOrder['orderID'] . "</span><br>";
        echo "<span> <strong> 销售： </strong> " . $currentOrder['operatorName'] . "&nbsp&nbsp&nbsp&nbsp<strong> 金额：￥</strong> "
            . $currentOrder['price'] . "&nbsp&nbsp&nbsp&nbsp<strong> 订单状态： </strong> 未完成 </span><br>";
        echo "<span> <strong> 客户： </strong> " . $currentOrder['client'] . "&nbsp&nbsp&nbsp&nbsp<strong> 微信： </strong> " . $currentOrder['weChat']
            . "</span><br>";
        echo "<span> <strong> 备注： </strong> " . $currentOrder['note'] . "</span><br>";
        echo "<span> <strong> 下单时间： </strong> " . $currentOrder['orderTime'] . "</span><br>";
        echo "<span> <strong> 取衣时间： </strong> " . $currentOrder['fetchTime'] . "</span><br>";
        echo "</p>";
        echo "
        <button type=\"button\" class=\"btn btn-default\" onclick=\"finishCustomOrder(' " . $currentOrder['customID'] . "')\">完成定制订单</button>
        <button type=\"button\" class=\"btn btn-default\" onclick=\"deleteCustomOrder(' " . $currentOrder['customID'] . "')\">删除定制订单</button>
        ";
        echo "</div>";
    }
}

function showCustomOrders_statusOff($customOrderArray){
    foreach ($customOrderArray as $currentOrder){
        echo "<div style='background: #f5f5f5; opacity: 0.75; border-radius: 5px; margin-top: 10px; padding: 4px;'>";
        echo "<p>";
        echo "<span> <strong> 订单号： </strong> " . $currentOrder['orderID'] . "</span><br>";
        echo "<span> <strong> 销售： </strong> " . $currentOrder['operatorName'] . "&nbsp&nbsp&nbsp&nbsp<strong> 金额：￥</strong> "
            . $currentOrder['price'] . "&nbsp&nbsp&nbsp&nbsp<strong> 订单状态： </strong> 已完成 </span><br>";
        echo "<span> <strong> 客户： </strong> " . $currentOrder['client'] . "&nbsp&nbsp&nbsp&nbsp<strong> 微信： </strong> " . $currentOrder['weChat']
            . "</span><br>";
        echo "<span> <strong> 备注： </strong> " . $currentOrder['note'] . "</span><br>";
        echo "<span> <strong> 下单时间： </strong> " . $currentOrder['orderTime'] . "</span><br>";
        echo "<span> <strong> 取衣时间： </strong> " . $currentOrder['fetchTime'] . "</span><br>";
        echo "</p>";
        echo "</div>";
    }
}

?>
    <script src="../js/order.js"></script>
<?php

include "template/foot.php";

?>