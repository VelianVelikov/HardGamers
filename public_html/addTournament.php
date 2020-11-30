<?php

require "include/main.php";

dbconn();
loggedinorreturn();

if (get_user_class() < UC_MOD)
    header("Location: index.php");

// Добавяне на новини

	if(isset($_POST['add']))
	{
		$img = htmlspecialchars($_POST['img']);
		$game = htmlspecialchars($_POST['game']);
		$type = htmlspecialchars($_POST['type']);
		$date = $_POST['date'];
		$live = htmlspecialchars($_POST['live']);
		$first = htmlspecialchars($_POST['first']);
		$second = htmlspecialchars($_POST['second']);
		$first1 = htmlspecialchars($_POST['first1']);
		$first2 = htmlspecialchars($_POST['first2']);
		$first3 = htmlspecialchars($_POST['first3']);
		$first4 = htmlspecialchars($_POST['first4']);
		$first5 = htmlspecialchars($_POST['first5']);
		$first6 = htmlspecialchars($_POST['first6']);
		$first7 = htmlspecialchars($_POST['first7']);
		$first8 = htmlspecialchars($_POST['first8']);
		$first9 = htmlspecialchars($_POST['first9']);
		$first10 = htmlspecialchars($_POST['first10']);
		$second1 = htmlspecialchars($_POST['second1']);
		$second2 = htmlspecialchars($_POST['second2']);
		$second3 = htmlspecialchars($_POST['second3']);
		$second4 = htmlspecialchars($_POST['second4']);
		$second5 = htmlspecialchars($_POST['second5']);
		$second6 = htmlspecialchars($_POST['second6']);
		$second7 = htmlspecialchars($_POST['second7']);
		$second8 = htmlspecialchars($_POST['second8']);
		$second9 = htmlspecialchars($_POST['second9']);
		$second10 = htmlspecialchars($_POST['second10']);
		$info = $_POST['info'];
		$q = "INSERT INTO tournaments (img, game, type, date, live, first, second, first1, first2, first3, first4, first5, first6, first7, first8, first9, first10, second1, second2, second3, second4, second5, second6, second7, second8, second9, second10, info) VALUES ('$img', '$game', '$type', '$date', '$live', '$first', '$second', '$first1', '$first2', '$first3', '$first4', '$first5', '$first6', '$first7', '$first8', '$first9', '$first10', '$second1', '$second2', '$second3', '$second4', '$second5', '$second6', '$second7', '$second8', '$second9', '$second10', '$info')";
		mysql_query($q) or die (mysql_error());
	}


// Самата страница с новините

stdhead("Новини");
?>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">Добавяне на турнир</font>
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
Изображение: <br><input type="text" name="img" /></br>
Игра: <br><input type="text" name="game" /></br>
Тип: <br><input type="text" name="type" /></br>
Дата: <br><input type="text" name="date" /></br><b>Формат: 2014-02-28</b><br/>
Live stream: <br><input type="text" name="live" /></br>
<table>
<tr>
<td>
<center>Име на отбор: <br><input type="text" name="first" /></center></br>
Играч: <input type="text" name="first1" /></br>
Играч: <input type="text" name="first2" /></br>
Играч: <input type="text" name="first3" /></br>
Играч: <input type="text" name="first4" /></br>
Играч: <input type="text" name="first5" /></br>
Играч: <input type="text" name="first6" /></br>
Играч: <input type="text" name="first7" /></br>
Играч: <input type="text" name="first8" /></br>
Играч: <input type="text" name="first9" /></br>
Играч: <input type="text" name="first10" /></br>
</td>
<td>
<td>
<center>Име на отбор: <br><input type="text" name="second" /></center></br>
Играч: <input type="text" name="second1" /></br>
Играч: <input type="text" name="second2" /></br>
Играч: <input type="text" name="second3" /></br>
Играч: <input type="text" name="second4" /></br>
Играч: <input type="text" name="second5" /></br>
Играч: <input type="text" name="second6" /></br>
Играч: <input type="text" name="second7" /></br>
Играч: <input type="text" name="second8" /></br>
Играч: <input type="text" name="second9" /></br>
Играч: <input type="text" name="second10" /></br>
</td>
</tr>
</table>
Кратка информация:</br>
<script>edToolbar('addTournament'); </script>
<textarea name="info" cols="60" rows="10" id="addTournament" class="bb_ed"></textarea></br>
<input type="submit" name="add" value="Добави">
</form>
</center>
</div>
<?php
endif;

    end_main_frame();

stdfoot();
die;
?>