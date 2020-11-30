<?

require_once("include/main.php");

hit_start();

dbconn();

hit_count();
?>
<form method="post" action="takelogin.php">
Потребител :<br><input type="text" size=42 name="username" />
Парола :<br><input type="password" size=42 name="password" />

<p><center><input type="submit" value="Вход !"></center></p>
</form>
<br><center>Все още ли нямате <a href="reg.php">Акаунт</a> ?!</center>
<?

hit_end();

?>
