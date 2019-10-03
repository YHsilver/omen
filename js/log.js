

//登陆对象
var ele_log = {
    name: document.getElementById("user_log"),
    password: document.getElementById("password_log"),
};


ele_log.name.onblur = function () {
    checkName_log();
};
ele_log.password.onblur = function () {
    checkPassword_log()
};

function checkName_log() {
    if (ele_log.name.value == "") {
        document.getElementById("user_reminder_log").innerHTML = "请输入用户名 !";
    } else {
        document.getElementById("user_reminder_log").innerHTML = "&nbsp;";
        return true;
    }
}

function checkPassword_log() {
    if (ele_log.password.value == "") {
        document.getElementById("password_reminder_log").innerHTML = "请输入密码 !";
    } else {
        document.getElementById("password_reminder_log").innerHTML = "&nbsp;";
        return true;
    }
}

var request = new XMLHttpRequest();

function check_log() {
    var nameok = false;
    var passwordok = false;


    if (checkName_log()) {
        nameok = true;

    }
    if (checkPassword_log()) {
        passwordok = true;
    }

    var correct;
    if (nameok && passwordok) {
        request.open("post", "log.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.onreadystatechange = function () {
            if ((this.status >= 200 && this.status <= 300 || this.status == 304) && this.readyState == 4) {
                correct = this.responseText;
                if (correct == 'operator') {
                    window.location.href="home.php";
                    alert("登陆成功");
                    return true;

                } else if (correct=='master') {

                    window.location.href = "analysis.php";
                    alert("登陆成功");
                    return true;
                } else {
                    document.getElementById("password_reminder_log").innerHTML = "用户名或密码错误!";
                    return false
                }

            }
        };
        var para = "username=" + ele_log.name.value + "&password=" + ele_log.password.value;
        request.send(para);


    } else {
        checkName_log();
        checkPassword_log();
        return false;
    }
}

