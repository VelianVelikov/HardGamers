<?

require "include/main.php";

dbconn(false);

loggedinorreturn();

function puke($text = "������") {
    stderr("������", $text);
}

if (get_user_class() < UC_MOD)
    puke();

$action = $_POST["action"];

if ($action == "edituser") {
    $userid = $_POST["userid"];
    $title = $_POST["title"];
    $avatar = $_POST["avatar"];
    $enabled = $_POST["enabled"];
    $warned = $_POST["warned"];
    $warnlength = 0 + $_POST["warnlength"];
    $warnpm = $_POST["warnpm"];

    $class = 0 + $_POST["class"];
    if (!is_valid_id($userid) || !is_valid_user_class($class))
        stderr("������", "��������� ������������ ID.");
    // ����������� �������� �� ���������
    $res = mysql_query("SELECT warned, enabled, username, class FROM users WHERE id=$userid") or sqlerr(__FILE__, __LINE__);
    $arr = mysql_fetch_assoc($res) or puke();
    $curenabled = $arr["enabled"];
    $curclass = $arr["class"];
    $curwarned = $arr["warned"];
    // ������� ���������� ����� ��������� ��-���� ����
    if ($curclass >= get_user_class())
        puke();

    if ($curclass != $class) {
        // ������
        $updateset[] = "class = $class";
    }

    // ����������������
    if ($warned && $curwarned != $warned) {
        $updateset[] = "warned = " . sqlesc($warned);
        $updateset[] = "warneduntil = '0000-00-00 00:00:00'";
        if ($warned == 'no') {
            // ������ �� �������� ����������������
        }
    } elseif ($warnlength) {
        if ($warnlength == 255) {
            $updateset[] = "warneduntil = '0000-00-00 00:00:00'";
        } else {
            $warneduntil = get_date_time(gmtime() + $warnlength * 604800);
            $dur = $warnlength . "" . ($warnlength > 1 ? "�������" : "�������");
            $updateset[] = "warneduntil = '$warneduntil'";
        }
        $updateset[] = "warned = 'yes'";
    }

    if ($enabled != $curenabled) {
        if ($enabled == 'yes')
            $modcomment = gmdate("Y-m-d") . " - ����� ��������� �� " . $CURUSER['username'] . ".\n" . $modcomment;
        else
            $modcomment = gmdate("Y-m-d") . " - ������ �� " . $CURUSER['username'] . ".\n" . $modcomment;
    }

    $updateset[] = "enabled = " . sqlesc($enabled);
    $updateset[] = "donor = " . sqlesc($donor);
    $updateset[] = "avatar = " . sqlesc($avatar);
    $updateset[] = "title = " . sqlesc($title);
    $updateset[] = "modcomment = " . sqlesc($modcomment);
    mysql_query("UPDATE users SET  " . implode(", ", $updateset) . " WHERE id=$userid") or sqlerr(__FILE__, __LINE__);
    $returnto = $_POST["returnto"];

    header("Location: $DEFAULTBASEURL/$returnto");
    die;
}

puke();
?>