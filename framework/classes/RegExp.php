<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 22.07.2019
 * Time: 18:42
 */

namespace framework\classes;


class RegExp {

    public static function dropImg($string)
    {
        return preg_replace('~<img(.*?)>~is', '', $string);
    }
    
    public static function dropLink($string)
    {
        return preg_replace('~<a(.*?)>(.*?)</a>~is', 'LINK', $string);
    }
    
    public static function isEmail($mail)
    {
        if ( !preg_match ( '~^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$~', $mail ) ) {
            return false;
        } else return true;
    }
    
    public static function isUrl($url)
    {
        if ( !preg_match ( '~^(ht|f)tp(s?)\:\/\/[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*(:(0-9)*)*(\/?)([a-zA-Z0-9\-\.\?\,\'\/\\\+&amp;%\$#_]*)?$~', $url ) ) {
            return false;
        } else return true;
    }
    
    public static function isPhone($phone)
    {
        if ( !preg_match( '~^[\+]?[\d-\s]{5,16}$~', $phone ) ) {
            return false;
        } return true;
    }
    
    public static function isFIO($name)
    {
        if ( !preg_match( '~^[a-zA-Z'-'\s]{1,40}$~', $name ) ) {
            return false;
        } return true;
    }
    
    public static function isBankCard($card)
    {
        if ( !preg_match ( '~^[\d]{4}\.[\d]{4}\.[\d]{4}\.[\d]{4}$~', $card ) ) {
            return false;
        } else return true;
    }
    
    public static function isBadWords($string, array $words)
    {
        $words = implode('|', $words);
        if ( !preg_match ( '~(.*)('.$words.')+(.*)~i', $string ) ) {
            return false;
        } else return true;
    }
}