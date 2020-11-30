<?

require_once("include/main.php");

hit_start();

dbconn();
stdhead();
hit_count();
?>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">Трябва да се логнете</font>
</div>
<center>
<form method="post" action="takelogin.php">
Потребител :<br><input type="text" size=42 name="username" /><br>
Парола :<br><input type="password" size=42 name="password" /><br/>
<p><input type="submit" value="Вход !"></p>
</form>
<br>Все още ли нямате <a href="reg.php">Акаунт</a> ?!
</center>
</div>
<?
stdfoot();
hit_end();

?>
