<?

require "include/main.php";
dbconn(false);
loggedinorreturn();
stdhead("������� �����", false);
$res = mysql_query("SELECT * FROM messages WHERE receiver=" . $CURUSER["id"] . " AND location IN ('in','both') ORDER BY added DESC LIMIT 0,20") or die("������!");
		?>
	<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
	<font size="5">������� ���������</font>
	</div>
	<?
if (mysql_num_rows($res) == 0)
 print ("<div class=error><center>����� ������� ���������</center></div>");
	
else
    while ($arr = mysql_fetch_assoc($res)) {
        if (is_valid_id($arr["sender"])) {

            $res2 = mysql_query("SELECT username, avatar FROM users WHERE id=" . $arr["sender"]) or sqlerr();
            $arr2 = mysql_fetch_assoc($res2);
            $sender = "<a href=member.php?id=" . $arr["sender"] . ">" . ($arr2["username"] ? $arr2["username"] : "[������]") . "</a>";
        }
        else
            $sender = "���������";
        $elapsed = get_elapsed_time(sql_timestamp_to_unix_timestamp($arr["added"]));
		if ($arr2['avatar'] == "")
			print("<table><tr><td width=80 valign=top><img src=pic/noavatar.jpg width=80 style=position: absolute></td>\n");
		else	{
			print("<table><tr><td width=80 valign=top><img src=$arr2[avatar] width=80 style=position: absolute></td>\n");
		}
        print("<td>�� <b>$sender</b> ��\n" . $arr["added"] . " (����� $elapsed)\n<br/><br/>");
        if ($arr["unread"] == "yes") {
            print("[ <font color=red>���� !</font> ]");
            mysql_query("UPDATE messages SET unread='false' WHERE id=" . $arr["id"]) or die("arghh");
        }
        print(format_comment($arr["msg"]));
        print("</td></tr></table>
		<table width=100%  border=0><hr/>\n");
        print(($arr["sender"] ? "<a href=pms.php?receiver=" . $arr["sender"] . "&replyto=" . $arr["id"] .
                        "><b>��������</b></a>" : "<font class=gray><b>��������</b></font>") .
                " | <a href=deletemessage.php?id=" . $arr["id"] . "&type=in><b>������</b></a>\n");

        print("</table><br/>\n");
    }
?>
</div>
<?
stdfoot();
?>