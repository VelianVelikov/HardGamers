<?
require "include/main.php";
dbconn();
loggedinorreturn();
if (get_user_class() < UC_ADMIN)
    stderr("Грешка", "Нямате нужните права.");
if ($HTTP_SERVER_VARS["REQUEST_METHOD"] == "POST") {
    if ($HTTP_POST_VARS["username"] == "" || $HTTP_POST_VARS["password"] == "" || $HTTP_POST_VARS["email"] == "")
        stderr("Грешка", "Липсва информация.");
    if ($HTTP_POST_VARS["password"] != $HTTP_POST_VARS["password2"])
        stderr("Грешка", "Паролите не съвпадата.");
    $username = sqlesc($HTTP_POST_VARS["username"]);
    $password = $HTTP_POST_VARS["password"];
    $email = sqlesc($HTTP_POST_VARS["email"]);
    $secret = mksecret();
    $passhash = sqlesc(md5($secret . $password . $secret));
    $secret = sqlesc($secret);

    mysql_query("INSERT INTO users (added, last_access, secret, username, passhash, status, email, class) VALUES(NOW(), NOW(), $secret, $username, $passhash, 'confirmed', $email, '1')") or sqlerr(__FILE__, __LINE__);
    $res = mysql_query("SELECT id FROM users WHERE username=$username");
    $arr = mysql_fetch_row($res);
    if (!$arr)
        stderr("Грешка", "Името изглежда е заето. Моля изберете друго");
    header("Location: member.php?id=$arr[0]");
    die;
}
stdhead("Добави потребител");

?>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">Добави потребител</font>
</div>
<center>
<form method=post action=dobavipotrebitel.php>

Потребител<br><input type=text name=username size=40><br/>
Парола<br><input type=password name=password size=40><br/>
Повтори паролата<br><input type=password name=password2 size=40><br/>
Email адрес<br><input type=text name=email size=40><br/><br/>
<input type=submit value="Добави потребител" class=btn><br/>

</form>
</center>
</div>
<?

stdfoot();
?>