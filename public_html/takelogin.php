<?

require_once("include/main.php");

hit_start();

if (!mkglobal("username:password"))
	die();

dbconn();

hit_count();

function bark($text = "Неправилни име или парола")
{
  stderr("Неуспешно вписване в системата!", $text);
}

$res = mysql_query("SELECT id, passhash, secret, enabled FROM users WHERE username = " . sqlesc($username) . " AND status = 'confirmed'");
$row = mysql_fetch_array($res);

if (!$row)
	bark();

if ($row["passhash"] != md5($row["secret"] . $password . $row["secret"]))
	bark();

if ($row["enabled"] == "no")
	bark("Този акаунт е забранен от администратор.");

logincookie($row["id"], $row["passhash"]);

if (!empty($_POST["returnto"]))
	header("Location: $DEFAULTBASEURL$_POST[returnto]");
else
	header("Location: $DEFAULTBASEURL/profile.php");

hit_end();

?>