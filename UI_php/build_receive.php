<!DOCTYPE HTML>
<html>
	<head>
		<title>領料單填寫</title>
        <h1>填寫領料單</h1>
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
        <form action="build_receive.php" method="post" autocomplete="off">
        <label><b>部門: </b></label>
        <select name="input1" submit>
        <?php
            $disable = "disable";
            //$link = mysqli_connect("localhost","root","","mydb");
            $resuit = mysqli_query($link, "SELECT * FROM depart");
            while($y = mysqli_fetch_row($resuit))
            {
                echo "<option value = ".$y[1]." submit>".$y[0]."</option>";
            }
        ?>
        </select>
        <br>
        <br>
        <label><b>要領取的物品: </b></label>
        <select name="input2">
        <?php
            $num;
            $d_n;
            $total;
            $resuit = mysqli_query($link, "SELECT inventory_name, inventory_num, inventory_amount FROM inventory");
            while($y = mysqli_fetch_row($resuit))
            {
                if($y[2] != 0){echo "<option value = ".$y[1]." >".$y[0]."</option>";}
            }
        ?>
        </select>
        <br>
        <input type="submit" value="確認">
        </form>
        <br>
        <form action="build_receive.php" method="post" autocomplete="off">
        <label><b>數量: </b></label>
        <?php
            if(isset($_POST['input2'])){
                $d_n = $_POST['input1']; $num = $_POST['input2'];
                $resuit = mysqli_query($link, "SELECT inventory_amount FROM inventory WHERE inventory_num = '$num'");
                $total2 = 0;
                while($y = mysqli_fetch_row($resuit))
                {
                    $total2 += $y[0];
                }
                $total = $total2;
                echo "<input  required type='number' name='input3' max='".$total."' min='1' maxlength='11' pattern='[0-9]{1,99999999999}' placeholder='最多".$total."' autocomplete='off'><br>";
                echo "<input  required type='hidden' name='input4' value='".$d_n."'><br>";
                echo "<input  required type='hidden' name='input5' value='".$num."'><br>";
            }
        ?>
        <br>
        <input type="submit" value="送出">
        <br>
        </form>
        <?php
            if(isset($_POST['input3'])){
                $depart_n = $_POST['input4'];
                $inventory_n = $_POST['input5'];
                $amo = $_POST['input3'];
                $receipt_id = substr(date("Y"), 2) . date("m") . date("d");
                $resuit = mysqli_query($link, "SELECT receipt_ID FROM receive_order");
                $count = 1;
                while($y=mysqli_fetch_row($resuit))
                {
                    $count++;
                    if($count > 999){$count = 1;}
                }
                $count_st = (string)$count;
                $len = strlen($count_st);
                while(3-$len > 0){
                    $receipt_id = $receipt_id . "0";
                    $len++;
                }
                $receipt_id=$receipt_id . $count_st;
                $check = 0;
                $date = date("Y/m/d");
    
                $c1 = mysqli_query($link, "INSERT INTO receive_order(receipt_ID, date, depart_num, check_receive)
                                    VALUE('$receipt_id', '$date', '$depart_n', 0)");
                $c2 = mysqli_query($link, "INSERT INTO receive_amount(receipt_number, inventory_num, receive_amount)
                                    VALUE('$receipt_id', '$inventory_n', '$amo')");

                $resuit = mysqli_query($link, "SELECT inventory_amount FROM inventory WHERE inventory_num = '$inventory_n'");
                $total = mysqli_fetch_row($resuit)[0];
                $current = $total - $amo;
                if($current >= 0){$c3 = mysqli_query($link, "UPDATE inventory SET inventory_amount='$current' WHERE inventory_num='$inventory_n'");}
                //mysqli_close($link);
                if($c1 && $c2 && $c3){header("Location:build_receive_success.php");}
                else{header("Location:build_receive_fail.php");}
            }
        ?>
        <hr>
        <form method="post" action="index.php">
            <button>回首頁</button>
        </form>
    </body>
    <footer>
    </footer>
</html>