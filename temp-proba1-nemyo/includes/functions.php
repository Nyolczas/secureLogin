<?php
class func
{
    public static function checkLoginState($dbh)
    {
        if (!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID'])) {
            session_start();
        }
        if (isset($_COOKIE['id']) && isset($_COOKIE['token']) && isset($_COOKIE['serial'])) {
            $query = "SELECT * FROM sessions WHERE session_userid = :userid AND session_token = :token AND session_serial = :serial;";
            $userid = $_COOKIE['userid'];
            $token = $_COOKIE['token'];
            $serial = $_COOKIE['serial'];

            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':userid' => $userid, ':token' => $token, ':serial' => $serial));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row['session_userid'] > 0) {
                if (
                    $row['session_userid'] == $_COOKIE['userid'] &&
                    $row['session_token'] == $_COOKIE['token'] &&
                    $row['session_serial'] == $_COOKIE['serial']
                ) {
                    if (
                        $row['session_userid'] == $_SESSION['userid'] &&
                        $row['session_token'] == $_SESSION['token'] &&
                        $row['session_serial'] == $_SESSION['serial']
                    ) {
                        return true;
                    }
                }
            }
        }
    }
    public static function createString($len)
    {
        $string = '0123456789öüóqwertzuiopőúasdfghjkléáűíyxcvbnmMNBVCXYÍŰÁÉLKJHGFDSAÚŐPOIUZTREWQÓÜÖ';
        $s = '';
        $r_new = '';
        $r_old = '';

        for ($i = 1; $i < $len; $i++) {
            while ($r_old == $r_new) {
                $r_new = rand(0, 80);
            }
            $r_old = $r_new;
            $s = $s . $string[$r_new];
         }

         return $s;
    }
}
