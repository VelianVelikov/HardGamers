<?
require "include/main.php";
dbconn();
loggedinorreturn();
if (get_user_class() < UC_ADMIN)
    stderr("������", "������ ������� �����.");
if ($HTTP_SERVER_VARS["REQUEST_METHOD"] == "POST") {
    if ($HTTP_POST_VARS["username"] == "" || $HTTP_POST_VARS["password"] == "" || $HTTP_POST_VARS["email"] == "")
        stderr("������", "������ ����������.");
    if ($HTTP_POST_VARS["password"] != $HTTP_POST_VARS["password2"])
        stderr("������", "�������� �� ���������.");
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
        stderr("������", "����� �������� � �����. ���� �������� �����");
    header("Location: member.php?id=$arr[0]");
    die;
}
stdhead("������ ����������");

?>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">������ ����������</font>
</div>
<center>
<form method=post action=dobavipotrebitel.php>

����������<br><input type=text name=username size=40><br/>
������<br><input type=password name=password size=40><br/>
������� ��������<br><input type=password name=password2 size=40><br/>
Email �����<br><input type=text name=email size=40><br/><br/>
<input type=submit value="������ ����������" class=btn><br/>

</form>
</center>
</div>
<?

stdfoot();
?>