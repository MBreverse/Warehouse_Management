<!DOCTYPE html>
<html>
    <head>
        <title>存放庫存</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
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
            $i=0;
            while($a=$_POST["spaceClass".$i])
            {
                error_reporting(0);
                $b=$_POST["Compart".$i];
                $c=$_POST["Status".$i];
                $query="UPDATE space SET state='".$c."' WHERE space_class='".$a."' AND space_num='".$b."'";
                $rs=mysqli_query($link,$query);
                $i++;
            }
        
            $inc_id=$_POST["ID"];
            $query="UPDATE incoming SET incoming_check='1' WHERE incoming.incoming_ID='$inc_id'";
            $rs=mysqli_query($link,$query);
 
      
            $query1="SELECT incoming.inventory_num,incoming_amount,inventory_amount 
            FROM incoming,inventory 
            WHERE (incoming.incoming_ID='$inc_id' AND inventory.inventory_num=incoming.inventory_num)";
            $result=mysqli_query($link,$query1);
            $rs1=mysqli_fetch_row($result);
            
            $adder1=$rs1[1];
            settype($adder1,"int");

            $adder2=$rs1[2];
            settype($adder2,"int");
            $total=$adder1+$adder2;
          
     
            $query="UPDATE inventory SET inventory_amount='$total' WHERE inventory.inventory_num='$rs1[0]'";
            $rs2=mysqli_query($link,$query);
        ?>

        <h1>存放庫存完成!</h1>
        <form method="post" action="find_storing_space1.php">
            <button>回入庫品頁面</button>
        </form>
    </body>
</html>