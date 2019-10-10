<?php

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

include "template/buildConn.php";
@$conn = getConn();
session_start();
if(isset($_SESSION['account'])){
    $account = $_SESSION['account'];
}else{
    echo "<script>window.location.href = \"log.php\"</script>";
}


if(isset($_POST['client'])){
    $client = $_POST['client'];
    $weChat = $_POST['weChat'];
    $price = (float)$_POST['price'];
    $note = $_POST['note'];
    $operator = f_getOperatorTable($conn, $account)[0];
    $operatorID = $operator['operatorID'];
    $operatorName = $operator['name'];

    $date = date('Y-m-d H:i:s',time());
    $orderID = "CU" . date('Y') . date('m') . date('d') . date('H') . date('i') . date('s');

    $sql = "INSERT INTO customorder (orderID, operatorID, operatorName, client, weChat, price, note) "
        ."VALUES ('".$orderID."','".$operatorID."','".$operatorName."','".$client."','".$weChat."',".$price.",\"".$note."\");";
    mysqli_query($conn, $sql);

    if(f_getClientTable($conn, $weChat) == null){
        //新顾客

        echo "customOrderSuccessWithNewClient";
    }else{
        //老顾客
        echo "customOrderSuccessWithOldClient";
    }
}

if(isset($_POST['clientSource'])){
    $sql = "INSERT INTO clients (name, weChat, source) "
        ."VALUES ('".$_POST['clientName']."','".$_POST['clientWeChat']."','".$_POST['clientSource']."')";
    mysqli_query(getConn(), $sql);
    echo "insertSuccess";

}