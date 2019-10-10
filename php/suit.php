<?php

include "template/nav.php";

?>

<style>
    .result{
        border: solid silver 2px;
        padding: 5px;
        margin:10px 4%;
        height: 270px;



    }


    .search-bottom{
        clear: both;

    }
    .result img{
        width: 80%;
        /*height: 80%;*/
        height: 160px;
    }
    #searchResult{
        margin-top: 10px;
    }
    #searchBox{
        margin-top: 10px;
        margin-bottom: 20px;
    }

</style>
<script>
    document.getElementById("homeLi").className = "active";
</script>
    <div  class="col-md-9 col-md-offset-3 " id="searchBox" autocomplete="off">
        <form action="suit.php " class="form-inline center-block" method="get">
            <input  type="text" id="nameSearch" class="form-control"  name="name" value=
            <?php

            if (isset($_GET['name'])&&$_GET['name']!=="")
                echo  "\"".$_GET['name']."\"" ;
            else echo  "  \"\" .  placeholder='请输入型号'";
            ?>


            style="width:45%;">

            <select class="form-control " name="type" id="typeSearch">
                <option value="all">全部</option>
                <option
                    <?php
                    if (isset($_GET['type']))
                        if ($_GET['type']=='上衣')
                            echo " selected "
                    ?>
                    value="上衣">上衣</option>

                <option  <?php if (isset($_GET['type']))
                    if ($_GET['type']=='下装')
                        echo " selected "
                         ?>value="下装">下装</option>
            </select>

            <select class="form-control " name="status" id="statusSearch">
                <option      value="all">全部</option>
                <option     <?php
                if (isset($_GET['status']))
                    if ($_GET['status']=='off')
                        echo " selected "
                ?> value="off">已出租</option>
                <option    <?php
                if (isset($_GET['status']))
                    if ($_GET['status']=='on')
                        echo " selected "
                ?> value="on">待出租</option>
            </select>

            <input type="submit" class="btn btn-default input-group" value="查询" onclick="search()">
        </form>
    </div>

    <div  id="searchResult">
        <?php
        $wherelist = array();

        if (isset($_GET['name']) || isset($_GET['type']) || isset($_GET['status'])) {
            if (!empty($_GET['name']) && $_GET['name'] != "") {
                $wherelist[] = " model like '%" . $_GET['name'] . "%'";


            }
            if (!empty($_GET['type']) && $_GET['type'] != "all" && $_GET['type'] != "") {
                $wherelist[] = " type like '%" . $_GET['type'] . "%'";

            }
            if (!empty($_GET['status']) && $_GET['status'] != "all"  && $_GET['status'] != "all") {
                $wherelist[] = " status like '%" . $_GET['status'] . "%'";

            }
        }


        if (count($wherelist) > 0) {
            $where = " where " . implode(' and ', $wherelist);

        }else $where=" ";



        require_once 'config.php';

        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->exec("set names utf8");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select * from suit {$where} ";
        $result = $pdo->query($sql);
        //$totalnum =0;
        //while ($nua = $result->fetch()) {
        //    $totalnum +=1;
        //}

        $totalnum = count($result->fetchAll());
        if ($totalnum > 0) {
            $pagesize = 6;  //每页显示条数
            $maxpage = ceil($totalnum / $pagesize);         //总共有几页
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            if ($page < 1) {
                $page = 1;
            }
            if ($page > $maxpage) {
                $page = $maxpage;
            }
            $limit = " limit " . ($page - 1) * $pagesize . ",$pagesize";

            $sql1 = "select * from suit {$where} ORDER BY model {$limit}";
            $res = $pdo->query($sql1);

            while ($row = $res->fetch()) {

                echo " <div class='result col-md-3 ' totalnum='" . $totalnum . " '>";
                echo " <img src=\"../suitImg/" ;
                if ($row['imageFileName'] !=NULL) echo   $row['imageFileName'] ;
                else echo "default.jpg";

                echo     "\" class='center-block'>";
                echo " <p class='model'>型号: " . $row['model'] . "</p>";
                echo " <p class='status'>状态: ";
                if ($row['status']=='on') {
                    echo "待出租</p>";
                    echo "<input type='button' value='租赁' id='".$row['suitID']."' class='btn btn-default rentBtn'>  ";

                }
                else {
                    echo $row['rentTime'] . " 租出</p>";
                    echo "<input type='button' value='归还' id='".$row['suitID']."'  class='btn btn-default returnBtn'>  ";
                }
                echo " </div>";
            }

        } else {
            echo "搜索结果不存在";
        }
        $pdo = null;
        ?>


    </div>


    <div class="search-bottom ">
        <div class="col-md-12 text-center">
            <ul id="pageBar" class="pagination" curPage="<?php if (isset($_GET['page'])) echo $_GET['page'];
            else echo 1 ?>"><!--这里添加分页按钮栏--></ul>
        </div>
    </div>

<?php

include "template/foot.php";

?>
<script src="../js/suit.js"> </script>
<script src="../js/cart.js"></script>

