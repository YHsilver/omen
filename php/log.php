<?php
include "template/buildConn.php";
@$conn = getConn();
mysqli_set_charset($conn, 'utf8');

session_start();
if(isset($_SESSION['account'])){
    unset($_SESSION['account']);
}
if(isset($_SESSION['username'])){
    unset($_SESSION['username']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>logIn</title>
    <link rel="stylesheet" href="../css/reset.css">
    <!-- Bootstrap core CSS -->
    <link href="../bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/log.css">

</head>
<body style="overflow: hidden">
<div class="container">
    <div class="row" style="margin-top: 50px; margin-bottom: 20px;">
        <div class="col-sm-4">

        </div>
        <div class="col-sm-4">
            <img src="../images/omenLogo.png" alt="" class="img-responsive">
        </div>
        <div class="col-sm-4">

        </div>
    </div>
    <div class="row">
        <form action="logAndRegisterServer.php" method="post" id="logForm" autocomplete="off" class="form-horizontal center-block ">

            <div class="logForm form-group">

                <label class="col-sm-4 control-label" for="user_log">账号:</label>
                <div class="col-sm-4">
                    <input type="text" name="user_log" id="user_log" autocomplete="off" class="form-control ">
                </div>

                <p class="reminder_error_log col-sm-4" id="user_reminder_log">&nbsp;</p >
            </div>

            <div class="logForm form-group ">
                <label class="col-sm-4 control-label" for="password_log">密码:</label>
                <div class="col-sm-4">
                    <input type="password" name="pass_log" id="password_log" autocomplete="off" class="form-control">
                </div>
                <p class="reminder_error_log col-sm-4" id="password_reminder_log">&nbsp;</p >
            </div>
            <div class="form-group ">
                <div class="col-sm-offset-4 col-sm-4">
                    <button type="button"  onclick="check_log()" id="logSubmit" class="btn btn-default">登陆</button>
                    <span  class=""></span><a href="register.php">点击注册</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="../js/log.js"></script>
<!-- Bootstrap core JavaScript-->
<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="../js/jquery-3.3.1.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="../bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>