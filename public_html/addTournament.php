<?php

require "include/main.php";

dbconn();
loggedinorreturn();

if (get_user_class() < UC_MOD)
    header("Location: index.php");

// �������� �� ������

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


// ������ �������� � ��������

stdhead("������");
?>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">�������� �� ������</font>
</div>
<center>
<?php if($_POST['add']) {
?>
<div class="error">�������� �������.</br>
<a href="index.php">�������</a></div></div>
<?php
}
?>
<?php if(!isset($_POST['add'])) : ?>

<form action="" method="post">
�����������: <br><input type="text" name="img" /></br>
����: <br><input type="text" name="game" /></br>
���: <br><input type="text" name="type" /></br>
����: <br><input type="text" name="date" /></br><b>������: 2014-02-28</b><br/>
Live stream: <br><input type="text" name="live" /></br>
<table>
<tr>
<td>
<center>��� �� �����: <br><input type="text" name="first" /></center></br>
�����: <input type="text" name="first1" /></br>
�����: <input type="text" name="first2" /></br>
�����: <input type="text" name="first3" /></br>
�����: <input type="text" name="first4" /></br>
�����: <input type="text" name="first5" /></br>
�����: <input type="text" name="first6" /></br>
�����: <input type="text" name="first7" /></br>
�����: <input type="text" name="first8" /></br>
�����: <input type="text" name="first9" /></br>
�����: <input type="text" name="first10" /></br>
</td>
<td>
<td>
<center>��� �� �����: <br><input type="text" name="second" /></center></br>
�����: <input type="text" name="second1" /></br>
�����: <input type="text" name="second2" /></br>
�����: <input type="text" name="second3" /></br>
�����: <input type="text" name="second4" /></br>
�����: <input type="text" name="second5" /></br>
�����: <input type="text" name="second6" /></br>
�����: <input type="text" name="second7" /></br>
�����: <input type="text" name="second8" /></br>
�����: <input type="text" name="second9" /></br>
�����: <input type="text" name="second10" /></br>
</td>
</tr>
</table>
������ ����������:</br>
<script>edToolbar('addTournament'); </script>
<textarea name="info" cols="60" rows="10" id="addTournament" class="bb_ed"></textarea></br>
<input type="submit" name="add" value="������">
</form>
</center>
</div>
<?php
endif;

    end_main_frame();

stdfoot();
die;
?>