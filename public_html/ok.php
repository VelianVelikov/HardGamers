<?

require_once("include/main.php");

hit_start();

dbconn();

hit_count();

if (!mkglobal("type"))
    die();

if ($type == "confirmed") {
    stdhead("������ ����������");
    print("<div class=blog_part_left_box><div class=gamepad_ico></div><div class=blog_part_left_smallheader><font size=5>������� �����������</font></div><center><br/><br/><br/><br/><br/><br/><br/><font size=3>�������� �� � ���������. ���� <a href=\"index.php\">������� ��</a> � ����.</font><br/><br/><br/><br/><br/><br/><br/></center></div>\n");
    stdfoot();
}
else
    die();

hit_end();
?>
