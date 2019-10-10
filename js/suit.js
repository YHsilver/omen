
var totalnum;
var pageSize = 6;       //每一页记录数
var totalPage;

totalnum = document.getElementsByClassName('result')[0].getAttribute("totalnum");
totalPage = Math.ceil(totalnum / pageSize);      //总页数

var input = {
    name: document.getElementById("nameSearch"),
    type: document.getElementById("typeSearch"),
    status: document.getElementById("statusSearch")
};



var curPage=1;



function doSearch(page) {
    curPage = page;
    var url = "suit.php?name=" + input.name.value + "&type=" + input.type.value + "&status=" + input.status.value
        + "&page=" + page ;
    window.location.href=url;

}

//获取分页条（分页按钮栏的规则和样式根据自己的需要来设置）
function getPageBar() {

    pageBar = "";
    curPage=document.getElementById('pageBar').getAttribute('curPage');


    if (curPage > totalPage) {
        curPage = totalPage;
    }
    if (curPage < 1) {
        curPage = 1;
    }



    //如果不是第一页
    if (curPage != 1) {
        pageBar += "<li class='pageBtn'><a href='javascript:doSearch(1)'>首页</a></li>";
        pageBar += "<li class='pageBtn'><a href='javascript:doSearch(" + (curPage - 1) + ")'><<</a></li>";
    }

    //显示的页码按钮6个
    var start, end;
    if (totalPage <= 6) {
        start = 1;
        end = totalPage;
    } else {
        if (curPage - 2 <= 0) {
            start = 1;
            end = 6;
        } else {
            if (totalPage - curPage < 2) {
                start = totalPage - 5;
                end = totalPage;
            } else {
                start = curPage - 2;
                end =  totalPage;
            }
        }
    }

    for (var i = start; i <= end; i++) {
        if (i == curPage) {
            pageBar += "<li class='pageBtn-selected'><a href='javascript:doSearch(" + i + ")'>" + i + "</a></li>";
        } else if (i == end) {
            pageBar += "<li class='pageBtn'><a href='javascript:doSearch(" + totalPage + ")'>" + totalPage + "</a></li>";
        } else if (i == end - 1&&curPage!=end&&curPage!=end-1) {
            pageBar += "<li class='pageBtn disabled'><a>...</a></li>";
        } else {
            pageBar += "<li class='pageBtn'><a href='javascript:doSearch(" + i + ")'>" + i + "</a></li>";
        }
    }

    //如果不是最后页
    if (curPage != totalPage) {
        pageBar += "<li class='pageBtn'><a href='javascript:doSearch(" + (parseInt(curPage) + 1) + ")'>>></a></li>";
        pageBar += "<li class='pageBtn'><a href='javascript:doSearch(" + totalPage + ")'>尾页</a></li>";
    }
    $("#pageBar").html(pageBar);

}

$(document).ready(function(){
    getPageBar();
});




$(".returnBtn").click(function () {
    window.location.href="order.php";

});


