<!doctype html>
<html lang="en">
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/-->
<meta charset="UTF-8"/>
<link rel="stylesheet" type="text/css" href="style.css">
<title>尋找存放空間</title>
    <h1>入庫品列表</h1>
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
        <div>
            <table border='4'>
            <tr>
                <td>ID</td>
                <td>品名</td>
                <td>數量</td>
                <td>單位</td>
                <td>類別</td>
                <td>品號</td>
                <td>規格</td>
                <td>存放確認</td>
                <td>尋找存放空間</td>
            </tr>
        <?php
            //列出所有入庫品
            $query="SELECT incoming_ID,inventory_name,incoming_amount,unit,incoming_class,incoming.inventory_num,standard,incoming_check FROM incoming,inventory WHERE (incoming.inventory_num=inventory.inventory_num)";
            $result=mysqli_query($link,$query);
            
            while($incoming=mysqli_fetch_row($result)){
                echo "<form action='find_storing_space2.php' method='post'>";
                echo '<tr>';
                for($i=0;$i<sizeof($incoming);$i++){
                    //紀錄入庫ID
                    echo "<td>";
                    echo $incoming[$i];
                    if($i==0){
                        echo "<input type='hidden' name ='ID' value='$incoming[$i]'>";
                    }
                    if($i==4){
                        echo "<input type='hidden' name ='Class' value='$incoming[$i]'>";
                    }

                        if($i==7){
                            $check=$incoming[$i];
                            if($check=='1'){
                                echo "(已完成存放)";
                            }else if($check=='0'){
                                echo "(尚未存放)";
                            }
                        }
                    echo "</td>";
                 }         
                    echo "<td>";
                    if($check=='0'){
                        echo "<input type='submit' value='查詢'>";
                    }else{
                        echo "已完成";
                    }
                    echo"</td>";        
                echo '</tr>';
                echo "</form>";
            }            
        ?>
            </table>
        </div>
        <form method="post" action="index.php">
            <button>回首頁</button>
        </form>
</body>
</html>
