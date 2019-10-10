<?php

include "template/buildConn.php";

session_start();
if(isset($_SESSION['account'])){
    $account = $_SESSION['account'];
}else{
    echo "<script>window.location.href = \"log.php\"</script>";
}


if(isset($_POST['rentID']) && isset($_POST['op'])){
    if($_POST['op'] == "finish"){
        $sql = "UPDATE rentorder SET status = 'off' WHERE rentID = " . intval($_POST['rentID']);
        mysqli_query(getConn(), $sql);

        //更新实际还衣时间
        $date = date('Y-m-d h:i:s',time());
        $sql = "UPDATE rentorder SET returnTime = '" . $date . "' WHERE rentID = " . intval($_POST['rentID']);
        mysqli_query(getConn(), $sql);

        //更新衣服状态
        $suitArray = explode(',', f_getRentOrderTableFromRentID(getConn(), intval($_POST['rentID']))[0]['suitModel']);
        foreach ($suitArray as $currentSuit){
            $sql = "UPDATE suit SET status = 'on' WHERE model = '$currentSuit' ";
            mysqli_query(getConn(), $sql);
        }

        echo "finishSuccess";
    }else if($_POST['op'] == "delete"){
        if($account == "master"){
            $sql = "DELETE FROM rentorder WHERE rentID = " . $_POST['rentID'];
            mysqli_query(getConn(), $sql);
            echo "deleteSuccess";
        }
    }
}

//echo "<script>alert(". $_POST['op'] .")</script>";

if(isset($_POST['customID']) && isset($_POST['op'])){
    if($_POST['op'] == "finish"){
        $sql = "UPDATE customorder SET status = 'off' WHERE customID = " . intval($_POST['customID']);
        mysqli_query(getConn(), $sql);


        //更新实际取衣时间
        $date = date('Y-m-d H:i:s',time());
        $sql = "UPDATE customorder SET fetchTime = '" . $date . "' WHERE customID = " . intval($_POST['customID']);
        mysqli_query(getConn(), $sql);


        echo "finishSuccess";
    }else if($_POST['op'] == "delete"){
        if($account == "master"){
            $sql = "DELETE FROM customorder WHERE customID = " . $_POST['customID'];
            mysqli_query(getConn(), $sql);
            echo "deleteSuccess";
        }
    }
}

