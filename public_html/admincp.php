<?
ob_start("ob_gzhandler");

require "include/main.php";

dbconn();

if(get_user_class() < UC_MOD) {
    stderr("������","��� ������ ������� �����, �� �� ������� ���� ��������");
}

stdhead("����� �����");

if(get_user_class() >= UC_ADMIN) {
?>
		<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
		<font size="5">���������������� �����</font>
		</div>
<font size="2" face="tahoma">&raquo;</font>&nbsp; <a href="config.php">��������� �� �����</a><font color="#666"> - config.php</font><hr>
<font size="2" face="tahoma">&raquo;</font>&nbsp; <a href="dobavipotrebitel.php">������ ����������</a><font color="#666"> - dobavipotrebitel.php</font>
</div>

<?php
}
?>
		<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
		<font size="5">������������ �����</font>
		</div>
<font size="2" face="tahoma">&raquo;</font>&nbsp; <a href="addNews.php">������ ������</a><font color="#666"> - addNews.php</font><hr>
<font size="2" face="tahoma">&raquo;</font>&nbsp; <a href="addEvent.php">������ �������</a><font color="#666"> - addEvent.php</font><hr>
<font size="2" face="tahoma">&raquo;</font>&nbsp; <a href="addTournament.php">������ ������</a><font color="#666"> - addTournament.php</font><hr>
<font size="2" face="tahoma">&raquo;</font>&nbsp; <a href="proverkaban.php">������� ���� IP ������� � ������</a><font color="#666"> - proverkaban.php</font><hr>
<font size="2" face="tahoma">&raquo;</font>&nbsp; <a href="log.php">��������</a><font color="#666"> - log.php</font><hr>
<font size="2" face="tahoma">&raquo;</font>&nbsp; <a href="banove.php">������</a><font color="#666"> - banove.php</font>
</div>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">�����</font>
</div>
<center><font size="3.5" color="red">����������, �� ��� ���� �� ����� � ����� ������ �����, �� ���� �� ��������������� � ���. ���� ������ ���������� � �������������� ! </font></center>
</div>
<?php
stdfoot();
?>