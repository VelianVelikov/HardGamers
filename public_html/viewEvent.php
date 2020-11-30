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
	
	$result = mysql_query("SELECT id, title, body, date FROM events WHERE id = '$id'");
	$post = mysql_fetch_array($result)
?>
		<? stdhead("" . $post[title]);?>
		<div class="blog_part_left_box">
		<div id="post_info">
	Дата: <?php echo $post['date']; ?>
	<?php
	    if (get_user_class() >= UC_MOD) {
	?>
	| <a href="editEvent.php?post=<?php echo $post['id']; ?>"><u>Редактирай</u></a> | 
	<a href="deleteEvent.php?post=<?php echo $post['id']; ?>"><u>Изтрий</u></a>
	<?php } ?>
		</div>
		<div class="error">
		<center><p><font size="5"><?php echo $post[title]; ?></font></p></center>
		<p>
		<?php echo format_comment($post[body]); ?><br/></div></p>
	</div>
	

<?php
stdfoot();

hit_end();
?>
