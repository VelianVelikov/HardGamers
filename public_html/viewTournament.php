<?
ob_start("ob_gzhandler");

require "include/main.php";
dbconn(true);

	$id = (int)$_GET['post'];
	
	if(!isset($id) || !is_numeric($id) || $id <1)
	{
		header("Location: index.php");
		exit();
	}
	
	$result = mysql_query("SELECT * FROM tournaments WHERE id = '$id'");
	$post = mysql_fetch_array($result)
?>
		<?
		if ($post['first'] == "")
		stdhead("Турнир");
		else {
		stdhead("" . $post[first] . " vs " . $post[second]);
		}
		?>
	
		<div class="blog_part_left_table">
		<table width="100%" cellspacing=0 >
		<div class="gamepad_ico"></div><div class="blog_part_left_table_smallheader">
		<font size="5">
		<?
		if ($post['first'] == "")
		print ("Турнир");
		else {
		echo ($post['first'] . " vs " . $post['second']);
		}
		?>
		</font>
		</div>
		<table width=100% cellspacing=0 cellpadding=0>       
        <tr><td rowspan="10" valign="top" align="center" height="190" width="50%"><img src="<?php echo $post['img']; ?>" width="280" height="190"><br>
		<tr><td height="50.5"><b>Игра: <?php echo $post['game']; ?></b></td></tr>
		<tr><td height="50.5"><b>Тип: <?php echo $post['type']; ?></b></td></tr>
		<tr><td height="50.5"><b>Дата: <?php echo $post['date']; ?></b></td></tr>
		<tr><td height="50.5"><b>Live stream: <a href="<?php echo $post['live']; ?>"><img src="styles/images/live.png"/><a></b></td></tr>
		</td>
		</tr>	
		</table>
		<table width=100% cellspacing=0 cellpadding=0>       
		<tr>
		<td width="49.9%" align="center">
		<?
		if ($post['first'] == "")
		print ("");
		else {
		echo ("<h1>" . $post['first'] . "</h1><br/><br/>");
		}
		?>
		<?
		if ($post['first1'] == "")
		print ("");
		else {
		echo ($post['first1'] . "<br/>");
		}
		?>
		<?
		if ($post['first2'] == "")
		print ("");
		else {
		echo ($post['first2'] . "<br/>");
		}
		?>
		<?
		if ($post['first3'] == "")
		print ("");
		else {
		echo ($post['first3'] . "<br/>");
		}
		?>
		<?
		if ($post['first4'] == "")
		print ("");
		else {
		echo ($post['first4'] . "<br/>");
		}
		?>
		<?
		if ($post['first5'] == "")
		print ("");
		else {
		echo ($post['first5'] . "<br/>");
		}
		?>
		<?
		if ($post['first6'] == "")
		print ("");
		else {
		echo ($post['first6'] . "<br/>");
		}
		?>
		<?
		if ($post['first7'] == "")
		print ("");
		else {
		echo ($post['first7'] . "<br/>");
		}
		?>
		<?
		if ($post['first8'] == "")
		print ("");
		else {
		echo ($post['first8'] . "<br/>");
		}
		?>
		<?
		if ($post['first9'] == "")
		print ("");
		else {
		echo ($post['first9'] . "<br/>");
		}
		?>
		<?
		if ($post['first10'] == "")
		print ("");
		else {
		echo ($post['first10'] . "<br/>");
		}
		?>
		</td>
		<td width="50.1%" align="center">
		<?
		if ($post['second'] == "")
		print ("");
		else {
		echo ("<h1>" . $post['second'] . "</h1><br/><br/>");
		}
		?>
		<?
		if ($post['second1'] == "")
		print ("");
		else {
		echo ($post['second1'] . "<br/>");
		}
		?>		
		<?
		if ($post['second2'] == "")
		print ("");
		else {
		echo ($post['second2'] . "<br/>");
		}
		?>		
		<?
		if ($post['second3'] == "")
		print ("");
		else {
		echo ($post['second3'] . "<br/>");
		}
		?>		
		<?
		if ($post['second4'] == "")
		print ("");
		else {
		echo ($post['second4'] . "<br/>");
		}
		?>		
		<?
		if ($post['second5'] == "")
		print ("");
		else {
		echo ($post['second5'] . "<br/>");
		}
		?>		
		<?
		if ($post['second6'] == "")
		print ("");
		else {
		echo ($post['second6'] . "<br/>");
		}
		?>		
		<?
		if ($post['second7'] == "")
		print ("");
		else {
		echo ($post['second7'] . "<br/>");
		}
		?>		
		<?
		if ($post['second8'] == "")
		print ("");
		else {
		echo ($post['second8'] . "<br/>");
		}
		?>		
		<?
		if ($post['second9'] == "")
		print ("");
		else {
		echo ($post['second9'] . "<br/>");
		}
		?>		
		<?
		if ($post['second10'] == "")
		print ("");
		else {
		echo ($post['second10'] . "<br/>");
		}
		?>
		</td>
		</tr>
		</table>
		<table width=100% cellspacing=0 cellpadding=0>       
		<tr>
		<td width="100%" align="center">
		<?php echo format_comment($post[info]); ?><?php
			if (get_user_class() >= UC_MOD) {
		?>
		<br/><hr/><a href="editTournament.php?post=<?php echo $post['id']; ?>"><u>Редактирай</u></a> | 
		<a href="deleteTournament.php?post=<?php echo $post['id']; ?>"><u>Изтрий</u></a>
		<?php } ?>
		</td>
		</tr>
		</table>
		</table>
		</div>
	

<?php
stdfoot();

hit_end();
?>
