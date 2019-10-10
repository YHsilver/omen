
function delete_cart( id){var request = new XMLHttpRequest();
    request.open("post", "cartHandle.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function () {
        if ((this.status >= 200 && this.status <= 300 || this.status == 304) && this.readyState == 4) {
            if (this.responseText === "success") {
                alert("删除成功")
            }
            if (this.responseText === "failed") {
                alert("该物品不在租赁列表，请刷新后再试");
            }
            if (this.responseText === "false") {
                alert("操作失败，请刷新后再试");
            }
            window.location.reload();
        }
    };
    var para = "delete="+id;
    request.send(para);
    request=null;
}


$(".rentBtn").click(function () {
    //alert('message called');
    var request = new XMLHttpRequest();
    var id=this.getAttribute('id');
    request.open("post", "cartHandle.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function () {
        if ((this.status >= 200 && this.status <= 300 || this.status == 304) && this.readyState == 4) {
            //alert(this.responseText);
            if (this.responseText === "success") {
                alert("添加成功，请到待租赁列表查看")
            }
            if (this.responseText === "failed") {
                alert("该物品已在租赁列表，请勿重复添加");
            }
            if (this.responseText === "false") {
                alert("操作失败，请刷新后再试 ");
            }
        }
    };
    var para = "add="+id;
    request.send(para);
    request=null;
});



function rentAll() {
    $("#myModal")[0].style.display="block";

}

function cancelRent() {
    $("#myModal")[0].style.display="none";
}

var rent_input = {
    client: document.getElementById("client"),
    weChat: document.getElementById("weChat"),
    price: document.getElementById("price"),
    date: document.getElementById("date"),
};


$("#rentForm").on("submit", function(ev) {

    alert("需让客户填写问卷并且发送相关文案至朋友圈返现 5 元");
    var request = new XMLHttpRequest();
    request.open("post", "rentHandle.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function () {
        if ((this.status >= 200 && this.status <= 300 || this.status == 304) && this.readyState == 4) {
            alert(this.responseText);
            if (this.responseText === "successWithOldClient") {
                alert("租赁成功")
            }
            if (this.responseText === "successWithNewClient") {
                var text = prompt("这是一位新顾客，请询问并填写顾客来源");
                insertNewClient(rent_input.client.value, rent_input.weChat.value, text);

            }
            if (this.responseText === "failed") {
                alert("操作失败，请检查列表中是否有待租赁物品");
            }
            if (this.responseText === "false") {
                alert("操作失败，请刷新后再试 ");
            }
            window.location.reload();

        }

    };
    var para = "client="+rent_input.client.value+"&weChat="+rent_input.weChat.value+"&price="+rent_input.price.value+
        "&date="+rent_input.date.value;
    request.send(para);
    //阻止submit表单提交
    ev.preventDefault();
});

function insertNewClient(name, weChat, source){
    var request = new XMLHttpRequest();
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

