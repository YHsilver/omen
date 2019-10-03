<?php

require_once 'config.php';
try {
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if (isset($_POST['username'])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM operator WHERE account='{$username}' AND password='{$password}'";
        $result = $pdo->query($sql);
        if ($result->fetch()) {
            if ($username == "master")
                echo "master";
            else {
                echo 'operator';
            }

        } else echo 'false';
    }
    $pdo = null;
} catch (PDOException $exception) {
    die($exception->getMessage());
}


session_start();
$_SESSION['user'] = $username;

