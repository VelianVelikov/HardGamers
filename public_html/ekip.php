<?
require "include/main.php";
dbconn();
loggedinorreturn();
stdhead("Екип");
begin_main_frame();
$act = $_GET["act"];
if (!$act) {
// часа в момента
$dt = gmtime() - 180;
$dt = sqlesc(get_date_time($dt));
// отребители с ранг над и вклучително модератор
$res = mysql_query("SELECT * FROM users WHERE class>=".UC_MOD." AND status='confirmed' ORDER BY username" ) or sqlerr();
while ($arr = mysql_fetch_assoc($res))
{
  $staff_table[$arr['class']]=$staff_table[$arr['class']]."<hr>&nbsp;<font size=2 font=tahoma>&raquo;</font>&nbsp;&nbsp;<a href=member.php?id=".$arr['id'].">".$arr['username']."</a>";
  // 3ма човека на ред със празен ред между тях
  ++ $col[$arr['class']];
  if ($col[$arr['class']]<=2)
    $staff_table[$arr['class']]=$staff_table[$arr['class']]."";
  else
  {
    $staff_table[$arr['class']]=$staff_table[$arr['class']]."";
    $col[$arr['class']]=0;
  }
}
?>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">Хората от Hard-Gamers</font>
</div>
<table width=99% cellspacing=0 align="center">
<tr><td class=embedded colspan=15><b>Администратори</b></td></tr>
<tr><td class=embedded colspan=15></td></tr>
<tr><td class=embedded>
<?=$staff_table[UC_ADMIN]?></td></tr>
<tr><td class=embedded colspan=15>&nbsp;</td></tr>
<tr><td class=embedded colspan=15><b>Модератори</b></td></tr>
<tr><td class=embedded colspan=15></td></tr>
<tr><td class=embedded>
<?=$staff_table[UC_MOD]?></td></tr>
</table>
</div>
<? }
end_main_frame();?></table><?
stdfoot();
?>