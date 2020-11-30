<?
ob_start("ob_gzhandler");

require "include/main.php";
dbconn(true);
$res = mysql_query("SELECT id, title, youtube, body FROM gameplays ORDER BY `id` DESC LIMIT 0,10") or sqlerr(__FILE__, __LINE__);
if (mysql_num_rows($res) > 0) {
		while($row = mysql_fetch_array($res))
		{
		$youtube = $row["youtube"];
			?>
		<link rel="stylesheet" href="styles/default.css" type="text/css">
		<base target="_parent" />
		<div class="lastgameplay">
		<table width="255px">
		<tr>
		<td>
		<?
				$ytarray=explode("/", "$youtube");
				$ytendstring=end($ytarray);
				$ytendarray=explode("?v=", $ytendstring);
				$ytendstring=end($ytendarray);
				$ytendarray=explode("&", $ytendstring);
				$ytcode=$ytendarray[0];
				echo "<a href=viewGamePlay.php?post=$row[id]><img src=\"http://img.youtube.com/vi/$ytcode/mqdefault.jpg\" height=143 width=255></a>";
		?>
		<p><b><a href="viewGamePlay.php?post=<?php echo $row['id']; ?>"><?php $string = strip_tags(format_comment($row['title'])); echo substr($string, 0,35); if (strlen($string) >= 34) { print "..."; }?></a></b></div>
		<br/><font color="#9E9E9E"><?php $string = strip_tags(format_comment($row['body'])); echo substr($string, 0,75); ?>...</font></p>
		</td>
		</tr>
		</table>
		<?php
			}

			}

		hit_end();
		?>

