<?
require_once("include/main.php");
dbconn();
stdhead("������� ���� IP ������� � ������");
if ($maxusers == "no") {

?>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">�����������</font>
</div>
<center><form method="post" action="takereg.php">
    <table border="1" cellspacing=0 cellpadding="10" align="center">
        <tr><td align="left" class="heading" ">������������� ��� :<br><input type="text" size="42" name="wantusername" value="<?php echo $_POST['wantusername']; ?>"/></td></tr>
        <tr><td align="left" class="heading" ">������ :<br><input type="password" size="42" name="wantpassword" /></td></tr>
        <tr><td align="left" class="heading" ">������� �������� :<br><input type="password" size="42" name="passagain" /></td></tr>
        <tr valign=top><td align="left" class="heading" ">Email ����� :<br><input type="text" size="42" name="email" value="<?php echo $_POST['email'];?>"/></td></tr>
        </table>
		<table ><tr><td align=left style="border:none;"><input type=checkbox name=rule1 value=yes> �� ������� ���������.<br>
                <input type=checkbox name=rule2 value=yes> ���� ��������� 12 ������.</td></tr>
        <tr><td colspan="2" align="center" style="border:none;"><input type=submit value="����������� ��" style='height: 25px'></td></tr>
		</table>
</form>
</center>
</div>
<?
}
if ($maxusers == "yes") 
print ("<div class=blog_part_left_box><div class=gamepad_ico></div><div class=blog_part_left_smallheader><font size=5>������</font></div><center><br/><br/><br/><br/><br/><br/><br/><font size=3 color=red>������������� �� �������� ������</font><br/><br/><br/><br/><br/><br/><br/></center></div>");

stdfoot();
?>
