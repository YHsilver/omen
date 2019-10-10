<?php

include "template/nav.php";

?>
<script>
    document.getElementById("suitAddLi").className = "active";
</script>
<form action="suitAddingServer.php" method="post" id="suitAddingForm" autocomplete="off" class="form-horizontal center-block " enctype="multipart/form-data">

<div class="form-group" >
    <label for="" class="col-sm-2 control-label"> </label>
    <div class="col-sm-6">
    <label class="radio-inline">
        <input type="radio" name="suitType" id="suit_on"  value="suit_on"> 上衣
    </label>
    <label class="radio-inline">
        <input type="radio" name="suitType" id="suit_off"  value="suit_off"> 下装
    </label>
    </div>
</div>

<div class="form-group">

    <label class="col-sm-2 control-label" for="model">型号:</label>
    <div class="col-sm-6">
        <input type="text" name="model" id="model" autocomplete="off" class="form-control ">
    </div>

    <p class="reminder_error_model col-sm-4" id="model_reminder">&nbsp;</p >
</div>

<div class="form-group ">
    <label class="col-sm-2 control-label" for="note">上传图片文件:<br>格式jpg/png/jpeg<br>大小不超过10M</label>
    <div class="col-sm-6">
        <input type="file" accept="image/jpeg, image/jpg, image/png" name="imageFile" id="imageFile">
    </div>
    <p class="reminder_error_file col-sm-4" id="file_reminder"></p >
</div>


<div class="form-group ">
    <div class="col-sm-offset-4 col-sm-4">
        <button type="submit" class="btn btn-default">添加</button>
    </div>
</div>
</form>

<?php

include "template/foot.php";

?>
