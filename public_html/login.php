<?

require_once("include/main.php");

hit_start();

dbconn();

hit_count();
?>
<form method="post" action="takelogin.php">
���������� :<br><input type="text" size=42 name="username" />
������ :<br><input type="password" size=42 name="password" />

<p><center><input type="submit" value="���� !"></center></p>
</form>
<br><center>��� ��� �� ������ <a href="reg.php">������</a> ?!</center>
<?

hit_end();

?>
