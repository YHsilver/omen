function finishRentOrder (rentID) {
    alert("rentOrder Finish");
    var request = new XMLHttpRequest();
    //rentID = parseInt(rentID);
    if(confirm("确定 完成 该订单？")){
        request.open("post", "orderServer.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.onreadystatechange = function () {
            if ((this.status >= 200 && this.status <= 300 || this.status == 304) && this.readyState == 4) {
                var correct = this.responseText;
                //alert(correct);
                if (correct == 'finishSuccess') {

                    alert("操作成功");
                    window.location.href="order.php";
                    return true;
                } else {
                    alert(this.responseText + "respon");
                    alert("操作失败");
                    return false
                }

            }
        };
        var para = "rentID=" + rentID + "&op=finish";
        request.send(para);
    }
}

function deleteRentOrder (rentID) {
    var request = new XMLHttpRequest();
    //rentID = parseInt(rentID);
    if(confirm("确定 删除 该订单？")){
        request.open("post", "orderServer.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.onreadystatechange = function () {
            if ((this.status >= 200 && this.status <= 300 || this.status == 304) && this.readyState == 4) {
                correct = this.responseText;
                if (correct == 'deleteSuccess') {
                    window.location.href="order.php";
                    alert("操作成功");
                    return true;
                } else {
                    alert("操作失败");
                    return false
                }

            }
        };
        var para = "rentID=" + rentID + "&op=delete";
        request.send(para);
    }
}

function finishCustomOrder (customID) {
    var request = new XMLHttpRequest();
    //alert(customID);
    //customID = parseInt(customID);
    if(confirm("确定 完成 该订单？")){
        request.open("post", "orderServer.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.onreadystatechange = function () {
            if ((this.status >= 200 && this.status <= 300 || this.status == 304) && this.readyState == 4) {
                correct = this.responseText;
                if (correct == 'finishSuccess') {
                    window.location.href="order.php";
                    alert("操作成功");
                    return true;
                } else {
                    alert("操作失败");
                    return false
                }

            }
        };
        var para = "customID=" + customID + "&op=finish";
        request.send(para);
    }
}

function deleteCustomOrder (customID) {
    var request = new XMLHttpRequest();
    if(confirm("确定 删除 该订单？")){
        request.open("post", "orderServer.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.onreadystatechange = function () {
            if ((this.status >= 200 && this.status <= 300 || this.status == 304) && this.readyState == 4) {
                correct = this.responseText;
                if (correct == 'deleteSuccess') {
                    window.location.href="order.php";
                    alert("操作成功");
                    return true;
                } else {
                    alert("操作失败");
                    return false
                }

            }
        };
        var para = "customID=" + customID + "&op=delete";
        request.send(para);
    }
}