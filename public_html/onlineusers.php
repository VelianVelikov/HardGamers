<?php
require_once "include/main.php";
dbconn();

stdhead("Онлайн потребители");
loggedinorreturn();

$dt = gmtime() - 180;
$dt = sqlesc(get_date_time($dt));
$result = mysql_query("SELECT SUM(last_access >= $dt) AS totalol FROM users") or sqlerr(__FILE__, __LINE__);

while ($row = mysql_fetch_array($result)) {
    $totalonline = $row["totalol"];
}

$a = mysql_fetch_assoc(mysql_query("SELECT id,username FROM users WHERE status='confirmed' ORDER BY id DESC LIMIT 1")) or die(mysql_error());
if ($CURUSER)
    $latestuser = "<a href=member.php?id=" . $a["id"] . ">" . $a["username"] . "</a>";
else
    $latestuser = $a['username'];


$dt = gmtime() - 180;
$dt = sqlesc(get_date_time($dt));
$res = mysql_query("SELECT id, username, class FROM users WHERE last_access >= $dt ORDER BY username") or print(mysql_error());
while ($arr = mysql_fetch_assoc($res)) {
    if ($activeusers)
        $activeusers .= ",\n";
    switch ($arr["class"]) {
        case UC_ADMIN:
            $arr["username"] = "<font color=red>" . $arr["username"] . "</font>";
            break;
        case UC_MOD:
            $arr["username"] = "<font color=green>" . $arr["username"] . "</font>";
            break;
    }
    $activeusers .= "<nobr>";
    if ($CURUSER)
        $activeusers .= "<a href=member.php?id=" . $arr["id"] . "><b>" . $arr["username"] . "</b></a>";
    else
        $activeusers .= "<b>$arr[username]</b>";
}
if (!$activeusers)
    $activeusers = "Не е имало активни потребители през последните 15 минути.";
?>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">Онлайн потребители</font>
</div>
<div class="error">
<center>
&nbsp;На линия : <?= $totalonline ?> <?= $totalonline == (int) 1 ? "човек" : "човека" ?> 
<br><br>
&nbsp;<?= $activeusers ?><br>    
<br>
&nbsp;Най-нов : <b><?= $latestuser ?></b>.<br>
</center>
</div>
</div>
<?
stdfoot();
?>