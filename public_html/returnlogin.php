<?

require_once("include/main.php");

hit_start();

dbconn();
stdhead();
hit_count();
?>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">������ �� �� �������</font>
</div>
<center>
<form method="post" action="takelogin.php">
���������� :<br><input type="text" size=42 name="username" /><br>
������ :<br><input type="password" size=42 name="password" /><br/>
<p><input type="submit" value="���� !"></p>
</form>
<br>��� ��� �� ������ <a href="reg.php">������</a> ?!
</center>
</div>
<?
stdfoot();
hit_end();

?>
