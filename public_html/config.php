<?
ob_start("ob_gzhandler");

require "include/main.php";

dbconn();

$do = $_GET['do'];

if (get_user_class() < UC_ADMIN) {
    stderr("Грешка", "Вие нямате нужните права");
}

stdhead("Конфигурация");

if ($do == "configsite") {

    $sitename = addslashes(trim($_POST['sitename']));
    $sitedomain = addslashes(trim($_POST['sitedomain']));
    $sitemail = addslashes(trim($_POST['sitemail']));
    $important = addslashes(trim($_POST['important']));
    $siteonline = $_POST['siteonline'];
    $siteclreg = $_POST['siteclreg'];


    if (empty($sitename) || empty($sitedomain) || empty($sitemail)) {

        echo "<div class=blog_part_left_box><div class=gamepad_ico></div><div class=blog_part_left_smallheader>
			  <font size=5>Грешка</font>
		      </div><div class=error><center>Моля попълнете всички полета<br><a href=config.php>Обратно</a> към Панела</center></div></div>";

        stdfoot();
        die();
    }

    $a = mysql_query("UPDATE config SET sitename = '$sitename', sitedomain = '$sitedomain', sitemail = '$sitemail', important = '$important', siteonline = '$siteonline', siteclreg = '$siteclreg' WHERE id = '1'") or die(mysql_error());

    echo "<div class=blog_part_left_box><div class=gamepad_ico></div><div class=blog_part_left_smallheader>
		  <font size=5>Съобщение</font>
		  </div>
		  <div class=error><center>Вие успешно преконфигурирахте сайта<br><a href=config.php>Обратно</a> към Панела</center></div></div>";
} else {

// не съм добър в OOP, но тук реших да го пробвам :]
    $query = mysql_query("SELECT * FROM config WHERE id = '1'");
    $row = mysql_fetch_object($query);

    $sitename = $row->sitename;
    $sitedomain = $row->sitedomain;
    $sitemail = $row->sitemail;
    $important = $row->important;
    $siteonline = $row->siteonline;
    $siteclreg = $row->siteclreg;


    ?>
	<div class="blog_part_left_box"><div class="gamepad_ico"></div><div class="blog_part_left_smallheader">
	<font size="5">Конфигурация</font>
	</div>
	<center>
    <form method="post" action="config.php?do=configsite">
Име на сайта:<br><input type="text" size=40 name="sitename" value="<?= $sitename ?>"><br>

Домейн на сайта:<br><input type="text" size=40 name="sitedomain" value="<?= $sitedomain ?>"><br>

Email на сайта:<br><input type="text" size=40 name="sitemail" value="<?= $sitemail ?>"><br>

Важно съобщение:<br><textarea name="important" cols="70" rows="7" style="border: 1px solid #000;"><?= $important ?></textarea><br/>

Сайта е спрян :<br><input name="siteonline" value="yes" type=radio <?php
    if ($siteonline == "yes") {
        echo "checked";
    } else {
        echo "";
    }
    ?>>Не <input name="siteonline" value="no" type=radio <?php
                                                        if ($siteonline == "no") {
                                                            echo "checked";
                                                        } else {
                                                            echo "";
                                                        }
    ?>>Да
<br/>Регистрациите са затворени :<br><input name="siteclreg" value="no" type=radio <?php
                                                        if ($siteclreg == "no") {
                                                            echo "checked";
                                                        } else {
                                                            echo "";
                                                        }
    ?>>Не <input name="siteclreg" value="yes" type=radio <?php
                                                                     if ($siteclreg == "yes") {
                                                                         echo "checked";
                                                                     } else {
                                                                         echo "";
                                                                     }
    ?>>Да
           <br/><input type="submit" value="Промени !">
    </form>
	</center>
	</div>
    <?php
}

stdfoot();
?>