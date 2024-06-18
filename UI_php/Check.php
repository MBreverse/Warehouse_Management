<!DOCTYPE html>
<html>
    <head>
        <title>Check System</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <h1>盤點系統</h1>
    <?php
    //資料庫連線
        header("Content-Type:text/html;charset=utf-8");
        $server="127.0.0.1";
        $user="root";
        $password="";
        $db="mydb";
        $link=mysqli_connect($server,$user,$password,$db);
        if(mysqli_connect_errno()){
            echo"Fail to connect to Mysql:".mysqli_connect_errno();
            exit();
        }
        mysqli_set_charset($link,'utf8');

    ?>
    <form method="post" action="Check_suc.PHP" id="form1" name="form1">
        <label>庫存項目清單:</label>
        <select name="select">
        <?php
            $result1=mysqli_query($link,"select inventory_name from inventory");
            while($row_result1=mysqli_fetch_row($result1))
            {
                echo "<option value=".$row_result1[0].">".$row_result1[0]."</option>\n";
            }
            mysqli_close($link);
        ?>
        </select>
        <br><br><br><br><br>
        <p>入庫數量:<input value="1" type="number" name="num" min="1"></p>
        <button name="check" type="submit">確認</button><p>

    <hr>
    <div>
        <p>若盤點時，無對應的庫存項目，請新建立一個庫存項目</p><br>
            </form>
            <form method="post" action="insert_new_inventory.php" id="form3" name="form3">
                <button>新建庫存項目</button>
            </form>
    <div>

    <p>
    <form method="post" action="index.php">
        <button>回首頁</button>
    </form>
    </body>
</html>