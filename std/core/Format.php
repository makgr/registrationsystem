<?php

/**

 * Format Class

 */
class Format {

    public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

    public static function bn2en($number) {

        return str_replace(self::$bn, self::$en, $number);
    }

    public static function en2bn($number) {

        return str_replace(self::$en, self::$bn, $number);
    }

    public function big_rand($len = 9) {

        $rand = '';

        while (!( isset($rand[$len - 1]) )) {

            $rand .= mt_rand();
        }

        return substr($rand, 0, $len);
    }

    public function formatDateTime($date) {

        return date('F j, Y, g:i a', strtotime($date));
    }

    public function formatDate($date) {

        return date('F j, Y', strtotime($date));
    }

    public function textShorten($text, $limit = 400) {

        $text = $text . " ";

        $text = substr($text, 0, $limit);

        $text = substr($text, 0, strrpos($text, ' '));

        $text = $text . ".....";

        return $text;
    }

    public function validation($data) {

        $data = trim($data);

        $data = stripcslashes($data);

        $data = htmlspecialchars($data);

        return $data;
    }

    public function title() {

        $path = $_SERVER['SCRIPT_FILENAME'];

        $title = basename($path, '.php');

        //$title = str_replace('_', ' ', $title);

        if ($title == 'index') {

            $title = 'home';
        } elseif ($title == 'contact') {

            $title = 'contact';
        }

        return $title = ucfirst($title);
    }

    public function menuactive() {
        $path = $_SERVER['SCRIPT_FILENAME'];
        $pagename = basename($path, '.php');
        return $pagename;
    }

    public function get_browser_name($user_agent) {
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/'))
            return 'Opera';
        elseif (strpos($user_agent, 'Edge'))
            return 'Edge';
        elseif (strpos($user_agent, 'Chrome'))
            return 'Chrome';
        elseif (strpos($user_agent, 'Safari'))
            return 'Safari';
        elseif (strpos($user_agent, 'Firefox'))
            return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7'))
            return 'Internet Explorer';

        return 'Other';
    }

    public function getSemesterType($date) {
        $current_month = date('m', strtotime($date));
        $spring = array(1,2,3,4,5,6);
        $fall = array(7,8,9,10,11,12);
        if (in_array($current_month,$spring)) {
            return 'Spring';
        } else {
            return 'Fall';
        }
    }


}

?>