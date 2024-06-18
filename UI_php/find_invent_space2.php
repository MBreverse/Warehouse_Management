<!doctype html>
<html lang="en">
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/-->
<meta charset="UTF-8"/>
<link rel="stylesheet" type="text/css" href="style.css">
<title>尋找庫存空間</title>
    <h1>領料內容</h1>
    <?php
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
            <label>領料單資訊:</label>
                <table border='4'>
                    <tr>
                        <td>流水號</td>
                        <td>日期</td>
                        <td>部門編號</td>
                        <td>部門名稱</td>
                        <td>領料確認</td>
                    </tr>
                    <?php 
                        $receipt_id=$_POST['0'];
                        $date=$_POST['1'];
                        $depart_id=$_POST['2'];
                        $depart_num=$_POST['3'];
                        $check=$_POST['4'];

                        echo "<tr>";
                        echo "<td>".$receipt_id."</td>";
                        echo "<td>".$date."</td>";
                        echo "<td>".$depart_id."</td>";
                        echo "<td>".$depart_num."</td>";
                        
                        echo "<td>".$check;
                        if($check=='1'){
                            echo "(領料已完成)";
                        }else if($check=='0'){
                            echo "(尚未領料)";
                        }
                        echo "</td>";
                    ?>
                </table>
        </div>
        <div>
            <label>內容:</label>
            
            <table border='4'>
                <tr>
                    <td>品號</td>
                    <td>名稱</td>
                    <td>數量</td>
                </tr>
            <?php
                //列出領料單內容
                $query="SELECT receive_amount.inventory_num,inventory_name,receive_amount 
                FROM inventory,receive_amount,receive_order 
                WhERE (inventory.inventory_num=receive_amount.inventory_num AND receive_order.receipt_ID=receive_amount.receipt_number AND receive_order.receipt_ID=$receipt_id)";
                $result=mysqli_query($link,$query);
                
                $invent_array=array();//庫存品號陣列
                while($invent=mysqli_fetch_row($result)){
                    echo '<tr>';
                    for($i=0;$i<sizeof($invent);$i++){
                        if($i==0){array_push($invent_array,$invent[$i]);};
                        echo '<td>'.$invent[$i].'</td>';
                    }                 
                    echo '</tr>';
                }            
            ?>
            </table>
        </div>
        <div>
            <br>
            <?php 
                echo "<form action='find_invent_space3.php' method='post'>";
                    echo "<input type='submit' value='領料單列表'>";
                echo"</form>"
            ?>
            <hr>
            <?php
            if($check=='0'){
                echo "<label>"."尋找庫存位置:"."</label>";
                echo "<form action='find_invent_space3.php' method='post'>";
            
                    for($i=0;$i<sizeof($invent_array);$i++){
                    echo "<input type='hidden' name='inv[]' value='$invent_array[$i]'>";
                    }
                    //echo "<input type='hidden' name='count' value=".count($invent_array).">";
                    echo"<input type='hidden' name='rec_id' value=$receipt_id>";
                    echo "<input type='submit' value='查詢'>";
                
                echo "</form>";
            }
            ?>
        </div>
</body>
</html>
