<?php
include "template/buildConn.php";
@$conn = getConn();
mysqli_set_charset($conn, 'utf8');

session_start();
if(isset($_SESSION['user'])){
    unset($_SESSION['user']);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>registerIn</title>
    <link rel="stylesheet" href="../css/reset.css">
    <!-- Bootstrap core CSS -->
    <link href="../bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">


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
        <form action="logAndRegisterServer.php" method="post" id="registerForm" autocomplete="off" class="form-horizontal center-block ">

            <div class="registerForm form-group">

                <label class="col-sm-4 control-label" for="user_register">账号:</label>
                <div class="col-sm-4">
                    <input type="text" name="user_register" id="user_register" autocomplete="off" class="form-control ">
                </div>

                <p class="reminder_error_register col-sm-4" id="user_reminder_register">&nbsp;</p >
            </div>

            <div class="registerForm form-group">

                <label class="col-sm-4 control-label" for="user_register_name">姓名:</label>
                <div class="col-sm-4">
                    <input type="text" name="user_register" id="user_register_name" autocomplete="off" class="form-control ">
                </div>

                <p class="reminder_error_register col-sm-4" id="user_reminder_register_name">&nbsp;</p >
            </div>

            <div class="registerForm form-group ">
                <label class="col-sm-4 control-label" for="password_register">密码:</label>
                <div class="col-sm-4">
                    <input type="password" name="pass_register" id="password_register" autocomplete="off" class="form-control">
                </div>
                <p class="reminder_error_register col-sm-4" id="password_reminder_register">&nbsp;</p >
            </div>

            <div class="registerForm form-group ">
                <label class="col-sm-4 control-label" for="password_register_confirm">确认密码:</label>
                <div class="col-sm-4">
                    <input type="password" name="pass_register_confirm" id="password_register_confirm" autocomplete="off" class="form-control">
                </div>
                <p class="reminder_error_register col-sm-4" id="password_reminder_register_confirm">&nbsp;</p >
            </div>

            <div class="form-group ">
                <div class="col-sm-offset-4 col-sm-4">
                    <button type="button"  onclick="check_register()" id="registerSubmit" class="btn btn-default">注册</button>
                    <span  class=""></span><a href="log.php">返回登录</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="../js/register.js"></script>
<!-- Bootstrap core JavaScript-->
<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="../js/jquery-3.3.1.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="../bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>