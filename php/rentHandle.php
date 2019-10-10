<?php

include "template/buildConn.php";
session_start();
function f_getOperatorTable($conn, $account){
    $sql = "SELECT * FROM operator WHERE account = '" . $account . "'";

    $queryResult = mysqli_query($conn, $sql);

    $result = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

    mysqli_free_result($queryResult);

    return $result;
}

function f_getClientTable($conn, $weChat){
    $sql = "SELECT * FROM clients WHERE weChat = '" . $weChat . "'";

    $queryResult = mysqli_query($conn, $sql);

    $result = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

    mysqli_free_result($queryResult);

    return $result;
}


if (isset($_POST['client'])) {
    require_once "config.php";
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "select * from suit WHERE inCart=1 AND status='on'";
    $result = $pdo->query($sql);

    if ($result->fetch()) {
        $result = $pdo->query($sql);
        $date = str_replace("T", " ", $_POST['date']) . ":00";
        $suitModelList = array();
        while ($row = $result->fetch()) {
            $suitModelList[] = $row['model'];
            $suitID = $row['suitID'];
            $sql = "UPDATE  suit  SET inCart=0,status='off' ,rentTime='$date' WHERE suitID='$suitID'";
            $pdo->query($sql);
        }

        //orderID
        $orderID = "RE";
        $currentTime = date('YmdHis');

        $orderID = $orderID . $currentTime;

        //suitModel
        if (count($suitModelList) > 0) {
            $suitModel = implode(',', $suitModelList);

        } else $suitModel = " ";


        //todo
        $username = $_SESSION['username'];
        $operator = f_getOperatorTable(getConn(), $_SESSION['account'])[0];
        $operatorID = $operator['operatorID'];

        $sql = "INSERT INTO rentOrder (orderID , suitModel,operatorName,price,client,weChat,rentTime,operatorID) VALUES 
          ('$orderID','$suitModel',' $username','{$_POST['price']}','{$_POST['client']}', '{$_POST['weChat']}','$date','$operatorID' )";
        $pdo->query($sql);

        $pdo = null;
        if(f_getClientTable(getConn(), $_POST['weChat']) == null){
            //新顾客

            echo "successWithNewClient";
        }else{
            //老顾客
            echo "successWithOldClient";
        }
    } else echo "failed";
} else echo "false";