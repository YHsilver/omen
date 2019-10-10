<?php

include "template/nav.php";

?>

<div style="margin-bottom: 30px;">
    <h3><strong>定制下单</strong></h3>
</div>

<form action="logAndRegisterServer.php" method="post" id="registerForm" autocomplete="off" class="form-horizontal center-block ">

    <div class="registerForm form-group">

        <label class="col-sm-2 control-label" for="client">客户名:</label>
        <div class="col-sm-6">
            <input type="text" name="client" id="client" autocomplete="off" class="form-control ">
        </div>

        <p class="reminder_error_register col-sm-4" id="client_reminder">&nbsp;</p >
    </div>

    <div class="registerForm form-group">

        <label class="col-sm-2 control-label" for="weChat">微信号:</label>
        <div class="col-sm-6">
            <input type="text" name="weChat" id="weChat" autocomplete="off" class="form-control ">
        </div>

        <p class="reminder_error_register col-sm-4" id="weChat_reminder">&nbsp;</p >
    </div>

    <div class="registerForm form-group ">
        <label class="col-sm-2 control-label" for="price">总价:</label>
        <div class="col-sm-6">
            <input type="text" name="price" id="price" autocomplete="off" class="form-control">
        </div>
        <p class="reminder_error_register col-sm-4" id="price_reminder">&nbsp;</p >
    </div>

    <div class="registerForm form-group ">
        <label class="col-sm-2 control-label" for="note">备注:</label>
        <div class="col-sm-6">
            <textarea name="note" id="note" class="form-control" rows="4"></textarea>
        </div>
        <p class="reminder_error_register col-sm-4" id="note_reminder">&nbsp;</p >
    </div>


    <div class="form-group ">
        <div class="col-sm-offset-4 col-sm-4">
            <button type="button"  onclick="check_newOrder()" id="registerSubmit" class="btn btn-default">下单</button>
        </div>
    </div>
</form>

<script src="../js/newOrder.js"></script>

<?php

include "template/foot.php";

?>
