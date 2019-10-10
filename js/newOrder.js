
var ele_newOrder = {
    client: document.getElementById("client"),
    weChat: document.getElementById("weChat"),
    note: document.getElementById("note"),
    price: document.getElementById("price")
};

var boo = false;

ele_newOrder.client.onblur = function () {
    checkClient();
};
ele_newOrder.weChat.onblur = function () {
    checkWeChat()
};
ele_newOrder.price.onblur = function () {
    checkPrice();
};

function checkClient() {
    if (ele_newOrder.client.value == "") {
        document.getElementById("client_reminder").innerHTML = "请输入客户名 !";
    }else {
        document.getElementById("client_reminder").innerHTML = "&nbsp;";
        return true;
    }
}

// function clientRepeat() {
//     //alert("NameRepeat method called");
//     request.open("post", "logAndnewOrderServer.php", true);
//     request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     request.onreadystatechange = function () {
//         if ((this.status >= 200 && this.status <= 300 || this.status == 304) && this.readyState == 4) {
//             //alert(this.responseText);
//             if(this.responseText == 'repeat'){
//                 boo = true;
//             }
//             return true;
//         }
//     };
//     var para = "user_newOrder_repeatCheck=" + ele_newOrder.client.value;
//     request.send(para);
// }

function checkWeChat() {
    if (ele_newOrder.weChat.value == "") {
        document.getElementById("weChat_reminder").innerHTML = "请输入微信号 !";
    } else {
        document.getElementById("weChat_reminder").innerHTML = "&nbsp;";
        return true;
    }
}

function checkPrice() {
    if (ele_newOrder.price.value == "") {
        document.getElementById("price_reminder").innerHTML = "请输入总价 !";
    } else if (!checkNum(ele_newOrder.price.value)){
        document.getElementById("price_reminder").innerHTML = "格式存在错误 !";
    } else {
        document.getElementById("price_reminder").innerHTML = "&nbsp;";
        return true;
    }
}

function checkNum(target){
    var re = /^\d+(\.\d+)?$/　　//非负浮点数（正浮点数 + 0）
    return re.test(target)
}

var request = new XMLHttpRequest();

function check_newOrder() {
    var clientOk = false;
    var weChatOk = false;
    var priceOk = false;

    if (checkClient()) {
        clientOk = true;

    }
    if (checkWeChat()) {
        weChatOk = true;
    }

    if (checkPrice()){
        priceOk = true;
    }

    var correct;
    if (clientOk && weChatOk && priceOk) {
        request.open("post", "newOrderServer.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.onreadystatechange = function () {
            if ((this.status >= 200 && this.status <= 300 || this.status == 304) && this.readyState == 4) {
                correct = this.responseText;
                if (correct == 'customOrderSuccessWithNewClient') {

                    alert("下单成功, 需填写凭收单发送至客户邮箱!");

                    //询问用户来源
                    var text = prompt("这是一位新顾客，请询问并填写顾客来源");
                    insertNewClient(ele_newOrder.client.value, ele_newOrder.weChat.value, text);
                    window.location.href="order.php";
                    return true;
                }else if(correct == 'customOrderSuccessWithOldClient'){
                    window.location.href="order.php";
                    alert("下单成功, 需填写凭收单发送至客户邮箱!");
                    return true;
                } else {
                    alert("下单失败");
                    return false
                }

            }
        };
        var para = "client=" + ele_newOrder.client.value + "&weChat=" + ele_newOrder.weChat.value + "&note=" + ele_newOrder.note.value + "&price=" + ele_newOrder.price.value;
        request.send(para);


    } else {
        checkClient();
        checkPrice();
        checkWeChat();
        return false;
    }
}

function insertNewClient(name, weChat, source){
    request.open("post", "newOrderServer.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function () {
        if ((this.status >= 200 && this.status <= 300 || this.status == 304) && this.readyState == 4) {
            correct = this.responseText;
            if (correct == 'insertSuccess') {
                alert("新用户添加成功");
            } else {
                alert("新用户添加失败");
            }

        }
    };
    var para = "clientName=" + name + "&clientWeChat=" + weChat + "&clientSource=" + source;
    request.send(para);
}