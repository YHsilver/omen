<?php
include "template/buildConn.php";
@$conn = getConn();
session_start();
if (isset($_SESSION['account'])) {
    $account = $_SESSION['account'];
} else {
    echo "<script>window.location.href = \"log.php\"</script>";
}

if (isset($_POST['model']) && isset($_POST['suitType']) && $_POST['model'] != '' && isset($_FILES['imageFile'])) {
    if(f_getSuitTableFromModel($conn, $_POST['model']) != null){
        echo "<script>alert('型号重复!');window.location = 'suitAdding.php';</script>";
        exit;
    }
    $model = $_POST['model'];
    $suitType = $_POST['suitType'];
    if ($suitType == 'suit_on') {
        $suitType = '上衣';
    } else {
        $suitType = '下装';
    }
    $imageFileName = $_SESSION['account'] . "UploadedAt" . date("YmdHis");
    $judge = $_FILES['imageFile']['tmp_name'] != '';
    if ($judge) {
        $imageFileName = $imageFileName . '.' . (explode('/', $_FILES['imageFile']['type']))[1];
        //echo "<script>alert(".$imageFileName.")</script>";
    }

    if (isset($_FILES['imageFile'])) {
        //$_FILES['imageFile']['tmp_name'] = $imageFileName;
        $_FILES['imageFile']['name'] = $imageFileName;
        dealingFile();
    } else {
        echo "<script>alert('请添加图片文件!');window.location = 'suitAdding.php';</script>";
        exit;
    }

    $sql = "INSERT INTO suit (type, model, imageFileName, status) 
            VALUES ('$suitType','$model','$imageFileName','on')";
    mysqli_query($conn, $sql);
    echo "<script>alert('添加成功!');window.location = 'suitAdding.php';</script>";

} else {
    echo "<script>alert('衣服类型、型号为空或者图片未添加!');window.location = 'suitAdding.php';</script>";
}

function dealingFile()
{
    if ($_FILES["imageFile"]["error"] > 0) {
        echo "<script>alert('Return Code: " . $_FILES['imageFile']['error'] . "');window.location = 'home.php';</script>";
        exit;
    } else {
        $fileName = $_SERVER['DOCUMENT_ROOT'] . '/omenSystem/suitImg/' . $_FILES['imageFile']['name'];
        move_uploaded_file($_FILES['imageFile']['tmp_name'], $fileName);

    }

}