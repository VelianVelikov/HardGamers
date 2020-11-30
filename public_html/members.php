<?

require "include/main.php";

dbconn();

loggedinorreturn();

$search = trim($_GET['search']);
$class = $_GET['class'];
if ($class == '-' || !is_valid_id($class))
    $class = '';

if ($search != '' || $class) {
    $query = "username LIKE " . sqlesc("%$search%") . " AND status='confirmed'";
    if ($search)
        $q = "search=" . htmlspecialchars($search);
}
else {
    $letter = trim($_GET["letter"]);
    if (strlen($letter) > 1)
        die;

    if ($letter == "" || strpos("abcdefghijklmnopqrstuvwxyz", $letter) === false)
        $letter = "";
    $query = "username LIKE '$letter%' AND status='confirmed'";
    $q = "letter=$letter";
}

if ($class) {
    $query .= " AND class=$class";
    $q .= ($q ? "&amp;" : "") . "class=$class";
}

stdhead("Потребители");


print("<center><form method=get action=?>\n");
print("Търси: <input type=text size=30 name=search>\n");
print("<select name=class>\n");
print("<option value='-'>(който и да е ранг)</option>\n");
for ($i = 1;; ++$i) {
    if ($c = get_user_class_name($i))
        print("<option value=$i" . ($class && $class == $i ? " selected" : "") . ">$c</option>\n");
    else
        break;
}
print("</select>\n");
print("<input type=submit value='Търси'>\n");
print("</form></center>\n");
echo "<br>";
$page = $_GET['page'];
$perpage = 100;

$res = mysql_query("SELECT COUNT(*) FROM users WHERE $query") or sqlerr();
$arr = mysql_fetch_row($res);
$pages = floor($arr[0] / $perpage);
if ($pages * $perpage < $arr[0])
    ++$pages;

if ($page < 1)
    $page = 1;
else
if ($page > $pages)
    $page = $pages;

for ($i = 1; $i <= $pages; ++$i)
    if ($i == $page)
        $pagemenu .= "<b>$i</b>\n";
    else
        $pagemenu .= "<a href=?$q&page=$i class=pagination><b>$i</b></a>\n";

if ($page == 1)
    $browsemenu .= "<b>Аз съм на</b>";
else
    $browsemenu .= "<a href=?$q&page=" . ($page - 1) . " class=pagination><b>&lt;&lt; Назад</b></a>";

$browsemenu .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

if ($page == $pages)
    $browsemenu .= "<b>Аз съм на:</b>";
else
    $browsemenu .= "<a href=?$q&page=" . ($page + 1) . " class=pagination><b>Напред &gt;&gt;</b></a>";

print("<center><p>$browsemenu<br><br>$pagemenu</p></center>");

$offset = ($page * $perpage) - $perpage;

$res = mysql_query("SELECT * FROM users WHERE $query ORDER BY username LIMIT $offset,$perpage") or sqlerr();
$num = mysql_num_rows($res);

/*"Резултати"*/
print("<div class=blog_part_left_box><div class=gamepad_ico></div><div class=blog_part_left_smallheader><font size=5>Резултати</font></div><table border=1 cellspacing=0 cellpadding=5 align=center width=100%>\n");
print("<tr><td class=colhead align=left>Потребител</td><td class=colhead>Регистриран на</td><td class=colhead>Последно активен</td><td class=colhead align=left>Ранг</td></tr>\n");
for ($i = 0; $i < $num; ++$i) {
    $arr = mysql_fetch_assoc($res);
    if ($arr['added'] == '0000-00-00 00:00:00')
        $arr['added'] = '-';
    if ($arr['last_access'] == '0000-00-00 00:00:00')
        $arr['last_access'] = '-';
    print("<tr><td align=left><a href=member.php?id=$arr[id]><b>$arr[username]</b></a>" . ($arr["donated"] > 0 ? "<img src=/pic/star.gif border=0 alt='Donor'>" : "") . "</td>" .
            "<td>$arr[added]</td><td>$arr[last_access]</td>" .
            "<td align=left>" . get_user_class_name($arr["class"]) . "</td></tr>\n");
}
print("</table></div>\n");


print("<center><p>$pagemenu<br><br>$browsemenu</p></center>");
stdfoot();
die;
?>