<?
// Грешки
error_reporting(E_ALL ^ E_NOTICE);
require_once("secrets.php");
require_once("cleanup.php");

if (!isset($HTTP_POST_VARS) && isset($_POST)) {
    $HTTP_POST_VARS = $_POST;
    $HTTP_GET_VARS = $_GET;
    $HTTP_SERVER_VARS = $_SERVER;
    $HTTP_COOKIE_VARS = $_COOKIE;
    $HTTP_ENV_VARS = $_ENV;
    $HTTP_POST_FILES = $_FILES;
}

function strip_magic_quotes($arr) {
    foreach ($arr as $k => $v) {
        if (is_array($v)) {
            $arr[$k] = strip_magic_quotes($v);
        } else {
            $arr[$k] = stripslashes($v);
        }
    }

    return $arr;
}

if (get_magic_quotes_gpc()) {
    if (!empty($_GET)) {
        $_GET = strip_magic_quotes($_GET);
    }
    if (!empty($_POST)) {
        $_POST = strip_magic_quotes($_POST);
    }
    if (!empty($_COOKIE)) {
        $_COOKIE = strip_magic_quotes($_COOKIE);
    }
}

function local_user() {
    global $HTTP_SERVER_VARS;

    return $HTTP_SERVER_VARS["SERVER_ADDR"] == $HTTP_SERVER_VARS["REMOTE_ADDR"];
}

dbconn();

$mainquery = mysql_query("SELECT * FROM config");
while ($rowmain = mysql_fetch_object($mainquery)) {
    $sitename = $rowmain->sitename;
    $sitedomain = $rowmain->sitedomain;
    $sitemail = $rowmain->sitemail;
    $important = $rowmain->important;
    $siteonline = $rowmain->siteonline;
    $siteclreg = $rowmain->siteclreg;
}

// дали сайтът е активен
$SITE_ONLINE = $siteonline;

$signup_timeout = 86400 * 3;


// включване и изключване на регистрациите
$maxusers = $siteclreg;

if ($HTTP_SERVER_VARS["HTTP_HOST"] == "")
    $HTTP_SERVER_VARS["HTTP_HOST"] = $HTTP_SERVER_VARS["SERVER_NAME"];
$BASEURL = "http://" . $HTTP_SERVER_VARS["HTTP_HOST"];

$MEMBERSONLY = true;

// Email-а на сайта
$SITEEMAIL = $sitemail;

// Името на сайта
$SITENAME = $sitename;

// Името на сайта
$IMPORTANT = $important;


// адреса на сайта
$DEFAULTBASEURL = $sitedomain;

$autoclean_interval = 900;
$pic_base_url = "pic/";

// IP Валидация /Идентификация/
function validip($ip) {
    if (!empty($ip) && ip2long($ip) != -1) {
        $reserved_ips = array(
            array('0.0.0.0', '2.255.255.255'),
            array('10.0.0.0', '10.255.255.255'),
            array('127.0.0.0', '127.255.255.255'),
            array('169.254.0.0', '169.254.255.255'),
            array('172.16.0.0', '172.31.255.255'),
            array('192.0.2.0', '192.0.2.255'),
            array('192.168.0.0', '192.168.255.255'),
            array('255.255.255.0', '255.255.255.255')
        );

        foreach ($reserved_ips as $r) {
            $min = ip2long($r[0]);
            $max = ip2long($r[1]);
            if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max))
                return false;
        }
        return true;
    }
    else
        return false;
}

// Разпознаване на реалните IP Адреси
function getip() {
    if (isset($_SERVER)) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
    } else {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } else {
            $ip = getenv('REMOTE_ADDR');
        }
    }

    return $ip;
}

// датабаза
function dbconn($autoclean = false) {
    global $mysql_host, $mysql_user, $mysql_pass, $mysql_db, $HTTP_SERVER_VARS;

    if (!mysql_connect($mysql_host, $mysql_user, $mysql_pass)) {
        switch (mysql_errno()) {
            case 1040:
            case 2002:
                if ($HTTP_SERVER_VARS[REQUEST_METHOD] == "GET")
                    die("<html><head><meta http-equiv=refresh content=\"5 $HTTP_SERVER_VARS[REQUEST_URI]\"></head><body><table border=0 width=100% height=100%><tr><td><h3 align=center>В момента има огромно натоварване, моля изчакайте ...</h3></td></tr></table></body></html>");
                else
                    die("В момента има огромно натоварване, моля изчакайте ...");
            default:
                die("[" . mysql_errno() . "] dbconn: mysql_connect: " . mysql_error());
        }
    }
    mysql_select_db($mysql_db)
            or die('dbconn: mysql_select_db: ' + mysql_error());

    userlogin();

    if ($autoclean)
        register_shutdown_function("autoclean");
}

function userlogin() {
    global $HTTP_SERVER_VARS, $SITE_ONLINE;
    unset($GLOBALS["CURUSER"]);

    $ip = getip();
    $nip = ip2long($ip);
    $res = mysql_query("SELECT * FROM bans WHERE $nip >= first AND $nip <= last") or sqlerr(__FILE__, __LINE__);
    if (mysql_num_rows($res) > 0) {
        header("HTTP/1.0 403 Забранено");
        print("<html><body><h1>403 Забранено</h1>Този IP Адрес е бил баннът.</body></html>\n");
        die;
    }

    if (!$SITE_ONLINE || empty($_COOKIE["uid"]) || empty($_COOKIE["pass"]))
        return;
    $id = 0 + $_COOKIE["uid"];
    if (!$id || strlen($_COOKIE["pass"]) != 32)
        return;
    $res = mysql_query("SELECT * FROM users WHERE id = $id AND enabled='yes' AND status = 'confirmed'"); // or die(mysql_error());
    $row = mysql_fetch_array($res);
    if (!$row)
        return;
    $sec = hash_pad($row["secret"]);
    if ($_COOKIE["pass"] !== $row["passhash"])
        return;
    mysql_query("UPDATE users SET last_access='" . get_date_time() . "', ip='$ip' WHERE id=" . $row["id"]); // or die(mysql_error());
    $row['ip'] = $ip;
    $GLOBALS["CURUSER"] = $row;
}

function autoclean() {
    global $autoclean_interval;

    $now = time();
    $docleanup = 0;

    $res = mysql_query("SELECT value_u FROM avps WHERE arg = 'lastcleantime'");
    $row = mysql_fetch_array($res);
    if (!$row) {
        mysql_query("INSERT INTO avps (arg, value_u) VALUES ('lastcleantime',$now)");
        return;
    }
    $ts = $row[0];
    if ($ts + $autoclean_interval > $now)
        return;
    mysql_query("UPDATE avps SET value_u=$now WHERE arg='lastcleantime' AND value_u = $ts");
    if (!mysql_affected_rows())
        return;

    docleanup();
}

function unesc($x) {
    if (get_magic_quotes_gpc())
        return stripslashes($x);
    return $x;
}

function mkprettytime($s) {
    if ($s < 0)
        $s = 0;
    $t = array();
    foreach (array("60:sec", "60:min", "24:hour", "0:day") as $x) {
        $y = explode(":", $x);
        if ($y[0] > 1) {
            $v = $s % $y[0];
            $s = floor($s / $y[0]);
        }
        else
            $v = $s;
        $t[$y[1]] = $v;
    }

    if ($t["day"])
        return $t["day"] . "d " . sprintf("%02d:%02d:%02d", $t["hour"], $t["min"], $t["sec"]);
    if ($t["hour"])
        return sprintf("%d:%02d:%02d", $t["hour"], $t["min"], $t["sec"]);
    return sprintf("%d:%02d", $t["min"], $t["sec"]);
}

function mkglobal($vars) {
    if (!is_array($vars))
        $vars = explode(":", $vars);
    foreach ($vars as $v) {
        if (isset($_GET[$v]))
            $GLOBALS[$v] = unesc($_GET[$v]);
        elseif (isset($_POST[$v]))
            $GLOBALS[$v] = unesc($_POST[$v]);
        else
            return 0;
    }
    return 1;
}

function tr($x, $y, $noesc = 0) {
    if ($noesc)
        $a = $y;
    else {
        $a = htmlspecialchars($y);
        $a = str_replace("\n", "<br />\n", $a);
    }
    print("<tr><td class=\"heading\" valign=\"top\" align=\"right\">$x</td><td valign=\"top\" align=left>$a</td></tr>\n");
}

function tr2($x, $y, $noesc = 0, $brdbt = none) {
    if ($noesc)
        $a = $y;
    else {
        $a = htmlspecialchars($y);
        $a = str_replace("\n", "<br />\n", $a);
    }
    print("<tr><td valign=\"top\" style='padding:5px; $brdbt' align=\"left\"><b>$x</b><br>$a</td></tr>\n");
}

function validemail($email) {
    return preg_match('/^[\w.-]+@([\w.-]+\.)+[a-z]{2,6}$/is', $email);
}

function sqlesc($x) {
    return "'" . mysql_real_escape_string($x) . "'";
}

function sqlwildcardesc($x) {
    return str_replace(array("%", "_"), array("\\%", "\\_"), mysql_real_escape_string($x));
}

function urlparse($m) {
    $t = $m[0];
    if (preg_match(',^\w+://,', $t))
        return "<a href=\"$t\">$t</a>";
    return "<a href=\"http://$t\">$t</a>";
}

function parsedescr($d, $html) {
    if (!$html) {
        $d = htmlspecialchars($d);
        $d = str_replace("\n", "\n<br>", $d);
    }
    return $d;
}

function stdhead($title = "", $important = "", $msgalert = true) {
    global $CURUSER, $HTTP_SERVER_VARS, $PHP_SELF, $SITE_ONLINE, $SITENAME, $IMPORTANT;

    if ($SITE_ONLINE == "no" && get_user_class() < UC_ADMIN)
        die("В момента протичат обновявания по сайта - моля бъдете търпеливи<br>");

    header("Content-Type: text/html; charset=windows-1251");
    if ($title == "")
        $title = $SITENAME;
    else
        $title = "$SITENAME :: " . htmlspecialchars($title);
	if (!$IMPORTANT) {
        $IMPORTANT = "";
	}
	else {
        $important = "<div id=fixed><div id=topbar><marquee scrollamount=4>$IMPORTANT</marquee></div></div><style>#desk {	margin-top: 17px; } </style>";
    }
	if ($CURUSER) {
        $ss_a = mysql_fetch_array(mysql_query("select uri from stylesheets where id=" . $CURUSER["stylesheet"]));
        if ($ss_a)
            $ss_uri = $ss_a["uri"];
    }
    if (!$ss_uri) {
        ($r = mysql_query("SELECT uri FROM stylesheets WHERE id=1")) or die(mysql_error());
        ($a = mysql_fetch_array($r)) or die(mysql_error());
        $ss_uri = $a["uri"];
    }
    if ($msgalert && $CURUSER) {
        $res = mysql_query("SELECT COUNT(*) FROM messages WHERE receiver=" . $CURUSER["id"] . " && unread='yes'") or die("OopppsY!");
        $arr = mysql_fetch_row($res);
        $unread = $arr[0];
    }
    ?>
                <html><head>
            <title><?= $title ?></title>
            <link rel="stylesheet" href="styles/<?= $ss_uri ?>" type="text/css">
			<style>
			#events iframe :: -webkit-scrollbar-thumb {
			background-color: darkgrey;
			}
			</style>
			<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
			<script type="text/javascript" src="bbeditor/ed.js"></script>  
            <script type="text/javascript" language="JavaScript">
                function Show(d) {
                    document.getElementById(d).style.display = "none";
                }
                function Hide(d) {
                    document.getElementById(d).style.display = "block";
                }
                function ShowHide(d) {
                    if(document.getElementById(d).style.display == "none") { document.getElementById(d).style.display = "block"; }
                    else { document.getElementById(d).style.display = "none"; }
                }
            </script>
			<script src="http://code.jquery.com/jquery-1.5.js"></script>
			<script>
				  function countChar(val) {
					var len = val.value.length;
					if (len >= 500) {
					  val.value = val.value.substring(0, 500);
					} else {
					  $('#charNum').text(500 - len);
					}
				  };
			</script>
			<script type="text/javascript" src="./js/slider.js"></script>
			<script type="text/javascript">
				var i = setInterval(function () {
					clearInterval(i);
					document.getElementById("load").style.display = "none";
					document.getElementById("cont").style.display = "block";
				  
				}, 2000);
			</script>
		<base target="_parent" />
        </head>
        <body>
		<?= $important ?>
<div id="desk">
    <div class="desk_float"><div id="logo"></div></div>
		<div class="desk_float">
			<div id="follow_us"></div>
			<div id="ribbons"><img src="styles/images/twitch.png" alt="Последвай ни в Twitch" height="65" width="43">
								 <img src="styles/images/rss.png" alt="Rss" height="65" width="43">
								 <img src="styles/images/youtube.png" alt="Последвай ни в Youtube" height="65" width="43">
								 <img src="styles/images/twitter.png" alt="Последвай ни в Twitter" height="65" width="43">
								 <img src="styles/images/facebook.png" alt="Последвай ни в Facebook" height="65" width="43"></div>
			</div>
            <!-- главното меню -->
            <?php include 'styles/mainmenu.php'; ?>
            <!-- край на главното меню -->
</div>
<div id="container">
<?  
		if ($unread) {
		print("<center><p style= margin-top:-10px;><table border=0 cellspacing=0 cellpadding=10 bgcolor=red><tr><td style='padding: 10px; background: red'>\n");
		print("<b><a href=inbox.php><font color=white>Имате $unread&nbsp;" . ($unread > 1 ? "непрочетени съобщения" : "непрочетено съобщение") . "!</font></a></b>");
		print("</td></tr></table></p></center>\n");
		}
?>
	<div id="content">
		<div class="content_boxes"><div class="content_box"><div id="events_ico"></div>
		<div class="content_header">
		<font size="5">СЪБИТИЯ</font>
		</br><font size="2">Какво ни очаква скоро?</font>
		</div>
		<div class="events">
		<?php
		$res = mysql_query("SELECT * FROM  events ORDER BY date ASC LIMIT 0,5") or sqlerr(__FILE__, __LINE__);
		if (mysql_num_rows($res) > 0) {
		while($row = mysql_fetch_array($res))
		{
		?>
			<li class='active '><b>»</b><a href="viewEvent.php?post=<?php echo $row['id']; ?>"><span><?php echo $row['title']; ?> | <b><?php echo $row['date']; ?></b></span></a></li>
		<?php
		}
		}
		?>
		</div>
		</div></div>
		<div class="content_boxes"><div class="content_box"><div id="champ_ico"></div><div class="content_header">
		<font size="5">ТУРНИРИ</font>
		</br><font size="2">Какво ни очаква скоро?</font>
		</div>
<div id="wrapper">
	<div>
		<div id="slider">
			<ul>
			<?php
		$res = mysql_query("SELECT id, img, date FROM  tournaments ORDER BY date ASC LIMIT 0,5") or sqlerr(__FILE__, __LINE__);
		if (mysql_num_rows($res) > 0) {
		while($row = mysql_fetch_array($res))
		{
		?>
			<li id="content"><a href="viewTournament.php?post=<?php echo $row['id']; ?>"><img src="<?php echo $row['img']; ?>" width="280" height="190"/></a></li>
		<?php
		}
		}
		?>
			</ul>
		</div>
	</div>
	<ul id="pagination" class="pagination">
		<li onclick="slideshow.pos(0)">&nbsp;</li>
		<li onclick="slideshow.pos(1)">&nbsp;</li>
		<li onclick="slideshow.pos(2)">&nbsp;</li>
		<li onclick="slideshow.pos(3)">&nbsp;</li>
		<li onclick="slideshow.pos(4)">&nbsp;</li>
	</ul>
</div>
<script type="text/javascript">
var slideshow=new TINY.slider.slide('slideshow',{
	id:'slider',
	auto:1,
	resume:true,
	vertical:false,
	navid:'pagination',
	activeclass:'current',
	position:0
});
</script>
		</div></div>
		<div class="content_boxes"><div class="content_box"><div id="login_ico"></div><div class="content_header">
		            <? if (!$CURUSER) { ?>
		<font size="5">ВХОД В САЙТА</font>
		</br><font size="2">Логин форма на сайта</font>
            <? } else { ?>
            <?php echo"<a href=member.php?id=" . $CURUSER['id'] . "><font color=#313a3e size=5>" . $CURUSER['username'] . "</font></a></br><font size=2>Добре дошли в Hard-Gamers.</font>"; ?> 
            <? } ?>

		</div>
            <? if (!$CURUSER) { ?>
<?php include 'login.php'; ?> 
            <? } else { ?>
            <?php include 'styles/profile.php'; ?> 
            <? } ?>
		</div></div>
	</div>
	<div id="blog_part">
		<div class="blog_boxes_left">

                <? $fn = substr($PHP_SELF, strrpos($PHP_SELF, "/") + 1); ?>


                        <?
                    }

                    function stdfoot() {
					include 'bottom.php';
                    }

                    function genbark($x, $y) {
                        stdhead($y);
						print ("<div class=blog_part_left_box><div class=gamepad_ico></div><div class=blog_part_left_smallheader><font size=5>" . htmlspecialchars($y) . "</font></div>\n");
                        print("<div class=error><center>" . htmlspecialchars($x) . "</center></div></div>\n");
                        stdfoot();
                        exit();
                    }

                    function mksecret($len = 20) {
                        $ret = "";
                        for ($i = 0; $i < $len; $i++)
                            $ret .= chr(mt_rand(0, 255));
                        return $ret;
                    }

                    function httperr($code = 404) {
                        header("HTTP/1.0 404 Не е намерено");
                        print("<h1>Не е намерено</h1>\n");
                        exit();
                    }

                    function gmtime() {
                        return strtotime(get_date_time());
                    }

                    function logincookie($id, $passhash, $updatedb = 1, $expires = 0x7fffffff) {
                        setcookie("uid", $id, $expires, "/");
                        setcookie("pass", $passhash, $expires, "/");

                        if ($updatedb)
                            mysql_query("UPDATE users SET last_login = NOW() WHERE id = $id");
                    }

                    function logoutcookie() {
                        setcookie("uid", "", 0x7fffffff, "/");
                        setcookie("pass", "", 0x7fffffff, "/");
                    }

                    function loggedinorreturn() {
                        global $CURUSER;
                        if (!$CURUSER) {
                            header("Location: returnlogin.php");
                            exit();
                        }
                    }

                    function searchfield($s) {
                        return preg_replace(array('/[^a-z0-9]/si', '/^\s*/s', '/\s*$/s', '/\s+/s'), array(" ", "", "", " "), $s);
                    }

                    function hit_start() {
                        return;
                        global $RUNTIME_START, $RUNTIME_TIMES;
                        $RUNTIME_TIMES = posix_times();
                        $RUNTIME_START = gettimeofday();
                    }

                    function hit_count() {
                        return;
                        global $RUNTIME_CLAUSE;
                        if (preg_match(',([^/]+)$,', $_SERVER["SCRIPT_NAME"], $matches))
                            $path = $matches[1];
                        else
                            $path = "(непознат)";
                        $period = date("Y-m-d H") . ":00:00";
                        $RUNTIME_CLAUSE = "page = " . sqlesc($path) . " AND period = '$period'";
                        $update = "UPDATE hits SET count = count + 1 WHERE $RUNTIME_CLAUSE";
                        mysql_query($update);
                        if (mysql_affected_rows())
                            return;
                        $ret = mysql_query("INSERT INTO hits (page, period, count) VALUES (" . sqlesc($path) . ", '$period', 1)");
                        if (!$ret)
                            mysql_query($update);
                    }

                    function hit_end() {
                        return;
                        global $RUNTIME_START, $RUNTIME_CLAUSE, $RUNTIME_TIMES;
                        if (empty($RUNTIME_CLAUSE))
                            return;
                        $now = gettimeofday();
                        $runtime = ($now["sec"] - $RUNTIME_START["sec"]) + ($now["usec"] - $RUNTIME_START["usec"]) / 1000000;
                        $ts = posix_times();
                        $sys = ($ts["stime"] - $RUNTIME_TIMES["stime"]) / 100;
                        $user = ($ts["utime"] - $RUNTIME_TIMES["utime"]) / 100;
                        mysql_query("UPDATE hits SET runs = runs + 1, runtime = runtime + $runtime, user_cpu = user_cpu + $user, sys_cpu = sys_cpu + $sys WHERE $RUNTIME_CLAUSE");
                    }

                    function hash_pad($hash) {
                        return str_pad($hash, 20);
                    }

                    function hash_where($name, $hash) {
                        $shhash = preg_replace('/ *$/s', "", $hash);
                        return "($name = " . sqlesc($hash) . " OR $name = " . sqlesc($shhash) . ")";
                    }

                    function get_user_icons($arr, $big = false) {
                        if ($big) {
                            $donorpic = "starbig.gif";
                            $warnedpic = "warnedbig.gif";
                            $disabledpic = "disabledbig.gif";
                            $style = "style='margin-left: 4pt'";
                        } else {
                            $donorpic = "star.gif";
                            $warnedpic = "warned.gif";
                            $disabledpic = "disabled.gif";
                            $style = "style=\"margin-left: 2pt\"";
                        }
                        $pics = $arr["donor"] == "yes" ? "<img src=pic/$donorpic alt='Донор' border=0 $style>" : "";
                        if ($arr["enabled"] == "yes")
                            $pics .= $arr["warned"] == "yes" ? "<img src=pic/$warnedpic alt=\"Предупреден\" border=0 $style>" : "";
                        else
                            $pics .= "<img src=pic/$disabledpic alt=\"Забранен\" border=0 $style>\n";
                        return $pics;
                    }

                    require "global.php";
                    ?>