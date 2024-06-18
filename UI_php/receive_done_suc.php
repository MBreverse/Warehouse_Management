<!DOCTYPE html>
<html>
    <head>
        <title>領取確認成功</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
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
        $i=0;
        while($a=$_POST["spaceClass".$i])
        {
            error_reporting(0);
            $b=$_POST["Compart".$i];
            $c=$_POST["Status".$i];
            $query="UPDATE space SET state='".$c."' WHERE space_class='".$a."' AND space_num='".$b."'";
            $result=mysqli_query($link,$query);
            $i++;
        }
        $receipt=$_POST["rec"];

        if(empty($receipt)){
            echo "empty";
        }
        $query="UPDATE receive_order SET check_receive='1' WHERE receipt_ID='".$receipt."'";
        $result1=mysqli_query($link,$query);
        //mysqli_close($link);
    ?>
    <h1>領取確認成功!</h1>
    <P>
    <form method="post" action="find_invent_space1.php">
        <button>回領料單頁面</button>
    </form>
    </body>
</html>