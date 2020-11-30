<?php

require "include/main.php";

dbconn();
loggedinorreturn();

if (get_user_class() < UC_MOD)
    header("Location: index.php");

// Добавяне на новини

	if(isset($_POST['add']))
	{
		$title = htmlspecialchars($_POST['title']);
		$body = $_POST['body'];
		$date = $_POST['date'];
		$q = "INSERT INTO events (title, body, date) VALUES ('$title', '$body', '$date')";
		mysql_query($q) or die (mysql_error());
	}


// Самата страница с новините

stdhead("Новини");
?>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">Добавяне на събитие</font>
</div>
<center>
<?php if($_POST['add']) {
?>
<div class="error">Добавено успешно.</br>
<a href="index.php">Обратно</a></div></div>
<?php
}
?>
<?php if(!isset($_POST['add'])) : ?>

<form action="" method="post">
Заглавие: <br><input type="text" name="title" /></br>
Дата: <br><input type="text" name="date" /></br><b>Формат: 2014-02-28</b><br/>
Описание:</br>
<script>edToolbar('addEvent'); </script>
<textarea name="body" cols="60" rows="10" id="addEvent" class="bb_ed"></textarea></br>
<input type="submit" name="add" value="Добави">
</table></form>
</center>
</div>
<?php
endif;

    end_main_frame();

stdfoot();
die;
?>