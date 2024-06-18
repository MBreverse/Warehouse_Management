<!DOCTYPE html>
<html>
    <head>
        <title>Check Success</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
    </head>
    <body>
    <?php
            $link=mysqli_connect(
                'localhost',
                'root',
                '',
                'mydb'
            );
            if(mysqli_errno($link))
            {
                echo"連接庫存資料庫失敗".mysqli_connect_error();
            }
            if(isset($_POST["select"]))
            {
            $name=$_POST["select"];
            $result2=mysqli_query($link,"select inventory.inventory_num,space.space_class
            from inventory left join space on inventory.inventory_num=space.inventory_num");
            $row_result2=mysqli_fetch_row($result2);
            $result3=mysqli_query($link,"select * from incoming");
            $count=1;
            while($row_result3=mysqli_fetch_row($result3))
            {
                $count++;
            }
            $x=6-strlen((string)$count);
            $s="";
            for($i=0;$i<$x;$i++)
            {
                $s=$s.'0';
            }
            $s=$s.(string)$count;
            $number=$_POST["num"];
            mysqli_query($link,"INSERT INTO incoming(incoming_ID,incoming_amount,incoming_class,incoming_check,inventory_num) value('$s','$number','$row_result2[1]',0,'$row_result2[0]')");
           }
           mysqli_close($link);
           ?>
    <h1>入庫成功</h1>
    <form method="post" action="Homepage.PHP">
    <button name="home" type="submit">回首頁</button>
    <br><br>
    </form>
    <form method="post" action="Check.PHP">
    <button name="go_check" type="submit">繼續盤點</button>
    </form>
    </body>
</html>