<?
ob_start("ob_gzhandler");

require "include/main.php";
dbconn(true);
stdhead("Категория");

	$catId = (int)$_GET['post'];

	if(!isset($catId) || !is_numeric($catId) || $catId <1)
	{
		header("Location: index.php");
		exit();
	}
	
	$res = mysql_query("SELECT id, title, image, category, body, time FROM  news WHERE category = '$catId' ") or die (mysql_error());
	
?>
<div class="blog_part_left_box">
<?php 
if (mysql_num_rows($res) > 0) {	
while($row = mysql_fetch_array($res))
{ 
?>
<br/>
<table>
<tr>
<td style="border:none;"><img src="<?php echo $row['image']; ?>" width="256" height="140"></td>
<td style="border:none;"><a href="read_more.php?post=<?php echo $row['id']; ?>" style="	text-decoration:none; color: #4f5254; font-size: 18px;"><u><?php echo $row['title']; ?></u></a><br/><?php $string = strip_tags(format_comment($row['body'])); echo substr($string, 0,225); ?>...<br/></td>
<td style="border:none;"><?php echo $last = gmdate("Добавено: <b>m/d/Y</b>", $row['time']); ?></td>
</tr>
</table><br/>
	<?php
    }
	}
	else
	{
		print "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><center>Намя постове в тази категория</center><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}
?>
</div>
		
		
		
		

<?php
stdfoot();

hit_end();
?>

