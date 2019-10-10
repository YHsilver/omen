//注册对象
var response;
var ele_register = {
    account: document.getElementById("user_register"),
    name: document.getElementById("user_register_name"),
    password: document.getElementById("password_register"),
    passwordConfirm: document.getElementById("password_register_confirm")
};

ele_register.account.onblur = function () {//alert("method called!");
    checkAccount_register();
};
ele_register.password.onblur = function () {
    checkPassword_register()
};
ele_register.passwordConfirm.onblur = function () {
    checkPassword_register_confirm();
};
ele_register.name.onblur = function () {
    checkName_register();
};

function checkAccount_register() {

    //alert("method called!");
    if (ele_register.account.value != "") {
        //alert("NameRepeat method called");

        request.open("post", "logAndRegisterServer.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.onreadystatechange = function () {
            if ((this.status >= 200 && this.status <= 300 || this.status == 304) && this.readyState == 4) {
                //alert(this.responseText);
                response = this.responseText;
                if (this.responseText === 'repeat') {
                    document.getElementById("user_reminder_register").innerHTML = "账号已被注册 !";
                    //alert("account checked method called! repeat!");
                    return false;
                } else {
                    document.getElementById("user_reminder_register").innerHTML = "&nbsp;";
                    //alert("account checked method called! OK!");
                    return true;
                }
            }
        };
        var para = "user_register_repeatCheck=" + ele_register.account.value;
        request.send(para);
    } else {
        document.getElementById("user_reminder_register").innerHTML = "请输入账号 !";
        //alert("account checked method called! empty!");
        return false;
    }

}

function checkName_register() {
    //alert("method called!");
    if (ele_register.name.value == "") {
        document.getElementById("user_reminder_register_name").innerHTML = "请输入姓名 !";
        return false;
    } else {
        document.getElementById("user_reminder_register_name").innerHTML = "&nbsp;";
        return true;
    }
}

function checkPassword_register() {
    //alert("method called!");
    if (ele_register.password.value == "") {
        document.getElementById("password_reminder_register").innerHTML = "请输入密码 !";
        return false;
    } else if (ele_register.password.value.length < 6){
        document.getElementById("password_reminder_register").innerHTML = "密码至少6位 !";
        return false;
    } else {
        document.getElementById("password_reminder_register").innerHTML = "&nbsp;";
        return true;
    }
}

function checkPassword_register_confirm() {
    //alert("method called!");
    if (ele_register.passwordConfirm.value == "") {
        document.getElementById("password_reminder_register_confirm").innerHTML = "请再次输入密码 !";
        return false;
    } else if (ele_register.passwordConfirm.value != ele_register.password.value){
        document.getElementById("password_reminder_register_confirm").innerHTML = "两次密码不符 !";
        return false;
    } else {
        document.getElementById("password_reminder_register_confirm").innerHTML = "&nbsp;";
        return true;
    }
}

var request = new XMLHttpRequest();

function check_register() {
    var accountOk = false;
    var passwordOk = false;
    var passConfirmOk = false;
    var nameOk = false;

    checkAccount_register();
    if (response === "") {
        accountOk = true;

    }
    if (checkPassword_register()) {
        passwordOk = true;
    }

    if (checkPassword_register_confirm()){
        passConfirmOk = true;
    }

    if (checkName_register()){
        nameOk = true;
    }

    //alert("accountOk : " + accountOk);
    //alert("nameOk : " + nameOk);
    //alert("passwordOk : " + passwordOk);
    //alert("passConfirmOk : " + passConfirmOk);

    var correct;
    if (accountOk && passwordOk && passConfirmOk && nameOk) {
        request.open("post", "logAndRegisterServer.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.onreadystatechange = function () {
            if ((this.status >= 200 && this.status <= 300 || this.status == 304) && this.readyState == 4) {
                correct = this.responseText;
                if (correct === 'registerSuccess') {
                    window.location.href="home.php";
                    alert("注册成功");
                    return true;
                } else {
                    alert("注册失败. responseText : " + correct);
                    //alert(correct);
                    document.getElementById("password_reminder_register_confirm").innerHTML = "未知错误!";
                }

            }
        };
        var para = "user_register=" + ele_register.account.value + "&pass_register=" + ele_register.password.value + "&user_register_name=" + ele_register.name.value;
        request.send(para);


    } else {
        checkAccount_register();
        checkPassword_register();
        checkPassword_register_confirm();
        alert("注册信息存在错误");
    }
}