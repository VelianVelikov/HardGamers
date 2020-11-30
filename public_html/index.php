<?
ob_start("ob_gzhandler");

require "include/main.php";
dbconn(true);

stdhead();

$res = mysql_query("SELECT id, title, subtitle, image, body FROM `news` ORDER BY `id` DESC LIMIT 0,5") or sqlerr(__FILE__, __LINE__);
if (mysql_num_rows($res) > 0) {
		while($row = mysql_fetch_array($res))
		{

			?>
		
		<div class="blog_part_left_box">
		<div class="gamepad_ico"></div><div class="blog_part_left_header">
		<font size="5"><a href="read_more.php?post=<?php echo $row['id']; ?>"><?php $string = strip_tags(format_comment($row['title'])); echo substr($string, 0,35); if (strlen($string) >= 34) { print "..."; }?></a></font></font>
		</br><font size="2"><?php echo $row['subtitle']; ?></font>
		</div>
		<p>
		<div class="blog_part_left_box_img"><a href="read_more.php?post=<?php echo $row['id']; ?>"><img src="<?php echo $row['image']; ?>" width="256" height="140"></a></div>
	<?php $string = strip_tags(format_comment($row['body'])); echo substr($string, 0,475); ?>...</p></div>
	<?php
		}

    }

stdfoot();

hit_end();
?>
