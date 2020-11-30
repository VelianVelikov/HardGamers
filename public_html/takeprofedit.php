<?

require_once("include/main.php");

hit_start();

function bark($msg) {
    genbark($msg, "Неуспешно ъпдейтване на профила!");
}

dbconn();

hit_count();

loggedinorreturn();

if (!mkglobal("email:chpassword:passagain"))
    bark("липсва информация");

$updateset = array();
$changedemail = 0;

if ($chpassword != "") {
    if (strlen($chpassword) > 40)
        bark("Паролата е прекалено дълга");
	if (strlen($chpassword) < 6)
        bark("Паролата е прекалено къса");
    if ($chpassword != $passagain)
        bark("Паролите не съвпадат, моля опитайте отново");

    $sec = mksecret();

    $passhash = md5($sec . $chpassword . $sec);

    $updateset[] = "secret = " . sqlesc($sec);
    $updateset[] = "passhash = " . sqlesc($passhash);
    logincookie($CURUSER["id"], $passhash);
}

if ($email != $CURUSER["email"]) {
    if (!validemail($email))
        bark("Това е невалиден Email адрес");
    $r = mysql_query("SELECT id FROM users WHERE email=" . sqlesc($email)) or sqlerr();
    if (mysql_num_rows($r) > 0)
        bark("Този Еmail адрес - $email вече се ползва.");
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
