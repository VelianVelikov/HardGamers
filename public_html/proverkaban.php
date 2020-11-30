<?
require "include/main.php";
dbconn();
loggedinorreturn();
if (get_user_class() < UC_MOD)
    stderr("Грешка", "Достъпът отказан");

if ($_SERVER["REQUEST_METHOD"] == "POST")
    $ip = $_POST["ip"];
else
    $ip = $_GET["ip"];
if ($ip) {
    $nip = ip2long($ip);
    if ($nip == -1)
        stderr("Грешка", "Невалидно IP.");
    $res = mysql_query("SELECT * FROM bans WHERE $nip >= first AND $nip <= last") or sqlerr(__FILE__, __LINE__);
    if (mysql_num_rows($res) == 0)
        stderr("Резултат", "IP адресът <b>$ip</b> не е баннът.");
    else {
        $banstable = "<table class=main border=0 cellspacing=0 cellpadding=5>\n" .
                "<tr><td class=colhead>IP #1</td><td class=colhead>IP #2</td><td class=colhead>Причина</td></tr>\n";
        while ($arr = mysql_fetch_assoc($res)) {
            $first = long2ip($arr["first"]);
            $last = long2ip($arr["last"]);
            $comment = htmlspecialchars($arr["comment"]);
            $banstable .= "<tr><td>$first</td><td>$last</td><td>$comment</td></tr>\n";
        }
        $banstable .= "</table>\n";
        stderr("Резултат", "<table border=0 cellspacing=0 cellpadding=0><tr><td class=embedded style='padding-right: 5px'><img src=pic/smilies/excl.gif></td><td class=embedded>IP адресът <b>$ip</b> е баннът:</td></tr></table><p>$banstable</p>");
    }
}
stdhead("Провери IP Адрес");

?>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">Провери IP Адрес</font>
</div>
<div class=error>
<center>
<form method=post action=proverkaban.php>
IP адрес<br><input type=text name=ip><br>
<input type=submit class=btn value='Провери'>
</form>
</center>
</div>
</div>
<?

stdfoot();
?>