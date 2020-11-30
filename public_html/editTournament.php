<?
ob_start("ob_gzhandler");

require "include/main.php";
dbconn();
loggedinorreturn();

$id = (int)$_GET['post'];

if (get_user_class() < UC_MOD)
    header("Location: index.php");

	if(!isset($id) || !is_numeric($id) || $id <1)
	{
		header("Location: index.php");
		exit();
	}
	$result = mysql_query("SELECT id, img, game, type, date, live, first, second, first1, first2, first3, first4, first5, first6, first7, first8, first9, first10, second1, second2, second3, second4, second5, second6, second7, second8, second9, second10, info FROM tournaments WHERE id='$id'");
	$post = mysql_fetch_assoc($result);
	if(isset($_POST['editPost']))
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
		$q = "UPDATE tournaments SET img='$img', game='$game', type='$type', date='$date', live='$live', first='$first', second='$second', first1='$first1', first2='$first2', first3='$first3', first4='$first4', first5='$first5', first6='$first6', first7='$first7', first8='$first8', first9='$first9', first10='$first10', second1='$second1', second2='$second2', second3='$second3', second4='$second4', second5='$second5', second6='$second6', second7='$second7', second8='$second8', second9='$second9', second10='$second10', info='$info' WHERE id='$id'";
		mysql_query($q) or die(mysql_error());
	}
?>
		<?
		if ($post['first'] == "")
		stdhead("Турнир");
		else {
		stdhead("" . $post[first] . " vs " . $post[second]);
		}
		?>
		<?php if(isset($_POST['editPost'])) : 

    stdmsg("Съобщение", "<p>Успешно редактира турнира</p>");

	endif; ?>
	<?php if(!isset($_POST['editPost'])) : ?>
		<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
		<font size="5">Редактиране на турнир</font>
		</div>
		<center>

	<p>
	<form action="" method="post">
		Изображение: <br><input type="text" name="img" value="<?php echo $post[img]; ?>"/></br>
		Игра: <br><input type="text" name="game" value="<?php echo $post[game]; ?>"/></br>
		Тип: <br><input type="text" name="type" value="<?php echo $post[type]; ?>"/></br>
		Дата: <br><input type="text" name="date" value="<?php echo $post[date]; ?>"/></br><b>Формат: 2014-02-28</b><br/>
		Live stream: <br><input type="text" name="live" value="<?php echo $post[live]; ?>"/></br>
		<table>
		<tr>
		<td>
		<center>Име на отбор: <br><input type="text" name="first" value="<?php echo $post[first]; ?>"/></center></br>
		Играч: <input type="text" name="first1" value="<?php echo $post[first1]; ?>"/></br>
		Играч: <input type="text" name="first2" value="<?php echo $post[first2]; ?>"/></br>
		Играч: <input type="text" name="first3" value="<?php echo $post[first3]; ?>"/></br>
		Играч: <input type="text" name="first4" value="<?php echo $post[first4]; ?>"/></br>
		Играч: <input type="text" name="first5" value="<?php echo $post[first5]; ?>"/></br>
		Играч: <input type="text" name="first6" value="<?php echo $post[first6]; ?>"/></br>
		Играч: <input type="text" name="first7" value="<?php echo $post[first7]; ?>"/></br>
		Играч: <input type="text" name="first8" value="<?php echo $post[first8]; ?>"/></br>
		Играч: <input type="text" name="first9" value="<?php echo $post[first9]; ?>"/></br>
		Играч: <input type="text" name="first10" value="<?php echo $post[first10]; ?>"/></br>
		</td>
		<td>
		<td>
		<center>Име на отбор: <br><input type="text" name="second" value="<?php echo $post[second]; ?>"/></center></br>
		Играч: <input type="text" name="second1" value="<?php echo $post[second1]; ?>"/></br>
		Играч: <input type="text" name="second2" value="<?php echo $post[second2]; ?>"/></br>
		Играч: <input type="text" name="second3" value="<?php echo $post[second3]; ?>"/></br>
		Играч: <input type="text" name="second4" value="<?php echo $post[second4]; ?>"/></br>
		Играч: <input type="text" name="second5" value="<?php echo $post[second5]; ?>"/></br>
		Играч: <input type="text" name="second6" value="<?php echo $post[second6]; ?>"/></br>
		Играч: <input type="text" name="second7" value="<?php echo $post[second7]; ?>"/></br>
		Играч: <input type="text" name="second8" value="<?php echo $post[second8]; ?>"/></br>
		Играч: <input type="text" name="second9" value="<?php echo $post[second9]; ?>"/></br>
		Играч: <input type="text" name="second10" value="<?php echo $post[second10]; ?>"/></br>
		</td>
		</tr>
		</table>
		Кратка информация:</br>
		<script>edToolbar('editTournament'); </script>
		<textarea name="info" cols="60" rows="10" id="editTournament" class="bb_ed"><?php echo $post[info]; ?></textarea></br>
		<input type="submit" name="editPost" value="Промени">
	</form></p></center></div>
	<?php endif; ?>
		
		

<?
stdfoot();

hit_end();
?>
