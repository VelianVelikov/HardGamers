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
            $avatar = "<div id=content_avatar><a href=profile.php><img src=$CURUSER[avatar] width=100px style='margin-bottom:5px; border:1px solid #222;'></a><br></div>";
        } else {
            $avatar = "<div id=content_avatar><a href=profile.php><img src=\"pic/noavatar.jpg\" width=100px style='margin-bottom:5px; border:1px solid #222;'></a><br></div>";
        }
        echo $avatar;
        echo "<div id=content_profile_right><br/>";
        if ($messages) {
            print("<font face=\"tahoma\" size=\"2\">&raquo;</font>&nbsp; <a href=inbox.php>Съобщения</a>: $messages");
        } else {
            print("<font face=\"tahoma\" size=\"2\">&raquo;</font>&nbsp; <a href=inbox.php>Съобщения</a>: 0");
        }
		echo "<br/><font face=\"tahoma\" size=\"2\">&raquo;</font>&nbsp; <a href=profile.php>Редактирай</a>";
		echo "<br/><font face=\"tahoma\" size=\"2\">&raquo;</font>&nbsp; <a href=logout.php>Изход</a></div>";
		print "<div id=content_profile_facilities><h1>Плъгини:</h1>";
        if (get_user_class() >= UC_MOD) {
            echo "<br/><font face=\"tahoma\" size=\"2\">&raquo;</font>&nbsp; <a href=admincp.php>Панел за управление</a>";
        }
		if (get_user_class() >= UC_VIP) {
			echo "<br/><font face=\"tahoma\" size=\"2\">&raquo;</font>&nbsp; <a href=addReview.php>Добави ревю</a>";
        }
		if (get_user_class() >= UC_USER) {
			echo "<br/><font face=\"tahoma\" size=\"2\">&raquo;</font>&nbsp; <a href=addGamePlay.php>Добави Gameplay</a>";
        }		
		if (get_user_class() >= UC_USER) {
			echo "<br/><font face=\"tahoma\" size=\"2\">&raquo;</font>&nbsp; <a href=onlineusers.php>Онлайн потребители</a>";
        }
		print "</div>";
    }
    ?>	
	