<?
ob_start("ob_gzhandler");

require "include/main.php";
dbconn(true);
stdhead("Категория");

	$game_id = (int)$_GET['post'];

	if(!isset($game_id) || !is_numeric($game_id) || $game_id <1)
	{
		header("Location: index.php");
		exit();
	}
	
	$res = mysql_query("SELECT id, userid, title, youtube, game, body, added FROM  reviews WHERE game = '$game_id' ") or die (mysql_error());

?>
<div class="blog_part_left_box">
<?php 
if (mysql_num_rows($res) > 0) {	
while($row = mysql_fetch_array($res))
{ 
	$youtube = $row["youtube"];
?>
<br/>
<table>
<tr>
<td style="border:none;">		<?
				$ytarray=explode("/", "$youtube");
				$ytendstring=end($ytarray);
				$ytendarray=explode("?v=", $ytendstring);
				$ytendstring=end($ytendarray);
				$ytendarray=explode("&", $ytendstring);
				$ytcode=$ytendarray[0];
				echo "<center><iframe width=\"256\" height=\"140\" src=\"http://www.youtube.com/embed/$ytcode\" frameborder=\"0\" allowfullscreen></iframe></center>";
		?></td>
<td style="border:none;"><a href="readReview.php?post=<?php echo $row['id']; ?>" style="	text-decoration:none; color: #4f5254; font-size: 18px;"><u><?php echo $row['title']; ?></u></a><br/><?php $string = strip_tags(format_comment($row['body'])); echo substr($string, 0,225); ?>...<br/></td>
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

