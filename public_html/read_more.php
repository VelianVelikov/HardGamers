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
	
	$result = mysql_query("SELECT id, title, image, category, body, time FROM news WHERE id = '$id'");
	$post = mysql_fetch_array($result)
?>
		<? stdhead("" . $post[title]);?>
		<div class="blog_part_left_box">
		<div id="post_info">
			Категория:
	<?php
		$q = mysql_query("SELECT * FROM categories") or die (mysql_error());
		while($c = mysql_fetch_assoc($q))
		{
			if($post[category] == $c[cat_id])
			{
				print "<b>$c[name]</b>";
			}
		}	
	?>
	<?php echo $last = gmdate(" | Добавено: <b>m/d/Y</b>", $post['time']); ?>
	<?php
	    if (get_user_class() >= UC_MOD) {
	?>
	| <a href="editPost.php?post=<?php echo $post['id']; ?>"><u>Редактирай</u></a> | 
	<a href="deletePost.php?post=<?php echo $post['id']; ?>"><u>Изтрий</u></a>
	<?php } ?>
		</div>
		<p><font size="5"><?php echo $post[title]; ?></font></p>
		<p>
		<div class="blog_part_left_box_img"><img src="<?php echo $post['image']; ?>" width="256" height="140"></div>
		<?php echo format_comment($post[body]); ?><br/></p>
	</div>
	

<?php
stdfoot();

hit_end();
?>
