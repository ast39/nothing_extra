<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 27.08.2019
 * Time: 13:22
 */

namespace framework\classes;


class Date {

    protected static $day      = 86400;
    protected static $week     = 604800;
    protected static $month28  = 2419200;
    protected static $month29  = 2505600;
    protected static $month30  = 2592000;
    protected static $month31  = 2678400;
    protected static $year     = 31536000;
    protected static $leapYear = 31622400;

    /**
     * @param $year
     * @return bool
     */
    public static function isLeap($year)
    {
        return $year % 4 == 0;
    }

    /**
     * @param int $time
     * @param int $from_zone
     * @param int $to_zone
     * @return float|int
     */
    public static function ftime(int $time, $from_zone = 0, $to_zone = 0)
    {
        return ($to_zone - $from_zone) * 3600 + $time;
    }

    /**
     * @param $timestamp
     * @param int $days
     * @return mixed
     */
    public static function plusDay($timestamp, $days = 1)
    {
        return $timestamp + static::$day * $days;
    }

    /**
     * @param $timestamp
     * @param int $weeks
     * @return mixed
     */
    public static function plusWeek($timestamp, $weeks = 1)
    {
        return $timestamp + static::$week * $weeks;
    }

    /**
     * @param $timestamp
     * @param int $monthes
     * @return int
     */
    public static function plusMonth($timestamp, $monthes = 1)
    {
        for ($i=0; $i<abs($monthes); $i++) {

            $current_year  = date('Y', $timestamp);
            $current_month = date('n', $timestamp);
            if ($monthes < 0) {
                $current_month = $current_month == 1
                    ? 12 : $current_month - 1;
            }

            $plus = static::monthSeconds($current_month, static::isLeap($current_year));
            $monthes > 0
                ? $timestamp += $plus
                : $timestamp -= $plus;
        }

        return $timestamp;
    }

    /**
     * @param $timestamp
     * @param int $years
     * @return int
     */
    public static function plusYear($timestamp, $years = 1)
    {
        for ($i=0; $i<abs($years); $i++) {

            $current_year = date('Y', $timestamp);
            if ($years < 0) {
                $current_year--;
            }

            $plus = static::isLeap($current_year)
                ? static::$leapYear
                : static::$year;
            $years > 0
                ? $timestamp += $plus
                : $timestamp -= $plus;
        }

        return $timestamp;
    }

    /**
     * Метка начала дня
     *
     * @return int
     */
    public static function dayBegin(int $time)
    {
        return strtotime(date('d-m-Y', $time) . ' 00:00:00');
    }

    /**
     * Метка начала месяца
     *
     * @return int
     */
    public static function monthBegin(int $time)
    {
        return strtotime('01-' . date('m-Y', $time) . ' 00:00:00');
    }

    /**
     * Метка начала года
     *
     * @return int
     */
    public static function yearBegin(int $time)
    {
        return strtotime('01-01-' . date('Y', $time) . ' 00:00:00');
    }

    /**
     * Сколько дней в месяце
     *
     * @param int $time
     * @param bool $back
     * @return float
     */
    public static function daysInMonth(int $time, bool $back = false)
    {
        $target_date = self::plusMonth($time, $back === false ? -1 : 1);

        return round(abs($target_date - $time) / 3600 / 24);
    }

    /**
     * Время в формате осталось до метки
     *
     * @param $timestamp
     * @param string $format
     * @return float|int
     */
    public static function timeToMark($timestamp, $format = 's')
    {
        return static::tillTime(time(), $timestamp, $format);
    }

    /**
     * Время в формате прошло после метки
     *
     * @param $timestamp
     * @param string $format
     * @return float|int
     */
    public static function timeAfterMark($timestamp, $format = 's')
    {
        return static::tillTime($timestamp, time(), $format);
    }

    /**
     * Время в формате между 2мя точками
     *
     * @param $from
     * @param $to
     * @param string $format
     * @return float|int
     */
    public static function tillTime($from, $to, $format = 's')
    {
        $counter = 0;

        switch (strtolower($format)) {
            case 'y' :
                do {
                    $from = static::plusYear($from);
                    if ($from < $to) {
                        $counter++;
                    }
                } while($from < $to);
                break;
            case 'm' :
                do {
                    $from = static::plusMonth($from);
                    if ($from < $to) {
                        $counter++;
                    }
                } while($from < $to);
                break;
            case 'd' :
                $counter = floor(($to - $from) / 3600 / 24);
                break;
            case 'h' :
                $counter = floor(($to - $from) / 3600);
                break;
            case 'i' :
                $counter = floor(($to - $from) / 60);
                break;
            default :
                $counter = $to - $from;
                break;
        }

        return $counter;
    }

    public static function formatTime($seconds)
    {
        return number_format($seconds, 3);
    }

    /**
     * Кол-во секунд в месяце
     *
     * @param $month
     * @param false $leap
     * @return int
     */
    private static function monthSeconds($month, $leap = false)
    {
        $month = (int)$month;

        if (in_array($month, [1,3,5,7,8,10,12])) {
            return static::$month31;
        } elseif (in_array($month, [4,6,9,11])) {
            return static::$month30;
        } else {

            return $leap
                ? static::$month29
                : static::$month28;
        }
    }
}