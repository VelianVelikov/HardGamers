<td style="width:165px; border:none; padding:10px; padding-top:10px; padding-right:0px;" valign="top">

    <?php
    if ($CURUSER) {

        // проверяваме за съобщения
        $res1 = mysql_query("SELECT COUNT(*) FROM messages WHERE receiver=" . $CURUSER["id"] . " AND location IN ('in', 'both')") or print(mysql_error());
        $arr1 = mysql_fetch_row($res1);
        $messages = $arr1[0];
        $res1 = mysql_query("SELECT COUNT(*) FROM messages WHERE receiver=" . $CURUSER["id"] . " AND location IN ('in', 'both') AND unread='yes'") or print(mysql_error());
        $arr1 = mysql_fetch_row($res1);
        $unread = $arr1[0];
        $res1 = mysql_query("SELECT COUNT(*) FROM messages WHERE sender=" . $CURUSER["id"] . " AND location IN ('out', 'both')") or print(mysql_error());
        $arr1 = mysql_fetch_row($res1);
        $outmessages = $arr1[0];
        $res1 = mysql_query("SELECT COUNT(*) FROM messages WHERE receiver=" . $CURUSER["id"] . " && unread='yes'") or die("Грешка!");
        $arr1 = mysql_fetch_row($res1);
        $unread = $arr1[0];

        if ($CURUSER['avatar']) {
            $avatar = "<center><a href=profile.php><img src=$CURUSER[avatar] width=100px style='margin-bottom:5px; border:1px solid #222;'></a><br></center>";
        } else {
            $avatar = "<center><a href=profile.php><img src=pic/noavatar.jpg width=100px style='margin-bottom:5px; border:1px solid #222;'></a><br></center>";
        }
        begin_block("<a href=member.php?id=" . $CURUSER['id'] . "><font color=#fff>" . $CURUSER['username'] . "</font></a>", "left");
        echo $avatar;
        echo "<hr>";
        if ($messages) {
            print("<font face=\"tahoma\" size=\"2\">&raquo;</font>&nbsp; <a href=inbox.php>Съобщения</a> : $messages");
        } else {
            print("<font face=\"tahoma\" size=\"2\">&raquo;</font>&nbsp; <a href=inbox.php>Съобщения</a> : 0");
        }
        if (get_user_class() >= UC_MOD) {
            echo "<hr><font face=\"tahoma\" size=\"2\">&raquo;</font>&nbsp; <a href=admincp.php>Админ Панел</a>";
        }
		if (get_user_class() >= UC_VIP) {
			echo "<hr><font face=\"tahoma\" size=\"2\">&raquo;</font>&nbsp; <a href=addReview.php>Добави ревю</a>";
        }
		if (get_user_class() >= UC_USER) {
			echo "<hr><font face=\"tahoma\" size=\"2\">&raquo;</font>&nbsp; <a href=addGameplay.php>Добави Gameplay</a>";
        }
        echo "<hr><font face=\"tahoma\" size=\"2\">&raquo;</font>&nbsp; <a href=logout.php>Изход</a>";
        end_block();
    }
    begin_block("Категории", "left");
    ?>	
	<?php
	$catId = (int)$_GET['post'];

	
	$result = mysql_query("SELECT * FROM  categories ORDER BY cat_id = '$catID' ") or die (mysql_error());
	while($post = mysql_fetch_assoc($result)){
	echo'
	<font face="tahoma" size="2">&raquo;</font>&nbsp;<a href="viewCategory.php?post='.htmlspecialchars_decode($post['cat_id']).'">'.htmlspecialchars_decode($post['name']).'</a><br>';
	}
	?>
    <?php
    end_block();
    if ($CURUSER) {
        begin_block("На линия");
        include_once 'onlineusers.php';
        end_block();
    }
    ?> 
</td><?
    