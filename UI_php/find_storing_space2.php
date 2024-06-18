<!doctype html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta charset="UTF-8"/>
<link rel="stylesheet" type="text/css" href="style.css">
<title>尋找存放空間</title>
    <h1>可存放位置</h1>
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

            $in_id=$_POST["ID"];//入庫品ID
            $in_class=$_POST["Class"];//入庫品類別
            echo "<form action='storing_check1.php' method='post'>";


            //列出入庫品資訊
                $query="SELECT incoming_ID,inventory_name,incoming_amount,unit,incoming_class,incoming.inventory_num,standard,incoming_check 
                FROM incoming,inventory 
                WHERE (incoming.inventory_num=inventory.inventory_num AND incoming_ID='$in_id')";
                $rs=mysqli_query($link,$query);
                $inc_det=mysqli_fetch_row($rs);

                echo "入庫品資訊:";
                echo "<table border='4'>";
                    echo "<tr>";
                        echo "<td>ID</td><td>品名</td><td>數量</td><td>單位</td><td>類別</td> <td>品號</td><td>規格</td><td>存放確認</td>";
                    echo "</tr><tr>";
                        for($i=0;$i<sizeof($inc_det);$i++){
                            //紀錄入庫ID
                            echo "<td>";
                            echo $inc_det[$i];
        
                                if($i==7){
                                    $check=$inc_det[$i];
                                    if($check=='1'){
                                        echo "(已完成存放)";
                                    }else if($check=='0'){
                                        echo "(尚未存放)";
                                    }
                                }

                            echo "</td>";
                        }         
                    echo "</tr>";
                echo "</table>";

                //列出可存放空間資訊
                $query="SELECT space_ID,space_class,space_num,state
                FROM space
                WhERE (space.space_class='$in_class' AND (space.state='1' OR space.state='0'))";
                $rs=mysqli_query($link,$query);
                
                
                echo "可存放庫存位置:";
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

                echo "<input type='hidden' name='ID' value=$in_id>";
                echo"<br><hr><br>";//分隔線
            echo "倉庫人員存放後，請修改空間的狀態!"."<br>";
            echo "<input type='submit' value='修改空間狀態'>";
            echo "</form>";
        ?>
</body>
</html>