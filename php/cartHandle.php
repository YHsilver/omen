<?php
require_once "config.php";
try {
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //添加到购物车
    if (isset($_POST['add'])) {
        $sql = "SELECT * FROM suit WHERE suitID='{$_POST['add']}' ";
        $result = $pdo->query($sql);
        if ($row = $result->fetch()) {
            if ($row['inCart'] == 0) {
                $sql = "UPDATE  suit  SET inCart='1'  WHERE suitID='{$_POST['add']}'";
                $pdo->query($sql);
                echo "success";
            } else {
                echo 'failed';
            }
        }else echo "false";
        $pdo = null;
    }

    //删除购物车中的物品
    if (isset($_POST['delete'])) {
        $sql = "SELECT * FROM suit WHERE suitID='{$_POST['delete']}' ";
        $result = $pdo->query($sql);
        if ($row = $result->fetch()) {
            if ($row['inCart'] == 1) {
                $sql = "UPDATE  suit  SET inCart=0  WHERE suitID='{$_POST['delete']}'";
                $pdo->query($sql);
                echo "success";
            } else {
                echo 'failed';
            }
        }else echo "false";
        $pdo = null;
    }

    if (isset($_POST['deleteSuit'])) {
        $sql = "DELETE   FROM suit WHERE suitID='{$_POST['deleteSuit']}' ";
        $result = $pdo->query($sql);
        if ($row = $result->fetch()) {
                echo "success";
            } else {
                echo 'failed';
            }
        }else echo "false";
        $pdo = null;


} catch (PDOException $exception) {
    die($exception->getMessage());
}
