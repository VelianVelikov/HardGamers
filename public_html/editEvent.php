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
	$result = mysql_query("SELECT id, title, body, date FROM events WHERE id='$id'");
	$post = mysql_fetch_assoc($result);
	if(isset($_POST['editPost']))
	{
		$title = htmlspecialchars($_POST['title']);
		$body = $_POST['body'];
		$date = $_POST['date'];
		$q = "UPDATE events SET title='$title', body='$body', date='$date' WHERE id='$id'";
		mysql_query($q) or die(mysql_error());
	}
?>

		<? stdhead("" . $post[title]);?>
		<?php if(isset($_POST['editPost'])) : 

    stdmsg("Съобщение", "<p>Успешно редактира събитието</p>");

	endif; ?>
	<?php if(!isset($_POST['editPost'])) : ?>
		<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
		<font size="5">Редактиране на събитие</font>
		</div>
		<center>

	<p>
	<form action="" method="post">
	Заглавие: <br/><input type="text" name="title" value="<?php echo $post[title]; ?>"/></br>
	Дата: <br/><input type="text" name="date" value="<?php echo $post['date']; ?>"/></br>
	Описание:</br>
	<script>edToolbar('editEvent'); </script>
	<textarea name="body" cols="60" rows="15" id="editEvent" class="bb_ed"><?php echo $post[body]; ?></textarea></br>
	<input type="submit" name="editPost" value="Промени">
	</p></center></div>
	<?php endif; ?>
		
		

<?
stdfoot();

hit_end();
?>
