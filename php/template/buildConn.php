<?php
date_default_timezone_set("Asia/Shanghai");
function getConn(){
    @$conn = mysqli_connect('localhost', 'coolboy',
        'test1234', 'omen');
    return $conn;
}

function f_getRentOrderTableFromRentID($conn, $rentID){
    $sql = "SELECT * FROM rentorder WHERE rentID = '" . $rentID . "'";

    $queryResult = mysqli_query($conn, $sql);

    $result = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

    mysqli_free_result($queryResult);

    return $result;
}

function f_getCustomOrderTableFromCustomID($conn, $customID){
    $sql = "SELECT * FROM customorder WHERE customID = '" . $customID . "'";

    $queryResult = mysqli_query($conn, $sql);

    $result = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

    mysqli_free_result($queryResult);

    return $result;
}

function f_getSuitTableFromModel($conn, $model){
    $sql = "SELECT * FROM suit WHERE model = '" . $model . "'";

    $queryResult = mysqli_query($conn, $sql);

    $result = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

    mysqli_free_result($queryResult);

    return $result;
}