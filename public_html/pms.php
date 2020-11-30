<?php
require "include/main.php";
dbconn(false);
loggedinorreturn();

$receiver = $_GET["receiver"];
if (!is_valid_id($receiver))
    die;

$replyto = $_GET["replyto"];
if ($replyto && !is_valid_id($replyto))
    die;

$res = mysql_query("SELECT * FROM users WHERE id=$receiver") or die(mysql_error());
$user = mysql_fetch_assoc($res);
if (!$user)
	genbark("Няма потребител с такова ID.", "Грешка");

if ($replyto) {
    $res = mysql_query("SELECT * FROM messages WHERE id=$replyto") or sqlerr();
    $msga = mysql_fetch_assoc($res);
    if ($msga["receiver"] != $CURUSER["id"])
        die;
    $res = mysql_query("SELECT username FROM users WHERE id=" . $msga["sender"]) or sqlerr();
    $usra = mysql_fetch_assoc($res);
    $body .= ">>> $usra[username] написа : --------\n$msga[msg]\n>>> Край на съобщението от $usra[username]";
}
stdhead("Лично съобщение до " . $user[username], false);
?>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">Лично съобщение до <? print ("" . $user[username]);?></font>
</div>

            <div align="center">
                <form method="post" action="takepms.php">
                    <? if ($_GET["returnto"] || $_SERVER["HTTP_REFERER"]) { ?>
                        <input type=hidden name=returnto value=<?= $_GET["returnto"] ? $_GET["returnto"] : $_SERVER["HTTP_REFERER"] ?>>
                    <? } ?>
					<script>edToolbar('pms'); </script>
                        <tr><td style="border:none;" align="center"><textarea name="msg" cols="70" rows="7" id="pms" class="bb_ed" maxlength="500" onkeyup="countChar(this)"><?= $body ?></textarea><br/><div id="charNum"></div>
                                <br><input type="submit" value="Изпрати !"></td></tr>
                    <input type="hidden" name="receiver" value="<?= $receiver ?>">
                    <input type="hidden" name='delete' value='yes'></td>
                </form>
            </div></td></tr></table></div>
<?
stdfoot();
?>