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
	$result = mysql_query("SELECT id, title, subtitle, category, image, body FROM news WHERE id='$id'");
	$post = mysql_fetch_assoc($result);
	if(isset($_POST['editPost']))
	{
		$title = htmlspecialchars($_POST['title']);
		$subtitle = htmlspecialchars($_POST['subtitle']);
		$category = $_POST['category'];
		$image = htmlspecialchars($_POST['image']);
		$body = $_POST['body'];
		$q = "UPDATE news SET title='$title', subtitle='$subtitle', category='$category', image='$image', body='$body' WHERE id='$id'";
		mysql_query($q) or die(mysql_error());
	}
?>

		<? stdhead("" . $post[title]);?>
		<?php if(isset($_POST['editPost'])) : 

    stdmsg("���������", "<p>������� ��������� ��������</p>");

	endif; ?>
	<?php if(!isset($_POST['editPost'])) : ?>
		<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
		<font size="5">����������� �� ������</font>
		</div>
		<center>

	<p>
	<form action="" method="post">
	��������: <br/><input type="text" name="title" value="<?php echo $post[title]; ?>"/></br>
	����������: <br/><input type="text" name="subtitle" value="<?php echo $post[subtitle]; ?>"/></br>
	�����������: <br/><input type="text" name="image" value="<?php echo $post[image]; ?>"/></br>
	������:</br>
	<script>edToolbar('editNews'); </script>
	<textarea name="body" cols="60" rows="15" id="editNews" class="bb_ed"><?php echo $post[body]; ?></textarea></br>
	���������: <br/><select name="category">
	<?php
		$q = mysql_query("SELECT * FROM categories") or die (mysql_error());
		while($c = mysql_fetch_assoc($q))
		{
			if($post[category] == $c[cat_id])
			{
				print '<option value="'.$c[cat_id].'" selected="selected">'.$c[name]."</option>\n";
			}
			else
			{
			print '<option value='.$c[cat_id].'>'.$c[name]."</option>\n";
			}
		}	
	?>
	</select></br>
	<input type="submit" name="editPost" value="�������">
	</p></center></div>
	<?php endif; ?>
		
		

<?
stdfoot();

hit_end();
?>
