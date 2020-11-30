<?php

require "include/main.php";

if ($HTTP_SERVER_VARS["REQUEST_METHOD"] != "POST")
    stderr("Грешка", "Не се пробвайте да хакрествате");

dbconn();

loggedinorreturn();
$receiver = $_POST["receiver"];
$origmsg = $_POST["origmsg"];
$save = $_POST["save"];
$returnto = $_POST["returnto"];

if (!is_valid_id($receiver) || ($origmsg && !is_valid_id($origmsg)))
    stderr("Грешка", "Невалидно ID");

$msg = trim($_POST["msg"]);
if (!$msg)
    stderr("Грешка", "Моля въведете някакъв текст!");
$msg = trim($_POST["msg"]);
if (strlen($msg) > 750)
    stderr("Грешка", "Надхвърли ли се обема!");

$location = ($save == 'yes') ? "both" : "in";

$res = mysql_query("SELECT UNIX_TIMESTAMP(last_access) as la FROM users WHERE id=$receiver") or sqlerr(__FILE__, __LINE__);
$user = mysql_fetch_assoc($res);
if (!$user)
    stderr("Грешка", "Няма потребител с ID $receiver.");

mysql_query("INSERT INTO messages (poster, sender, receiver, added, msg, location) VALUES(" . $CURUSER["id"] . ", " .
                $CURUSER["id"] . ", $receiver, '" . get_date_time() . "', " .
                sqlesc($msg) . ", " . sqlesc($location) . ")") or sqlerr(__FILE__, __LINE__);

$delete = $_POST["delete"];

if ($origmsg) {
    if ($delete == "yes") {
        // уверяваме се, че получятеля е точния получател
        $res = mysql_query("SELECT * FROM messages WHERE id=$origmsg") or sqlerr(__FILE__, __LINE__);
        if (mysql_num_rows($res) == 1) {
            $arr = mysql_fetch_assoc($res);
            if ($arr["receiver"] != $CURUSER["id"])
                stderr("Грешка", "Изглежда има някакъв проблем.");
            if ($arr["location"] == "in")
                mysql_query("DELETE FROM messages WHERE id=$origmsg AND location = 'in'") or sqlerr(__FILE__, __LINE__);
            elseif ($arr["location"] == "both")
                mysql_query("UPDATE messages SET location = 'out' WHERE id=$origmsg AND location = 'both'") or sqlerr(__FILE__, __LINE__);
        }
    }
    if (!$returnto)
        $returnto = "$DEFAULTBASEURL/inbox.php";
}

if ($returnto) {
    header("Location: $returnto");
    die;
}

stdfoot();
exit;
?>