<?

require_once("include/main.php");

dbconn();

logoutcookie();

//header("Refresh: 0; url=./");
Header("Location: $DEFAULTBASEURL/");

?>
