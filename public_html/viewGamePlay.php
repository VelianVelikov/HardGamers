<?
ob_start("ob_gzhandler");

require "include/main.php";
dbconn(true);

	$gameplayid = (int)$_GET['post'];
	
	if(!isset($gameplayid) || !is_numeric($gameplayid) || $gameplayid <1)
	{
		header("Location: index.php");
		exit();
	}
	
	$result = mysql_query("SELECT * FROM  gameplays WHERE id = '$gameplayid'");
	if ($post = mysql_fetch_array($result)) {
	$youtube = $post["youtube"];
	$added = $post["added"] . "&nbsp;(����� " . (get_elapsed_time(sql_timestamp_to_unix_timestamp($post["added"]))) . ")";
?>
		<? stdhead("" . $post[title]);?>
		<div class="blog_part_left_box">
		<div id="post_info">
		<?php
$gameplayid = (int)$_GET['post'];
$res = mysql_query("SELECT id, userid FROM gameplays WHERE id = '$gameplayid'") or sqlerr(__FILE__, __LINE__);	
    while ($arr = mysql_fetch_array($res)) {
        $userid = $arr["userid"];
		$returnto = $_GET["returnto"];
		
	        $res2 = mysql_query("SELECT username, avatar, donor FROM users WHERE id = $userid") or sqlerr(__FILE__, __LINE__);
        $arr2 = mysql_fetch_array($res2);

        $postername = $arr2["username"];
		$avatar = $arr2["avatar"];

        if ($postername == "")
            $by = "unknown[$userid]";
        else
            $by = "<a href=member.php?id=$userid><b>$postername</b></a>";
		if ($avatar == "")
			print("<table><tr><td width=70px valign=top align=right><img src=pic/noavatar.jpg width=65px border:1px solid #222;'></td>");
		else	{
        print("<table><tr><td width=70px valign=top align=right><img src=$avatar width=65px border:1px solid #222;'></td>");
		}

        print("<td>GamePlay ��&nbsp$by");
	?>
	<br/>���������:
	<?php
		$q = mysql_query("SELECT * FROM gamecat") or die (mysql_error());
		while($c = mysql_fetch_assoc($q))
		{
			if($post[game] == $c[game_id])
			{
				print "<b>$c[name]</b>";
			}
		}	
	?>
	<?php echo " | ��������: $added"; ?>
	<?
		if ($CURUSER["id"] == $userid){
		echo "<br/><a href=addGamePlay.php?action=edit&gameplayid=$gameplayid><u>����������</u></a> | <a href=addGamePlay.php?action=delete&gameplayid=$gameplayid><u>������</u></a></td></tr></table>";
		}
		else{
		    print("<br><a href=pms.php?receiver=$userid><img src=pic/pm.png height=25px width=110px></a></td></tr></table>");
		}
    }
	?>
		</div>
		<p><font size="5"><?php echo $post[title]; ?></font></p>
		<?
				$ytarray=explode("/", "$youtube");
				$ytendstring=end($ytarray);
				$ytendarray=explode("?v=", $ytendstring);
				$ytendstring=end($ytendarray);
				$ytendarray=explode("&", $ytendstring);
				$ytcode=$ytendarray[0];
				echo "<center><iframe width=\"420\" height=\"315\" src=\"http://www.youtube.com/embed/$ytcode\" frameborder=\"0\" allowfullscreen></iframe></center>";
		?>

		<p><?php echo format_comment($post[body]); ?></p>
</div>	

<?php
stdfoot();
}
hit_end();
?>
