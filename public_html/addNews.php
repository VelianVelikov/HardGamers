<?php

require "include/main.php";

dbconn();
loggedinorreturn();

if (get_user_class() < UC_MOD)
    header("Location: index.php");

// �������� �� ������

	if(isset($_POST['add']))
	{
		$time = time();
		$title = htmlspecialchars($_POST['title']);
		$subtitle = htmlspecialchars($_POST['subtitle']);
		$category = $_POST['category'];
		$image = htmlspecialchars($_POST['image']);
		$body = $_POST['body'];
		$q = "INSERT INTO news (title, subtitle, category, image, body, time) VALUES ('$title', '$subtitle', '$category', '$image', '$body', '$time')";
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
?><div class="error">�������� �������.</br>
<a href="index.php">�������</a></div></div>
<?php
}
?>
<?php if(!isset($_POST['add'])) : ?>

<form action="" method="post">
��������: <br><input type="text" name="title" /></br>
�����������: <br><input type="text" name="subtitle" /></br>
�����������: <br/><input type="text" name="image" /></br>
������:</br>
<script>edToolbar('addNews'); </script>
<textarea name="body" cols="60" rows="10" id="addNews" class="bb_ed"></textarea></br>
���������: <br/><select name="category">
<?php
	$q = mysql_query("SELECT * FROM categories") or die (mysql_error());
	while($c = mysql_fetch_assoc($q))
	{
		print '<option value='.$c[cat_id].'>'.$c[name]."</option>\n";	
	}
	
?>
</select></br>
<input type="submit" name="add" value="������">
</table></form>
</center>
</div>
<?php
endif;

    end_main_frame();

stdfoot();
die;
?>