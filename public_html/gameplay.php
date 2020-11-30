<?php

require "include/main.php";

dbconn();

// Самата страница с новините

	stdhead("Ревюта");
	
		$game_id = (int)$_GET['post'];
?>
<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
<font size="5">Категории, GamePlay</font>
</div>
<div class="gamelist">

<?
		$result = mysql_query("SELECT * FROM  gamecat ORDER BY name ASC") or die (mysql_error());

			while($post = mysql_fetch_assoc($result)){
				echo '<center><table><tr width=100%><td align=right><img src="'.htmlspecialchars_decode($post['img']).'"></td><td align=left ><li class=active><b>»</b><a href="categoryGamePlay.php?post='.htmlspecialchars_decode($post['game_id']).'">'.htmlspecialchars_decode($post['name']).'</a><br></td></tr></table></center>
				';
			
			}
?>

</div></div>
<?
stdfoot();
die;
?>