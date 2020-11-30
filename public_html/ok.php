<?

require_once("include/main.php");

hit_start();

dbconn();

hit_count();

if (!mkglobal("type"))
    die();

if ($type == "confirmed") {
    stdhead("Акаунт активиране");
    print("<div class=blog_part_left_box><div class=gamepad_ico></div><div class=blog_part_left_smallheader><font size=5>Успешна регистрация</font></div><center><br/><br/><br/><br/><br/><br/><br/><font size=3>Акаунтът Ви е активиран. Моля <a href=\"index.php\">впишете се</a> с него.</font><br/><br/><br/><br/><br/><br/><br/></center></div>\n");
    stdfoot();
}
else
    die();

hit_end();
?>
