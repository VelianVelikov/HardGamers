<?

require_once("include/main.php");

hit_start();

function bark($msg) {
    genbark($msg, "��������� ���������� �� �������!");
}

dbconn();

hit_count();

loggedinorreturn();

if (!mkglobal("email:chpassword:passagain"))
    bark("������ ����������");

$updateset = array();
$changedemail = 0;

if ($chpassword != "") {
    if (strlen($chpassword) > 40)
        bark("�������� � ��������� �����");
	if (strlen($chpassword) < 6)
        bark("�������� � ��������� ����");
    if ($chpassword != $passagain)
        bark("�������� �� ��������, ���� �������� ������");

    $sec = mksecret();

    $passhash = md5($sec . $chpassword . $sec);

    $updateset[] = "secret = " . sqlesc($sec);
    $updateset[] = "passhash = " . sqlesc($passhash);
    logincookie($CURUSER["id"], $passhash);
}

if ($email != $CURUSER["email"]) {
    if (!validemail($email))
        bark("���� � ��������� Email �����");
    $r = mysql_query("SELECT id FROM users WHERE email=" . sqlesc($email)) or sqlerr();
    if (mysql_num_rows($r) > 0)
        bark("���� �mail ����� - $email ���� �� ������.");
    $changedemail = 1;
}

$avatar = $_POST["avatar"];
$title = $_POST["title"];
$avatars = ($_POST["avatars"] != "" ? "yes" : "no");
$info = $_POST["info"];
$stylesheet = $_POST["stylesheet"];

$updateset[] = "info = " . sqlesc($info);
$updateset[] = "avatar = " . sqlesc($avatar);
$updateset[] = "title = " . sqlesc($title);
$updateset[] = "email = " . sqlesc($email);
$updateset[] = "avatars = '$avatars'";

$urladd = "";

mysql_query("UPDATE users SET " . implode(",", $updateset) . " WHERE id =" . $CURUSER["id"]) or sqlerr(__FILE__, __LINE__);

header("Location: $DEFAULTBASEURL/profile.php?edited=1" . $urladd);

hit_end();
?>
