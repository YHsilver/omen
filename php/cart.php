<?php

include "template/nav.php";

?>
<style>
    table img{
        width: 100px;
        height: 100px;
    }
    #myModal {
        display: none;

    }
</style>
<script>
    document.getElementById("cartLi").className = "active";
</script>

    <div>
        <div class="panel panel-default col-md-12 col-md-offset-0">
            <div class="panel-heading row">
                <p class="panel-title  col-md-4">待租赁列表 </p>
            </div>
            <table class="table table-hover panel-body table-responsive">
                <thead>
                <tr>
                    <td>缩略图</td>
                    <td>衣服型号</td>
                    <td>操作</td>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once "config.php";
                $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM suit  WHERE inCart=1 ";
                $result = $pdo->query($sql);

                while ($row = $result->fetch()) {
                    echo "<tr>";
                    echo " <td>";
                    echo " <img src='../suitImg/";
                    if ($row['imageFileName'] != NULL) echo"{$row['imageFileName']}'>";
                    else echo "default.jpg'>";

                    echo "</td>";
                    echo "<td>" . $row['model'] . "</td>";

                    echo "<td><input  type='button' onclick='delete_cart(this.id)' value='删除' id='" . $row['suitID'] . "'  class='deleteBtn btn btn-default '> </td> ";
                    echo "  </tr>";
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3">

                        <input style="float: right" type="button" onclick="rentAll()" value="全部租赁" class="btn btn-default" >
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>


        <div class="row col-md-6 reveal-modal col-md-offset-3" style="clear: both" id="myModal">
            <form  class="form-horizontal " id="rentForm" action="" autocomplete="off">
                <div class="form-group">
                    <label for="client" class="col-sm-3 control-label">客户名</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="client" name="client" placeholder="请输入客户名" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="weChat" class="col-sm-3 control-label">微信号</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="weChat" name="weChat" placeholder="请输入客户微信" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">租赁费</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="price" name="price" placeholder="请输入租赁费（不含押金）"
                               step="0.01" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date" class="col-sm-3 control-label">租赁日期</label>
                    <div class="col-sm-9">
                        <input type="datetime-local" class="form-control" id="date" name="date" min="2000-01-01T00:00"
                               max="9999-01-01T00:00" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
                        <button type="button" class="btn btn-default  close-reveal-modal" id="resetBtn"
                                onclick="cancelRent()">取消
                        </button>

                        <button type="submit" class="btn btn-default" id="submitBtn">确认</button>
                    </div>
                </div>
            </form>
        </div>


    </div>
<?php

include "template/foot.php";

?>
<script src="../js/suit.js"></script>
<script src="../js/cart.js"></script>
