<?

require_once("include/main.php");

hit_start();

dbconn();

if ($maxusers == "yes") 
print ("<center><font size=5>Грешка</font><br/><font size=3 color=red>Регистрациите са временно спрени</font></center>");


if (!mkglobal("wantusername:wantpassword:passagain:email"))
    die();

function bark($msg) {
    stdhead();
    stdmsg("Неуспешна регистрация!", $msg);
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
    bark("Моля попълнете всички полета");

if (strlen($wantusername) > 12)
    bark("Потребителското име не трябва да е по-дълго от 12 символа");

if ($wantpassword != $passagain)
    bark("Паролите не съвпадата");

if (strlen($wantpassword) < 6)
    bark("Паролата е прекалено къса");

if (strlen($wantpassword) > 40)
    bark("Паролата е прекалено дълга");

if ($wantpassword == $wantusername)
    bark("Паролата не може да е същата като потребителското име");

if (!validemail($email))
    bark("Невалиден Еmail адрес.");

if (!validusername($wantusername))
    bark("Невалидно потребителско име.");

if ($_POST["rule1"] != "yes" || $_POST["rule2"] != "yes") 
    stderr("Грешка", "Вие не отговаряте на изискванията и не може да станете член на сайта.");


$a = (mysql_fetch_row(mysql_query("select count(*) from users where email='$email'"))) or die(mysql_error());
if ($a[0] != 0)
    bark("Този Еmail адрес - $email вече се ползва от друг потребител.");

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
        bark("Потребителското име вече съществува!");
    bark("Грешка");
}

$id = mysql_insert_id();

write_log("Потребител с id = $id и име = $wantusername бе създаден");

header("Refresh: 0; url=ok.php?type=confirmed");

hit_end();
?>