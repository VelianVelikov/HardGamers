<?

require "include/main.php";
$id = $_GET["id"];
if (!is_numeric($id) || $id < 1 || floor($id) != $id)
    die;

$type = $_GET["type"];

dbconn(false);
loggedinorreturn();
if ($type == 'in') {
    // ��������� ���� � ��� ��������� �����
    $res = mysql_query("SELECT receiver, location FROM messages WHERE id=" . sqlesc($id)) or die("barf");
    $arr = mysql_fetch_array($res) or die("������ ID");
    if ($arr["receiver"] != $CURUSER["id"])
        die("������ - ����� �� �������");
    if ($arr["location"] == 'in')
        mysql_query("DELETE FROM messages WHERE id=" . sqlesc($id)) or die('��������� ��������� - ������ 1 : ���� �������� �� � �������������');
    else if ($arr["location"] == 'both')
        mysql_query("UPDATE messages SET location = 'out' WHERE id=" . sqlesc($id)) or die('��������� ��������� - ������ 2 : ���� �������� �� � �������������');
    else
        die('���� �� � ��� ��������� �����.');
}
elseif ($type == 'out') {
    // �������� ���� � � ���������� �����
    $res = mysql_query("SELECT sender, location FROM messages WHERE id=" . sqlesc($id)) or die("barf");
    $arr = mysql_fetch_array($res) or die("������ ID");
    if ($arr["sender"] != $CURUSER["id"])
        die("������ - ����� �� �������");
    if ($arr["location"] == 'out')
        mysql_query("DELETE FROM messages WHERE id=" . sqlesc($id)) or die('��������� ��������� - ������ 3 : ���� �������� �� � �������������');
    else if ($arr["location"] == 'both')
        mysql_query("UPDATE messages SET location = 'in' WHERE id=" . sqlesc($id)) or die('��������� ��������� - ������ 4 : ���� �������� �� � �������������');
    else
        die('���� �� � � ���������� �����');
}
else
    die('��������� ��.');
header("Location: $DEFAULTBASEURL/inbox.php" . ($type == 'out' ? "?out=1" : ""));
?>