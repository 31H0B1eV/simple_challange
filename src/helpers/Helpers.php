<?php

namespace App\helpers;

use DateTime;

class Helpers
{

    /**
     * As named return user age from birthday
     *
     * @param $birthday
     * @return int
     */
     public static function getAge($birthday) {
        $date = new DateTime(self::cleanUpInput($birthday));
        $now = new DateTime();
        $interval = $now->diff($date);

        return $interval->y;
    }

    /**
     * Remove spaces from start and end,
     * convert special chars into html
     * and remove them.
     *
     * @param $value
     * @return string
     */
    public static function cleanUpInput($value) {
        return strip_tags(htmlspecialchars(trim($value)));
    }
}