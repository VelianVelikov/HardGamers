<?
  require "include/main.php";
  dbconn();

  loggedinorreturn();
  
  if (get_user_class() < UC_MOD)
    stderr("Грешка", "Вие нямате нужните права, за да разглеждате тази страница.");

  // изтриване на всичко по-старо от седмица
  $secs = 24 * 60 * 60;

  mysql_query("DELETE FROM sitelog WHERE " . gmtime() . " - UNIX_TIMESTAMP(added) > $secs") or sqlerr(__FILE__, __LINE__);
  $res = mysql_query("SELECT added, txt FROM sitelog ORDER BY added DESC") or sqlerr(__FILE__, __LINE__);

  if (mysql_num_rows($res) == 0)
    stderr("Съобщение", "Регистърът на сайта е празен");
  else
  {
    stdhead("Лог на сайта");
	?>
	<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
	<font size="5">Регистърът на сайта</font>
	</div>
	<?
    print("<table border=1 cellspacing=0 cellpadding=5 align=center>\n");
    print("<tr><td class=colhead align=left>Дата</td><td class=colhead align=left>Час</td><td class=colhead align=left>Регистър</td></tr>\n");
    while ($arr = mysql_fetch_assoc($res))
    {
      $date = substr($arr['added'], 0, strpos($arr['added'], " "));
      $time = substr($arr['added'], strpos($arr['added'], " ") + 1);
      print("<tr><td>$date</td><td>$time</td><td align=left>$arr[txt]</td></tr>\n");
    }
    print("</table></div>");
  }
  stdfoot();
  
?>