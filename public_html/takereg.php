<?

require_once("include/main.php");

hit_start();

dbconn();

if ($maxusers == "yes") 
print ("<center><font size=5>������</font><br/><font size=3 color=red>������������� �� �������� ������</font></center>");


if (!mkglobal("wantusername:wantpassword:passagain:email"))
    die();

function bark($msg) {
    stdhead();
    stdmsg("��������� �����������!", $msg);
    stdfoot();
    exit;
}

function validusername($username) {
    if ($username == "")
        return false;

    $allowedchars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    for ($i = 0; $i < strlen($username); ++$i)
        if (strpos($allowedchars, $username[$i]) === false)
            return false;

    return true;
}

if (empty($wantusername) || empty($wantpassword) || empty($email))
    bark("���� ��������� ������ ������");

if (strlen($wantusername) > 12)
    bark("��������������� ��� �� ������ �� � ��-����� �� 12 �������");

if ($wantpassword != $passagain)
    bark("�������� �� ���������");

if (strlen($wantpassword) < 6)
    bark("�������� � ��������� ����");

if (strlen($wantpassword) > 40)
    bark("�������� � ��������� �����");

if ($wantpassword == $wantusername)
    bark("�������� �� ���� �� � ������ ���� ��������������� ���");

if (!validemail($email))
    bark("��������� �mail �����.");

if (!validusername($wantusername))
    bark("��������� ������������� ���.");

if ($_POST["rule1"] != "yes" || $_POST["rule2"] != "yes") 
    stderr("������", "��� �� ���������� �� ������������ � �� ���� �� ������� ���� �� �����.");


$a = (mysql_fetch_row(mysql_query("select count(*) from users where email='$email'"))) or die(mysql_error());
if ($a[0] != 0)
    bark("���� �mail ����� - $email ���� �� ������ �� ���� ����������.");

hit_count();

$secret = mksecret();
$wantpasshash = md5($secret . $wantpassword . $secret);
$editsecret = mksecret();

$ruser = mysql_query("SELECT * FROM users");
$rowruser = mysql_num_rows($ruser);
if ($rowruser == 0) {
    $ret = mysql_query("INSERT INTO users (username, passhash, secret, editsecret, email, status, class, added) VALUES (" .
            implode(",", array_map("sqlesc", array($wantusername, $wantpasshash, $secret, $editsecret, $email, 'confirmed', 4))) .
            ",'" . get_date_time() . "')");
} elseif ($rowruser > 0) {

    $ret = mysql_query("INSERT INTO users (username, passhash, secret, editsecret, email, status, class, added) VALUES (" .
            implode(",", array_map("sqlesc", array($wantusername, $wantpasshash, $secret, $editsecret, $email, 'confirmed', 1))) .
            ",'" . get_date_time() . "')");
}

if (!$ret) {
    if (mysql_errno() == 1062)
        bark("��������������� ��� ���� ����������!");
    bark("������");
}

$id = mysql_insert_id();

write_log("���������� � id = $id � ��� = $wantusername �� ��������");

header("Refresh: 0; url=ok.php?type=confirmed");

hit_end();
?>