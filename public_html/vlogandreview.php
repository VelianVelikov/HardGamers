<?
require "include/main.php";
dbconn();
loggedinorreturn();
stdhead("����");
begin_main_frame();
$act = $_GET["act"];
if (!$act) {
// ���� � �������
$dt = gmtime() - 180;
$dt = sqlesc(get_date_time($dt));
// ����������� � ���� ��� � ����������� ���������
$res = mysql_query("SELECT * FROM users WHERE class>=".UC_VIP." AND status='confirmed' ORDER BY username" ) or sqlerr();
while ($arr = mysql_fetch_assoc($res))
{
  $staff_table[$arr['class']]=$staff_table[$arr['class']]."<hr>&nbsp;<font size=2 font=tahoma>&raquo;</font>&nbsp;&nbsp;<a href=member.php?id=".$arr['id'].">".$arr['username']."</a>";
  // 3�� ������ �� ��� ��� ������ ��� ����� ���
  ++ $col[$arr['class']];
  if ($col[$arr['class']]<=3)
    $staff_table[$arr['class']]=$staff_table[$arr['class']]."";
  else
  {
    $staff_table[$arr['class']]=$staff_table[$arr['class']]."";
    $col[$arr['class']]=0;
  }
}
?>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">[���: ��� ����������]</font>
</div><div class=error>
<table width=99% cellspacing=0 align="center">
<tr><td class=embedded colspan=15><b>������� � ���� �������</b></td></tr>
<tr><td class=embedded colspan=15></td></tr>
<tr><td class=embedded>
<?=$staff_table[UC_VIP]?></td></tr>
</table>
</div>
</div>
<? }
end_main_frame();?></table><?
stdfoot();
?>