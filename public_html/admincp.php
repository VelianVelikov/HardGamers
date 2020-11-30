<?
ob_start("ob_gzhandler");

require "include/main.php";

dbconn();

if(get_user_class() < UC_MOD) {
    stderr("Грешка","Вие нямате нужните права, за да виждате тази страница");
}

stdhead("Админ Панел");

if(get_user_class() >= UC_ADMIN) {
?>
		<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
		<font size="5">Администраторски панел</font>
		</div>
<font size="2" face="tahoma">&raquo;</font>&nbsp; <a href="config.php">Настройки по сайта</a><font color="#666"> - config.php</font><hr>
<font size="2" face="tahoma">&raquo;</font>&nbsp; <a href="dobavipotrebitel.php">Добави Потребител</a><font color="#666"> - dobavipotrebitel.php</font>
</div>

<?php
}
?>
		<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
		<font size="5">Модераторски панел</font>
		</div>
<font size="2" face="tahoma">&raquo;</font>&nbsp; <a href="addNews.php">Добави новина</a><font color="#666"> - addNews.php</font><hr>
<font size="2" face="tahoma">&raquo;</font>&nbsp; <a href="addEvent.php">Добави събитие</a><font color="#666"> - addEvent.php</font><hr>
<font size="2" face="tahoma">&raquo;</font>&nbsp; <a href="addTournament.php">Добави турнир</a><font color="#666"> - addTournament.php</font><hr>
<font size="2" face="tahoma">&raquo;</font>&nbsp; <a href="proverkaban.php">Провери дали IP Адресът е баннат</a><font color="#666"> - proverkaban.php</font><hr>
<font size="2" face="tahoma">&raquo;</font>&nbsp; <a href="log.php">Регистър</a><font color="#666"> - log.php</font><hr>
<font size="2" face="tahoma">&raquo;</font>&nbsp; <a href="banove.php">Банове</a><font color="#666"> - banove.php</font>
</div>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">Важно</font>
</div>
<center><font size="3.5" color="red">Независимо, че сте част от Екипа и имате повече права, не бива да злоупотребявате с тях. Моля бъдете толерантни и безпристрастни ! </font></center>
</div>
<?php
stdfoot();
?>