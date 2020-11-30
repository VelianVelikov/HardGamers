<?

require "include/main.php";
$id = $_GET["id"];
if (!is_numeric($id) || $id < 1 || floor($id) != $id)
    die;

$type = $_GET["type"];

dbconn(false);
loggedinorreturn();
if ($type == 'in') {
    // преоверка дали е във входящата кутия
    $res = mysql_query("SELECT receiver, location FROM messages WHERE id=" . sqlesc($id)) or die("barf");
    $arr = mysql_fetch_array($res) or die("Грешно ID");
    if ($arr["receiver"] != $CURUSER["id"])
        die("Грешка - върни се обратно");
    if ($arr["location"] == 'in')
        mysql_query("DELETE FROM messages WHERE id=" . sqlesc($id)) or die('Неуспешно изтриване - Грешка 1 : моля свържете се с администратор');
    else if ($arr["location"] == 'both')
        mysql_query("UPDATE messages SET location = 'out' WHERE id=" . sqlesc($id)) or die('Неуспешно изтриване - Грешка 2 : моля свържете се с администратор');
    else
        die('Това не е във входящата кутия.');
}
elseif ($type == 'out') {
    // проверка дали е в изходящата кутия
    $res = mysql_query("SELECT sender, location FROM messages WHERE id=" . sqlesc($id)) or die("barf");
    $arr = mysql_fetch_array($res) or die("Грешно ID");
    if ($arr["sender"] != $CURUSER["id"])
        die("Грешка - върни се обратно");
    if ($arr["location"] == 'out')
        mysql_query("DELETE FROM messages WHERE id=" . sqlesc($id)) or die('Неуспешно изтриване - Грешка 3 : моля свържете се с администратор');
    else if ($arr["location"] == 'both')
        mysql_query("UPDATE messages SET location = 'in' WHERE id=" . sqlesc($id)) or die('Неуспешно изтриване - Грешка 4 : моля свържете се с администратор');
    else
        die('Това не е в изходящата кутия');
}
else
    die('Невалидно ЛС.');
header("Location: $DEFAULTBASEURL/inbox.php" . ($type == 'out' ? "?out=1" : ""));
?>