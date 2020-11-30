<?

require_once("main.php");

function docleanup() {
    global $signup_timeout, $autoclean_interval;

    set_time_limit(0);
    ignore_user_abort(1);

    // неактивни потребители под ранг VIP
    $secs = 42 * 86400;
    $dt = sqlesc(get_date_time(gmtime() - $secs));
    $maxclass = UC_VIP;
    mysql_query("DELETE FROM users WHERE status='confirmed' AND class <= $maxclass AND last_access < $dt");

    // премахване на изтекли предупреждения
    $res = mysql_query("SELECT id FROM users WHERE warned='yes' AND warneduntil < NOW() AND warneduntil <> '0000-00-00 00:00:00'") or sqlerr(__FILE__, __LINE__);
    if (mysql_num_rows($res) > 0) {
        $dt = sqlesc(get_date_time());
        while ($arr = mysql_fetch_assoc($res)) {
            mysql_query("UPDATE users SET warned = 'no', warneduntil = '0000-00-00 00:00:00' WHERE id = $arr[id]") or sqlerr(__FILE__, __LINE__);
        }
    }
}

?>