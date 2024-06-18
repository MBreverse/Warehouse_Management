<!doctype html>
<html>
<?php
$a="0";
echo settype($a,"integer");
echo $a;
?>
<form action='test.php' method='post'>

    <input type="hidden" name="foo[]" value="bar">
    <input type="hidden" name="foo[]" value="baz">

<input type='submit'>sent
</form>
</html>