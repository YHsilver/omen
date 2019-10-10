<?php

session_start();
include "template/buildConn.php";

//echo "userNotFound";

function f_getOperatorTable($conn, $account){
    $sql = "SELECT * FROM operator WHERE account = '" . $account . "'";

    $queryResult = mysqli_query($conn, $sql);

    $result = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

    mysqli_free_result($queryResult);

    return $result;
}

//注册
if(isset($_POST['user_register_repeatCheck'])){
    $account = $_POST['user_register_repeatCheck'];
    //echo $account;
    $operator = f_getOperatorTable(getConn(), $account);
    if($operator != null){
        echo "repeat";
    }else{
        echo "";
    }

}

if(isset($_POST['user_register']) && isset($_POST['pass_register']) && isset($_POST['user_register_name'])){

    $conn = getConn();

    $account = $_POST['user_register'];
    $password = $_POST['pass_register'];
    $name = $_POST['user_register_name'];

    $operator = f_getOperatorTable(getConn(), $account);
    if($operator == null){
        $sql = "INSERT INTO operator (account, name, password) VALUES ('" . $account . "', '" . $name . "','" . $password . "')";
        mysqli_query($conn, $sql);
        $operator = f_getOperatorTable($conn, $account);
        if($operator != null){
            $_SESSION['account'] = $account;
            $_SESSION['username'] = $name;
            echo "registerSuccess";
        }else{
            echo "sql Not Found";
        }
    }

}


//登录
if(isset($_POST['user_log'])){

    $username = $_POST['user_log'];
    $password = $_POST['pass_log'];

    $operator = f_getOperatorTable(getConn(), $username);
    if($operator != null){
        $operator = $operator[0];
        if($password == $operator['password']){
            if($username == 'master'){
                $_SESSION['account'] = 'master';
                echo "master";
            }else{
                $_SESSION['account'] = $username;
                echo "operator";
            }
        }else {
            echo "passwordWrong";
        }
    }else{
        echo "userNotFound";
    }
}