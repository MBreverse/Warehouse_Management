<!doctype html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta charset="UTF-8"/>
<link rel="stylesheet" type="text/css" href="style.css">
<title>尋找庫存空間</title>
    <h1>庫存位置</h1>
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
</head>
<body>  
        <?php

            $id=$_POST["inv"];//庫存品號陣列         
            $rec_id=$_POST["rec_id"];//領料單號
            echo "<form action='receive_done.php' method='post'>";
            //對每一個庫存品號查詢
            for($i=0;$i<sizeof($id);$i++){

                //列出領取庫存資訊
                $query="SELECT inventory_num,inventory_name
                FROM inventory
                WHERE inventory_num='$id[$i]'";
                $rs=mysqli_query($link,$query);
                $inv_det=mysqli_fetch_row($rs);

                echo "領取項目:";
                echo "<table border='1'>";
                    echo "<tr><td>品號</td><td>品名</td></tr>";
                    echo "<tr><td>".$inv_det[0]."</td><td>".$inv_det[1]."</td></td>";
                echo "</table>";

                //列出庫存空間資訊
                $query="SELECT space_ID,space_class,space_num,state
                FROM space
                WhERE (space.inventory_num='$id[$i]')";
                $rs=mysqli_query($link,$query);
                
                
                echo "對應庫存位置:";
                echo "<table border='1'>";
                echo "<tr><td>ID</td><td>倉庫類別</td><td>隔間代號</td><td>狀態</td></tr>";
                    $count=0;
                    while($sp=mysqli_fetch_row($rs)){
                        echo "<tr>";
                        for($j=0;$j<sizeof($sp);$j++){
                            echo "<td>".$sp[$j]."</td>";
                            if($j==0){
                            echo "<input type='hidden' name='sp_id[]' value='$sp[$j]'>";
                            }
                        }
                        echo "</tr>";
                        $count++;
                    } 
                echo "</table>";

                echo "<input type='hidden' name='rec_id' value=$rec_id>";
                echo"<br><hr><br>";//分隔線
            }
            
            echo "<input type='submit' value='領料確認'>";
            echo "</form>";
        ?>
</body>
</html>