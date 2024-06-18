<!DOCTYPE HTML>
<html>
	<head>
		<title>建立部門資料</title>
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
    <form method="post" action="index.php">
        <button>回首頁</button>
    </form>
    <hr>
    <form action="build_depart.php" method="post" autocomplete="off">
        <label>輸入新部門名稱</label>
        <input required type="text" name="input1" placeholder="XX部門" pattern="..+部門" autocomplete="off"><br>
        <input type="submit" value="送出">
		<input type="reset" value="取消">
    </form>

    <?php

        if(isset($_POST['input1'])){
           // $link = mysqli_connect( "localhost", "root", "","mydb");

            $result=mysqli_query($link, "select * from depart");
            $name=$_POST['input1'];
            $count = 1;
            $check = 0;
		    while($y=mysqli_fetch_row($result))
		    {
                if($y[0] == $name){
                    $check = 1;
                    break;
                }
		    	$count++;
            }
            
            if($check == 0){
                $id = "";
                if($count < 10){
                    $id = $id.'D0'.(string)$count;
                 }
                else{
                     $id = $id.'D'.(string)$count;
                }
                mysqli_query($link,"INSERT INTO depart(depart_name, depart_num)
                                VALUE('$name','$id')");
               // mysqli_close($link);
                header('Location:build_depart_success.php');
            }
            else{
                header('Location:build_depart_fail.php');
            }
        }
        
    ?>

    <h3>現有部門</h3>
		<table  width='200' border='4'>
		<tr>
		<td>部門名稱</td>
		<td>部門編號</td>
		</tr>
		<?php
		//$link = mysqli_connect( "localhost", "root", "","mydb");
		$result=mysqli_query($link, "select * from depart ORDER BY depart_num ASC");
		while($dep=mysqli_fetch_row($result)){
			echo"<tr>";
			echo"<td>$dep[0]</td>";
			echo"<td>$dep[1]</td>";
			echo"</tr>";
		}
		//mysqli_close($link);
		?>
    </body>
</html>