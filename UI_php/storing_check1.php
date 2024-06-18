<!DOCTYPE html>
<html>
    <head>
        <title>存放確認</title>
        <h1>修改倉庫空間狀態:</h1>
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
        <?php
        $sp_id=$_POST["sp_id"];//可存放的倉庫空間id
        $in_id=$_POST['ID'];//入庫品ID
        // for($i=0;$i<count($sp_id);$i++){
        //     echo $sp_id[$i];
        // }
        ?>
        
    <form method="post" action="storing_check2.php" name="form_recieve">
        <div>
            <label>[0:表示空間未存放任何庫存</label><br>
            <label>[1:表示空間已存放，但未放滿</label><br>
            <label>[2:表示空間已放滿 </label><br>
            <hr>
        </div>
        <label>請修改存放入庫品後，變更的空間狀態:</label>
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

                echo "<input type='hidden' name='ID' value='$in_id'>";

                $i=0;

                while($space=mysqli_fetch_row($result))
                {
                    error_reporting(0);
                    $ClassN="spaceClass".$i;
                    $CompartN="Compart".$i;
                    $StatusN="Status".$i;
                    echo "<tr>";
                    echo "<td>$space[0]<input type='hidden' size='1' name=".$ClassN." value=".$space[0]."></td>";  
                    echo "<td>$space[1]<input type='hidden' size='1' name=".$CompartN." value=".$space[1]."></td>";

                    if($space[2]==0)
                    {
                        echo "<td><input type=".radio." name=".$StatusN." value='0' checked>0</input>
                        <input type=".radio." name=".$StatusN." value='1'>1</input>
                        <input type=".radio." name=".$StatusN." value='2'>2</input></td>";
                        echo "</tr>";
                    }
                    else if($space[2]==1)
                    {
                        echo "<td><input type=".radio." name=".$StatusN." value='0'>0</input>
                        <input type=".radio." name=".$StatusN." value='1' checked>1</input>
                        <input type=".radio." name=".$StatusN." value='2'>2</input></td>";
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
    </body>
</html>