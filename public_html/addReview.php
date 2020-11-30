<?php

require "include/main.php";

dbconn();
loggedinorreturn();

if (get_user_class() < UC_VIP)
    stderr("Грешка", "Вие нямате нужните права, за да разглеждате тази страница.");

$action = $_GET["action"];

// Изтриване на новините

if ($action == 'delete') {

$reviewid = (int)$_GET['reviewid'];
	if (!is_valid_id($reviewid))
	stderr("Грешка", "Невалидно ID - Грешка 1.");
$res = mysql_query("SELECT id, userid FROM reviews WHERE id = '$reviewid'") or sqlerr(__FILE__, __LINE__);
    while ($arr = mysql_fetch_array($res)) {
        $userid = $arr["userid"];
		$returnto = $_GET["returnto"];
        $res2 = mysql_query("SELECT username, id FROM users WHERE id = $userid") or sqlerr(__FILE__, __LINE__);
        $arr2 = mysql_fetch_array($res2);


		if ($CURUSER["id"] == $userid){
		$sure = $_GET["sure"];
		if (!$sure){
        stderr("Внимание!", "<a href=?action=delete&reviewid=$reviewid&returnto=$returnto&sure=1>Изтрий</a> !");
		}
		mysql_query("DELETE FROM reviews WHERE id=$reviewid") or sqlerr(__FILE__, __LINE__);

    if ($returnto != "")
        header("Location: $returnto");
    else
        $warning = "Ревюто бе изтрито успешно.";
		}
    }


		

    
}

// Добавяне на новини

if ($action == 'add') {

    $title = $_POST["title"];
    if (!$title)
        stderr("Грешка", "Не оставяйте нищо празно!");
		
	$youtube = $_POST["youtube"];
    if (!$youtube)
        stderr("Грешка", "Не оставяйте нищо празно!");
		
	$body = $_POST["body"];
    if (!$body)
        stderr("Грешка", "Не оставяйте нищо празно!");

    $added = $_POST["added"];
    if (!$added)
        $added = sqlesc(get_date_time());
		
	$game = $_POST['game'];
	
    mysql_query("INSERT INTO reviews (userid, added, title, youtube, body, game) VALUES (" .
                    $CURUSER['id'] . ", $added, " . sqlesc($title) . ", " . sqlesc($youtube) . ", " . sqlesc($body) . ", " . sqlesc($game) . ")") or sqlerr(__FILE__, __LINE__);
    if (mysql_affected_rows() == 1)
        $warning = "Ревюто бе добавено успешно.";
    else
        stderr("Грешка", "Моля опитайте отново.");
}

// Редактиране на новини

if ($action == 'edit') {

    $reviewid = $_GET["reviewid"];
    $result = mysql_query("SELECT * FROM reviews WHERE id=$reviewid") or sqlerr(__FILE__, __LINE__);
	    while ($post = mysql_fetch_array($result)) {
        $userid = $post["userid"];
		$returnto = $_GET["returnto"];
        $result2 = mysql_query("SELECT username, id FROM users WHERE id = $userid") or sqlerr(__FILE__, __LINE__);
        $post2 = mysql_fetch_array($result2);

		if ($CURUSER["id"] == $userid){
    if(isset($_POST['editPost'])) {
		$title = htmlspecialchars($_POST["title"]);
		if (!$title)
			stderr("Грешка", "Не оставяйте нищо празно!");
		$youtube = htmlspecialchars($_POST["youtube"]);
		if (!$youtube)
			stderr("Грешка", "Не оставяйте нищо празно!");
		$body = htmlspecialchars($_POST["body"]);
		if (!$body)
			stderr("Грешка", "Не оставяйте нищо празно!");
		$game_id = $_POST['game'];


				mysql_query("UPDATE reviews SET title='$title', youtube='$youtube', body='$body', game='$game_id' WHERE id='$reviewid'") or sqlerr(__FILE__, __LINE__);

				$returnto = $_POST['returnto'];

				if ($returnto != "")
					header("Location: $returnto");
				else
					$warning = "Ревюто бе редактирано успешно.";
			}
			else {
				$returnto = $_GET['returnto'];
				stdhead("Редактиране на ревю");
				print("<div class=blog_part_left_box><div class=gamepad_ico></div><div class=blog_part_left_smallheader><font size=5>Редактиране на ревю</font></div>");
				print("<center><form method=post action=?action=edit&reviewid=$reviewid>\n");
				print("<input type=hidden name=returnto value=$returnto>\n");
?>
	Заглавие: <br/><input type="text" name="title" value="<?php echo $post[title]; ?>" maxlength="125"/></br>
	Youtube видео (линк): <br/><input type="text" name="youtube" value="<?php echo $post[youtube]; ?>" maxlength="43"/></br>
<?php
				print("<script>edToolbar('editReview'); </script><textarea name=body cols=70 rows=7 style='border: 1px solid #000;' id=editReview class=bb_ed>" . htmlspecialchars($post["body"]) . "</textarea><br>\n");
				print("<br/>Категория: <br/><select name=game>");
					$q = mysql_query("SELECT * FROM gamereview") or die (mysql_error());
					while($c = mysql_fetch_assoc($q))
					{
						if($post[game] == $c[game_id])
						{
							print '<option value="'.$c[game_id].'" selected="selected">'.$c[name]."</option>\n";
						}
						else
						{
						print '<option value='.$c[game_id].'>'.$c[name]."</option>\n";
						}
					}	

				print("</select><br/><input type=submit value='Редактирай'  name=editPost class=btn>\n");
				print("</form></center></div>\n");
				stdfoot();
				die;
			}
		
		}
    }

}

// Самата страница с новините

stdhead("Добавяне на ревю");
print("<div class=blog_part_left_box><div class=gamepad_ico></div><div class=blog_part_left_smallheader><font size=5>Добавяне на ревю</font></div>");
if ($warning)
print("<center><font size=3 color=green>($warning)</font></center>");
print("<center><form method=post action=?action=add>\n");
print("Заглавие: <br/><input type=text name=title maxlength=125/></br>");
print("Youtube видео (линк): <br/><input type=text name=youtube maxlength=43/></br>");
print("<script>edToolbar('addReview'); </script><textarea name=body cols=70 rows=7 style='border: 1px solid #000;' id=addReview class=bb_ed></textarea>\n");
print("<br/>Категория: <br/><select name=game>");
	$q = mysql_query("SELECT * FROM gamereview") or die (mysql_error());
	while($c = mysql_fetch_assoc($q))
	{
		print '<option value='.$c[game_id].'>'.$c[name]."</option>\n";	
	}

print("</select></br><input type=submit value='Давай' class=btn>\n");
print("</form></center></div>\n");


stdfoot();
die;
?>