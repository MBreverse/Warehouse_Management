<!DOCTYPE HTML>
<html>
	<head>
		<title>新建庫存項目</title>
        <meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html;charset=utf-8">
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Cache-Control" content="no-cache" />
        <meta HTTP-EQUIV="EXPIRES" CONTENT="0">
        <link rel="stylesheet" type="text/css" href="style.css">
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
        <h3>設定新庫存項目的各項資訊</h3><br>
		<form action="insert_new_inventory.php" method="post" autocomplete="off">
		    <label><b>類別: </b></label>
		    <select name="input1">
			    <option value="A">A</option>
			    <option value="B">B</option>
			    <option value="C">C</option>
			    <option value="D">D</option>
			    <option value="E">E</option>
            </select>
        <br>
        <p>
            <label><b>品名: </b></label>
            <input  required type="text" name="input2" placeholder="塑膠瓶A-13" maxlength="20" autocomplete="off"><br>
        </p>

        <p>
            <label><b>規格: </b></label>
            <input  required type="text" name="input4" placeholder="12*12*12" maxlength="11" autocomplete="off"><br>
        </p>
        <p>
            <label><b>單位: </b></label>
            <input  required type="text" name="input5" placeholder="pcs" maxlength="5" autocomplete="off"><br>
        </p>
       
        <p>
            <label><b>本次盤點數量: </b></label>
            <input  required type="text" name="input7" pattern="[0-9]{1,11}" autocomplete="off"><br>
        </p>
        <p>
        <input type="submit" value="送出">
		<input type="reset" value="取消">
        </p>
        </form>

        <?php
         if(isset($_POST['input1'])){
            $//link = mysqli_connect("localhost","root","","mydb");
            $class=$_POST['input1'];
            $name=$_POST['input2'];
            $num='S000';
            $std=$_POST['input4'];
            $uni=$_POST['input5'];
            $maxi=0;
            $amoun=$_POST['input7'];
            $ck = mysqli_query($link, "SELECT inventory_name, inventory_num FROM inventory");
            $check = 0;
            while($y=mysqli_fetch_row($ck))
            {
                if($y[0]==$name || $y[1]==$num){
                    $check = 1;
                }
            }
            if(!$check){
                $a = mysqli_query($link,"select * from inventory");
                $count = 1;
			    while($y=mysqli_fetch_row($a))
			    {
			    	$count++;
                }
                $count_st = (string)$count;
                $len = strlen($count_st);
                $inventory_id="";
                while(9-$len > 0){
                    $inventory_id = $inventory_id . "0";
                    $len++;
                }
                $inventory_id=$num . '-' . $inventory_id . $count_st;
                $a = mysqli_query($link,"INSERT INTO inventory(inventory_name, inventory_num, standard, unit, inventory_amount, max)
                                        VALUE('$name','$inventory_id','$std','$uni',$amoun,'$maxi')"); //插入新項目進庫存資料，預設數量為0
                
                $x = mysqli_query($link,"select * from incoming");//建立新入庫品資料，預設check=0
                $count2 = 1;
			    while($y=mysqli_fetch_row($x))
			    {
			    	$count2++;
                }
                $count_st2 = (string)$count2;
                $len2 = strlen($count_st2);
                $incoming_id="";
                while(6-$len2 > 0){
                    $incoming_id = $incoming_id . "0";
                    $len2++;
                }
                $incoming_id=$incoming_id . $count_st2;
                mysqli_query($link,"INSERT INTO incoming(incoming_ID, incoming_amount, incoming_class, incoming_check, inventory_num)
                                      VALUE('$incoming_id','$amoun','$class',0,'$inventory_id')");
                header("Location:insert_new_inventory_success.php");
            }
            else{
                header("Location:insert_new_inventory_fail.php");
            }
            //mysqli_close($link);
         }
        ?>

        
    </body>
    <footer>
       
    </footer>
</html>