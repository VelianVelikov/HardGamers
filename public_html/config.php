<?
ob_start("ob_gzhandler");

require "include/main.php";

dbconn();

$do = $_GET['do'];

if (get_user_class() < UC_ADMIN) {
    stderr("������", "��� ������ ������� �����");
}

stdhead("������������");

if ($do == "configsite") {

    $sitename = addslashes(trim($_POST['sitename']));
    $sitedomain = addslashes(trim($_POST['sitedomain']));
    $sitemail = addslashes(trim($_POST['sitemail']));
    $important = addslashes(trim($_POST['important']));
    $siteonline = $_POST['siteonline'];
    $siteclreg = $_POST['siteclreg'];


    if (empty($sitename) || empty($sitedomain) || empty($sitemail)) {

        echo "<div class=blog_part_left_box><div class=gamepad_ico></div><div class=blog_part_left_smallheader>
			  <font size=5>������</font>
		      </div><div class=error><center>���� ��������� ������ ������<br><a href=config.php>�������</a> ��� ������</center></div></div>";

        stdfoot();
        die();
    }

    $a = mysql_query("UPDATE config SET sitename = '$sitename', sitedomain = '$sitedomain', sitemail = '$sitemail', important = '$important', siteonline = '$siteonline', siteclreg = '$siteclreg' WHERE id = '1'") or die(mysql_error());

    echo "<div class=blog_part_left_box><div class=gamepad_ico></div><div class=blog_part_left_smallheader>
		  <font size=5>���������</font>
		  </div>
		  <div class=error><center>��� ������� ����������������� �����<br><a href=config.php>�������</a> ��� ������</center></div></div>";
} else {

// �� ��� ����� � OOP, �� ��� ����� �� �� ������� :]
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
	<font size="5">������������</font>
	</div>
	<center>
    <form method="post" action="config.php?do=configsite">
��� �� �����:<br><input type="text" size=40 name="sitename" value="<?= $sitename ?>"><br>

������ �� �����:<br><input type="text" size=40 name="sitedomain" value="<?= $sitedomain ?>"><br>

Email �� �����:<br><input type="text" size=40 name="sitemail" value="<?= $sitemail ?>"><br>

����� ���������:<br><textarea name="important" cols="70" rows="7" style="border: 1px solid #000;"><?= $important ?></textarea><br/>

����� � ����� :<br><input name="siteonline" value="yes" type=radio <?php
    if ($siteonline == "yes") {
        echo "checked";
    } else {
        echo "";
    }
    ?>>�� <input name="siteonline" value="no" type=radio <?php
                                                        if ($siteonline == "no") {
                                                            echo "checked";
                                                        } else {
                                                            echo "";
                                                        }
    ?>>��
<br/>������������� �� ��������� :<br><input name="siteclreg" value="no" type=radio <?php
                                                        if ($siteclreg == "no") {
                                                            echo "checked";
                                                        } else {
                                                            echo "";
                                                        }
    ?>>�� <input name="siteclreg" value="yes" type=radio <?php
                                                                     if ($siteclreg == "yes") {
                                                                         echo "checked";
                                                                     } else {
                                                                         echo "";
                                                                     }
    ?>>��
           <br/><input type="submit" value="������� !">
    </form>
	</center>
	</div>
    <?php
}

stdfoot();
?>