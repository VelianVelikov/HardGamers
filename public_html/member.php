<?
require "include/main.php";

dbconn(false);

loggedinorreturn();

function bark($msg) {
    stdhead();
    stdmsg("������", $msg);
    stdfoot();
    exit;
}

$id = $_GET["id"];

if (!is_valid_id($id))
    bark("��������� id $id.");

$r = mysql_query("SELECT * FROM users WHERE id=$id") or sqlerr();
$user = mysql_fetch_array($r) or bark("���� ���������� � ID $id.");
if ($user["status"] == "pending")
    die;


if ($user["ip"] && (get_user_class() >= UC_MOD || $user["id"] == $CURUSER["id"])) {
    $ip = $user["ip"];
    $dom = @gethostbyaddr($user["ip"]);
    if ($dom == $user["ip"] || @gethostbyname($dom) != $user["ip"])
        $addr = $ip;
    else {
        $dom = strtoupper($dom);
        $domparts = explode(".", $dom);
        $domain = $domparts[count($domparts) - 2];
        if ($domain == "COM" || $domain == "CO" || $domain == "NET" || $domain == "NE" || $domain == "ORG" || $domain == "OR")
            $l = 2;
        else
            $l = 1;
        $addr = "$ip ($dom)";
    }
}
if ($user[added] == "0000-00-00 00:00:00")
    $joindate = '������������';
else
    $joindate = "$user[added] (����� " . get_elapsed_time(sql_timestamp_to_unix_timestamp($user["added"])) . ")";
$lastseen = $user["last_access"];
if ($lastseen == "0000-00-00 00:00:00")
    $lastseen = "������";
else {
    $lastseen .= " (����� " . get_elapsed_time(sql_timestamp_to_unix_timestamp($lastseen)) . ")";
}

stdhead("���������� �� " . $user["username"]);
$enabled = $user["enabled"] == 'yes';
?>
<div class="blog_part_left_table">
<table width=100% cellspacing=0 cellpadding=5>
<div class="gamepad_ico"></div><div class="blog_part_left_table_smallheader">
<font size="5">
<?     print("<font size=5>������ �� $user[username]</font>\n"); ?>
</font>
</div>
<?
if (!$enabled && get_user_class() < UC_MOD )
    print("<div class=error_profile><center><b>���� ������ � �������� �� �������������</b>\n");
else {


begin_main_frame();
?>

    <? if ($user["avatar"]) { ?>    
        <tr><td rowspan="10" valign="top" align="center" style="padding:5px; margin:0px;" width="130"><img src=<? echo htmlspecialchars($user["avatar"]); ?> width="128" style="border:1px solid #111; background:#ccc;"><br>
    <? } else { ?><tr><td rowspan="10" valign="top" align="center" style="padding:5px; margin:0px;" width="130"><img src="pic/noavatar.jpg" width="128" style="border:1px solid #111; background:#ccc;"><br><?php
}
if ($CURUSER["id"] != $user["id"])
    $showpmbutton = 1;
if ($showpmbutton)
    print("<br><a href=pms.php?receiver=" . $user["id"] . "><img src=pic/pm.png border=0></a></td></tr>");
    ?> 
    <tr><td><b>�����������&nbsp;��</b><br><?= $joindate ?></td></tr>
    <tr><td><b>��������&nbsp;������&nbsp;</b><br><?= $lastseen ?></td></tr>
    <?
    if (get_user_class() >= UC_MOD){
        print("<tr><td><b>Email</b><br><a href=mailto:$user[email]>$user[email]</a></td></tr>\n");
		if ($addr)
        print("<tr><td><b>IP �����</b><br>$addr</td></tr>\n");
	}
    $UC = array("�������������" => "pic/rangove/administrator.png",
        "���������" => "pic/rangove/moderator.png",
        "VIP" => "pic/rangove/vip.png",
        "����������" => "pic/rangove/potrebitel.png");
$uclass = $UC[get_user_class_name($user["class"])];
$warneduntil = $user['warneduntil'];
    if($user['warned'] == yes) {
    print("<tr><td><img src=$uclass><hr><font color=red>����������� � ����������� �� <font color=black>$warneduntil</font></font></td></tr>\n");
    } else {
      print("<tr><td><b>���</b><br><img src=$uclass></td></tr>\n");  
    }

    if ($user["title"]) {
        print("<tr><td><b>���</b><br>" . $user["title"] . "</td></tr>\n");
    }


    if ($user["info"])
        print("<tr valign=top><td align=left colspan=2><b>�� ���</b><br>" . format_comment($user["info"]) . "</td></tr>\n");

    if (get_user_class() >= UC_MOD && $CURUSER["id"] != $user["id"] && $user["class"] < get_user_class()) {
        print("<tr><td><a href=\"javascript:ShowHide('edituser')\"><img src=pic/redaktirai.png border=0></a></td></tr>");
    }
            end_main_frame();
    ?><br><?php
    begin_main_frame();
    //���������� �����������
    if (get_user_class() >= UC_MOD && $user["class"] < get_user_class()) {
        ?><div id='edituser' style="display: none;"><?php
    print("<form method=post action=dousers.php>\n");
    print("<input type=hidden name='action' value='edituser'>\n");
    print("<input type=hidden name='userid' value='$id'>\n");
    print("<table class=main align=center cellspacing=0 width=100% cellpadding=5>\n");
    print("<input type=hidden name='returnto' value='member.php?id=$id'>\n");
    print("<tr><td colspan=3 class=heading>���<br><input type=text size=60 name=title value=\"" . htmlspecialchars($user[title]) . "\"></tr>\n");
    $avatar = htmlspecialchars($user["avatar"]);
    print("<tr><td colspan=3 class=heading>������<br><input type=text size=60 name=avatar value=\"$avatar\"></tr>\n");

    if (get_user_class() == UC_MOD && $user["class"] > UC_VIP)
        printf("<input type=hidden name=class value=$user[class]\n");
    else {
        print("<tr><td colspan=3 class=heading>���<br><select name=class>\n");
        if (get_user_class() == UC_MOD)
            $maxclass = UC_VIP;
        else
            $maxclass = get_user_class() - 1;
        for ($i = 0; $i <= $maxclass; ++$i)
            print("<option value=$i" . ($user["class"] == $i ? " selected" : "") . ">$prefix" . get_user_class_name($i) . "\n");
        print("</select></td></tr>\n");
    }


    $warned = $user["warned"] == "yes";
    print("<tr><td class=heading colspan=3>�����������</td></tr>");
    print("<tr><td>" .
            ( $warned ? "<input name=warned value='yes' type=radio checked><b>��</b>&nbsp;<input name=warned value='no' type=radio><b>��</b>" : "<b>��</b>" ) . "");

    if ($warned) {
        $warneduntil = $user['warneduntil'];
        if ($warneduntil == '0000-00-00 00:00:00')
            print("<br>�� ������������ �����\n");
        else {
            print("<br>�� $warneduntil");
            print(" (������� " . mkprettytime(strtotime($warneduntil) - gmtime()) . ")\n");
        }
    } else {
        print("<br>����������� �� <select name=warnlength>\n");
        print("<option value=0>------</option>\n");
        print("<option value=1>1 �������</option>\n");
        print("<option value=2>2 �������</option>\n");
        print("<option value=4>4 �������</option>\n");
        print("<option value=8>8 �������</option>\n");
        print("<option value=255>������������</option>\n");
        print("</select><br>������� :<br>\n");
        print("<input type=text size=60 name=warnpm style='margin-left:0px;'></td></tr>");
    }

    print("<tr><td colspan=3 class=heading>������<br><input name=enabled value='yes' type=radio" . ($enabled ? " checked" : "") . ">�� <input name=enabled value='no' type=radio" . (!$enabled ? " checked" : "") . ">��</td></tr>\n");
    print("</td></tr>");
    print("<tr><td colspan=3 align=center><input type=submit class=btn value='����� !'></td></tr>\n");
    print("</table>\n");
    print("</form>\n");
        ?></div><?php
}
}
?>
</table>
</div>
<?
end_main_frame();
stdfoot();
    ?>
