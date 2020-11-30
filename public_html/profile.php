<?
require_once("include/main.php");

hit_start();

dbconn(false);

hit_count();

loggedinorreturn();
$res = mysql_query("SELECT COUNT(*) FROM messages WHERE receiver=" . $CURUSER["id"] . " AND location IN ('in', 'both')") or print(mysql_error());
$arr = mysql_fetch_row($res);
$messages = $arr[0];
$res = mysql_query("SELECT COUNT(*) FROM messages WHERE receiver=" . $CURUSER["id"] . " AND location IN ('in', 'both') AND unread='yes'") or print(mysql_error());
$arr = mysql_fetch_row($res);
$unread = $arr[0];
$res = mysql_query("SELECT COUNT(*) FROM messages WHERE sender=" . $CURUSER["id"] . " AND location IN ('out', 'both')") or print(mysql_error());
$arr = mysql_fetch_row($res);
$outmessages = $arr[0];


stdhead("Профил на " . $CURUSER["username"], false);
?>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">
<?     print("<font size=5>Профил на $CURUSER[username]</font>\n"); ?>
</font>
</div>
<center>
<?
if ($_GET["edited"]) {
    print("<font size=2 color=green><b>Профилът Ви бе обновен !</font></b>\n");
}else 
?>
<br/>
<form method="post" action="takeprofedit.php">
<?
tr2("Аватар", "<input name=avatar size=70 value=\"" . htmlspecialchars($CURUSER["avatar"]) . "\"><br>Забранени са аватари с размери по-големи от 150х150<br/>", 1);
tr2("Име", "<input name=title size=70 value=\"" . htmlspecialchars($CURUSER["title"]) . "\"><br>", 1);
tr2("Информация за вас", "<script>edToolbar('infoMe'); </script><textarea name=info cols=70 rows=7 id=infoMe class=bb_ed>" . $CURUSER["info"] . "</textarea><br/>", 1);
tr2("Email адрес", "<input type=\"text\" name=\"email\" size=70 value=\"" . htmlspecialchars($CURUSER["email"]) . "\" />", 1);
tr2("<br/>Смени Парола", "<input type=\"password\" name=\"chpassword\" size=\"70\" />", 1);
tr2("<br/>Повтори Паролата", "<input type=\"password\" name=\"passagain\" size=\"70\" />", 1);
?>
        <br/>
		<br/><input type="submit" value="Обнови !" style='height: 25px'> <input type="reset" value="Анулирай промените!" style='height: 25px'>

</form>
</center>
</div>
<?
stdfoot();

hit_end();
?>
