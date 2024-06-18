<!DOCTYPE html>
<html>
    <head>
        <title>領取確認</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
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
        ?>
    </head>

    <body>
        <h1>領取確認</h1>

        <?php
        $sp_id=$_POST["sp_id"];//領料的倉庫空間id
        $rec_id=$_POST['rec_id'];//領料單號
        // for($i=0;$i<count($sp_id);$i++){
        //     echo $sp_id[$i];
        // }
        ?>
        
    <form method="post" action="receive_done_suc.php" name="form_recieve">
        <div>
            <label>[0:表示空間未存放任何庫存</label><br>
            <label>[1:表示空間已存放，但未放滿</label><br>
            <label>[2:表示空間已放滿 </label><br>
            <hr>
        </div>
        <label>請修改領取後的空間狀態:</label>
        <table border='1'>
            <tr>
            <td>庫別</td>
            <td>隔間</td>
            <td>狀態</td>
            </tr>
            <?php
                $str='';
                for($i=0;$i<count($sp_id);$i++){
                    $temp="space_id='$sp_id[$i]'";
                    if($i!=(count($sp_id)-1)){
                        $str=$str.$temp." or ";
                    }else{
                        $str=$str.$temp;
                    }
                }
                //查詢空間資訊
                $query="SELECT space_class,space_num,state FROM space WHERE ".$str;
                $result=mysqli_query($link,$query);//這裡是接受從尋找庫存空間系統的輸出
                error_reporting(0);
                echo "<input type='hidden' name='rec' value=".$rec_id.">";

                $i=0;

                while($row_spaceInfo=mysqli_fetch_row($result))
                {
                    error_reporting(0);
                    $className="spaceClass".$i;
                    $compartName="Compart".$i;
                    $statusName="Status".$i;
                    echo "<tr>";
                    echo "<td>$row_spaceInfo[0]<input type='hidden' size='1' name=".$className." value=".$row_spaceInfo[0]."></td>";  
                    echo "<td>$row_spaceInfo[1]<input type='hidden' size='1' name=".$compartName." value=".$row_spaceInfo[1]."></td>";

                    if($row_spaceInfo[2]==1)
                    {
                        echo "<td><input type=".radio." name=".$statusName." value='0'>0</input>
                        <input type=".radio." name=".$statusName." value='1' checked>1</input>
                        <input type=".radio." name=".$statusName." value='2'>2</input></td>";
                        echo "</tr>";
                    }
                    else if($row_spaceInfo[2]==2)
                    {
                        echo "<td><input type=".radio." name=".$statusName." value='0' checked>0</input>
                        <input type=".radio." name=".$statusName." value='1'>1</input>
                        <input type=".radio." name=".$statusName." value='2' checked>2</input></td>";
                        echo "</tr>";
                    }
                    $i++;
                }
            ?>
        </table>
        <p>
        <input type="submit" value="確認完成">
    </form>
    <P>
    <form method="post" action="receive_done_suc.php">
        <button>首頁</button>
    </form>
    </body>
</html>