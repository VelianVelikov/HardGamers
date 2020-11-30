<?
require "include/main.php";

dbconn(false);

loggedinorreturn();

if (get_user_class() < UC_MOD)
    die;

$remove = $HTTP_GET_VARS['remove'];
if (is_valid_id($remove)) {
    mysql_query("DELETE FROM bans WHERE id=$remove") or sqlerr();
    write_log("Бан с номер : $remove бе премахнат от потребител с id $CURUSER[id] ($CURUSER[username])");
}

if ($HTTP_SERVER_VARS["REQUEST_METHOD"] == "POST" && get_user_class() >= UC_ADMIN) {
    $first = trim($_POST["first"]);
    $last = trim($_POST["last"]);
    $comment = trim($_POST["comment"]);
    if (!$first || !$last || !$comment)
        stderr("Грешка", "Попълнете всички полета.");
    $first = ip2long($first);
    $last = ip2long($last);
    if ($first == -1 || $last == -1)
        stderr("Грешка", "Невалиден IP адрес.");
    $comment = sqlesc($comment);
    $added = sqlesc(get_date_time());
    mysql_query("INSERT INTO bans (added, addedby, first, last, comment) VALUES($added, $CURUSER[id], $first, $last, $comment)") or sqlerr(__FILE__, __LINE__);
    header("Location: $HTTP_SERVER_VARS[REQUEST_URI]");
    die;
}

ob_start("ob_gzhandler");

$res = mysql_query("SELECT * FROM bans ORDER BY added DESC") or sqlerr();

stdhead("Банове");
?>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">Банове</font>
</div><center>
<h2>Активни банове</h2>
<?
if (mysql_num_rows($res) == 0)
    print("<b>Няма активни банове в момента</b>\n");
else {
    print("<table border=1 cellspacing=0 cellpadding=5 width=100%>\n");
    print("<tr><td class=colhead>Добавен</td><td class=colhead align=left>IP #1</td><td class=colhead align=left>IP #2</td>" .
            "<td class=colhead align=left>Добавил</td><td class=colhead align=left>Причина</td>\n");
    if(get_user_class() >= UC_ADMIN) {
            print("<td class=colhead align=center><b>X</b></td></tr>");
        } else {
            print("</tr>");
        }

    while ($arr = mysql_fetch_assoc($res)) {
        $r2 = mysql_query("SELECT username FROM users WHERE id=$arr[addedby]") or sqlerr();
        $a2 = mysql_fetch_assoc($r2);
        $arr["first"] = long2ip($arr["first"]);
        $arr["last"] = long2ip($arr["last"]);
        print("<tr><td>$arr[added]</td><td align=left>$arr[first]</td><td align=left>$arr[last]</td><td align=left><a href=member.php?id=$arr[addedby]>$a2[username]" .
                "</a></td><td align=left>$arr[comment]</td>\n");
        if(get_user_class() >= UC_ADMIN) {
            print("<td><a href=banove.php?remove=$arr[id]>Изтрий</a></td></tr>");
        } else {
            print("</tr>");
        }
    }
    print("</table>\n");
}
//echo "<br>";

if (get_user_class() >= UC_MOD) {
    print("<h2>Добави бан</h2>\n");
    print("<form method=post action=banove.php>\n");
    print("IP #1<br><input type=text name=first size=40><br/>\n");
    print("IP #2<br><input type=text name=last size=40>\n");
    print("<br/>Кратка причина<br><input type=text name=comment size=40>\n");
    print("<br/><input type=submit value='Банни' class=btn>\n");
    print("</form>\n\n");

    ?>
	<center><h2>FAQ</h2></center>
    <div style="width:500px;">
			<b>Въпрос : Защо е нужно да въвеждам 2 IP-та - едно не стига ли ?</b>
            <br>
            Отговор : Не, не стига. Нужни са 2 IP-та за да може да определим точната мрежа която ползва дадения потребител и да може
            следващия път когато се опита да влезе, да преценим в какъв обхват е тази мрежа и да забраним нейния достъп.<br/><br/>
        	<b>Въпрос : Няма ли да банна много потребители ако банвам цяла мрежа?</b>
            <br>
            Отговор : Не, няма. Системата определя самия потребител в кой обсег е и банва последните IP-та които той е ползвал.
    </div>
    <?php
}
?>
</center></div>
<?
stdfoot();
?>