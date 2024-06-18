<!DOCTYPE HTML>
<html>
	<head>
		<title>建立倉庫空間</title>
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
	<p>選擇要增加的空間類別，並輸入空間代號:</p>
	<p> A代表包材 /  B代表原料  / C代表容器  / D帶表成品 /E代表半成品</p>
		<p>
		<form action="build_space.php" method="post" autocomplete="off">
		<p>
		<label><b>類別: </b></label>
		<select name="input1">
			<option value="A">A</option>
			<option value="B">B</option>
			<option value="C">C</option>
			<option value="D">D</option>
			<option value="E">E</option>
		</select>
		</p>
		<p><b>建置數量: </b>
		<input required type="value" name="input2" max='99' min='1' autocomplete="off"></p><br>
		<input type="submit" value="送出">
		<input type="reset" value="取消">
		</form>
		</P>
		<?php
			if(!isset($_POST['input1']) or !isset($_POST['input2'])){
				echo '';
			}
			else{
				$class=$_POST["input1"];
				$amount=$_POST['input2'];
				
				//$link = mysqli_connect( "localhost","root","","mydb");
				$x = mysqli_query($link,"select space_num from space where space_class='$class'");//根據輸入的類別取得表單
				$all_space_ID = mysqli_query($link,"select space_ID from space");//取得表單
				
				$count_class = 1;
				$count_all = 1;
				while($y=mysqli_fetch_row($x)) //計算目前要插入的類別已經有多少個隔間了
				{
					$count_class++;
				}
				while($y=mysqli_fetch_row($all_space_ID)) //計算目前整個倉庫有多少個隔間
				{
					$count_all++;
				}
				
				$x = 0;
				while($amount>0){
					$count_class_st = $count_class;
					if($count_class < 10){(string)$count_class_st = '0'.(string)$count_class_st;}
					else{(string)$count_class_st = (string)$count_class_st;}

					$num = "WH";
					$count_all_st = $count_all;
					(string)$count_all_st = (string)$count_all_st;
					$len = strlen($count_all_st);
					while(3 - $len > 0)
					{
						$num .= '0';
						$len++;
					}
					$num .= $count_all;

					$x=mysqli_query($link,"INSERT INTO space(space_ID,space_class,space_num,state)
										VALUE('$num','$class','$count_class_st',0)");

					$count_class++;
					$count_all++;
					$amount--;
				}
				if($x){header("Location:build_space_success.php");}
				else{header("Location:build_space_fail.php");}
				//mysqli_close($link);
			}
		?>

		<h3>現有倉庫空間表</h3>
		<table  width='200' border='4'>
		<tr>
		<td>庫別</td>
		<td>編號</td>
		<td>空間代碼</td>
		</tr>
		<?php


		$result=mysqli_query($link, "select space_class , space_num , space_ID from space where space_class='A' ORDER BY space_num ASC");
		
		while($space=mysqli_fetch_row($result)){
			echo"<tr>";
			echo"<td>$space[0]</td>";
			echo"<td>$space[1]</td>";
			echo"<td>$space[2]</td>";
			echo"</tr>";
		}
		//mysqli_close($link);
		?>

		<table  width='200' border='4'>
		<tr>
		<td>庫別</td>
		<td>編號</td>
		<td>空間代碼</td>
		</tr>
		<?php
	
		echo '<br>', '<br>';

		$result=mysqli_query($link, "select space_class , space_num , space_ID from space where space_class='B' ORDER BY space_num ASC");
		
		while($space=mysqli_fetch_row($result)){
			echo"<tr>";
			echo"<td>$space[0]</td>";
			echo"<td>$space[1]</td>";
			echo"<td>$space[2]</td>";
			echo"</tr>";
		}
		//mysqli_close($link);
		?>

		<table  width='200' border='4'>
		<tr>
		<td>庫別</td>
		<td>編號</td>
		<td>空間代碼</td>
		</tr>
		<?php
	
		echo '<br>', '<br>';

		$result=mysqli_query($link, "select space_class , space_num , space_ID from space where space_class='C' ORDER BY space_num ASC");
		
		while($space=mysqli_fetch_row($result)){
			echo"<tr>";
			echo"<td>$space[0]</td>";
			echo"<td>$space[1]</td>";
			echo"<td>$space[2]</td>";
			echo"</tr>";
		}
		//mysqli_close($link);
		?>

		<table  width='200' border='4'>
		<tr>
		<td>庫別</td>
		<td>編號</td>
		<td>空間代碼</td>
		</tr>
		<?php
		
	
		echo '<br>', '<br>';

		$result=mysqli_query($link, "select space_class , space_num , space_ID from space where space_class='D' ORDER BY space_num ASC");
		
		while($space=mysqli_fetch_row($result)){
			echo"<tr>";
			echo"<td>$space[0]</td>";
			echo"<td>$space[1]</td>";
			echo"<td>$space[2]</td>";
			echo"</tr>";
		}
		//mysqli_close($link);
		?>

		<table  width='200' border='4'>
		<tr>
		<td>庫別</td>
		<td>編號</td>
		<td>空間代碼</td>
		</tr>
		<?php
		echo '<br>', '<br>';

		$result=mysqli_query($link, "select space_class , space_num , space_ID from space where space_class='E' ORDER BY space_num ASC");
		
		while($space=mysqli_fetch_row($result)){
			echo"<tr>";
			echo"<td>$space[0]</td>";
			echo"<td>$space[1]</td>";
			echo"<td>$space[2]</td>";
			echo"</tr>";
		}
		//mysqli_close($link);
		?>
	</body>
	<footer>
	</footer>
</html>