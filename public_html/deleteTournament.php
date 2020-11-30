<?
ob_start("ob_gzhandler");

require "include/main.php";
dbconn();
loggedinorreturn();

$id = (int)$_GET['post'];

	if(!isset($id) || !is_numeric($id) || $id <1)
	{
		header("Location: index.php");
		exit();
	}
	$result = mysql_query("DELETE FROM tournaments WHERE id='$id'") or die (mysql_error());
?>
<? stdhead("Изтриване на събитие");?>
		<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
		<font size="5">Изстриване на събитие</font>
		</div>
		<center>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
			<?php if($result) : ?>
			<p>Успешно изтри турнира</p>
			<a href="index.php">Върни се обратно</a>
			<?php endif; ?>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		</center>
		</div>

<?php
stdfoot();

hit_end();
?>
