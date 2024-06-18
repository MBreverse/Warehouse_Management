<!doctype html>
<html lang="en">
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/-->
<meta charset="UTF-8"/>
<link rel="stylesheet" type="text/css" href="style.css">
<title>尋找庫存空間</title>
    <h1>領料單列表</h1>
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
                <td>流水號</td>
                <td>日期</td>
                <td>部門編號</td>
                <td>部門名稱</td>
                <td>領料確認</td>
                <td>查看內容</td>
            </tr>
        <?php
            //列出所有領料單
            $query="SELECT receipt_ID,date,depart.depart_num,depart_name,check_receive FROM receive_order,depart WHERE (receive_order.depart_num=depart.depart_num)";
            $result=mysqli_query($link,$query);
            
            while($recipt=mysqli_fetch_row($result)){
                echo "<form action='find_invent_space2.php' method='post'>";
                echo '<tr>';
                for($i=0;$i<sizeof($recipt);$i++){
                    //紀錄單號
                    echo "<td>";
                    echo $recipt[$i];
                    echo "<input type='hidden' name ='$i' value='$recipt[$i]'>";

                        if($i==4){
                            $check=$recipt[$i];
                            if($check=='1'){
                                echo "領料已完成";
                            }else if($check=='0'){
                                echo "尚未領料";
                            }
                        }

                    echo "</td>";
                 }         
                    echo "<td>";
                        echo "<input type='submit' value='查看'>";               
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
