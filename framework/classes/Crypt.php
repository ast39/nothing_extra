<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 21.08.2019
 * Time: 16:30
 */

namespace framework\classes;


class Crypt {

    public static function generateKey($long = false)
    {
        $symbols_for_key = [0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f'];
        $key_length      = $long ? 64 : 32;
        $key = '';

        for ($i=0; $i<$key_length; $i++) {
            $key .= $symbols_for_key[rand(0, count($symbols_for_key)-1)];
        }

        return $key;
    }

    public static function encrypt($text, $key)
    {
        $ivlen          = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv             = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($text, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $hmac           = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        $ciphertext     = base64_encode( $iv.$hmac.$ciphertext_raw );

        return $ciphertext;
    }

    public static function decrypt($ciphertext, $key)
    {
        $c     = base64_decode($ciphertext);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv    = substr($c, 0, $ivlen);
        $hmac  = substr($c, $ivlen, $sha2len=32);

        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $text           = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $calcmac        = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);

        return hash_equals($hmac, $calcmac)
            ? $text
            : null;
    }

    public static function generatePassword(int $length, $uppercase = true, $lowercase = true, $digits = true, $symbols = false)
    {
        $spec_symbols      = ['!','@','#','$','%','^','&'];
        $digit_symbols     = [1,2,3,4,5,6,7,8,9];
        $lowercase_symbols = ['a','b','c','d','e','f','g','h','j','k','m','n','p','q','r','s','t','u','v','w', 'x', 'y', 'z'];
        $uppercase_symbols = array_map(function($element) {
            return strtoupper($element);
        }, $lowercase_symbols);

        $length = abs($length);
        $length = $length > 0 
            ? ($length > 64 
                ? 64 
                : $length) 
            : 4; 
        
        if (!$uppercase && !$lowercase && !$digits && !$symbols) {
            return null;
        }

        $symbols_for_password = [];
        $password = [];

        if ($uppercase) {

            $password[] = $uppercase_symbols[rand(0, count($uppercase_symbols) - 1)];
            $symbols_for_password = array_merge($symbols_for_password, $uppercase_symbols);
        }
        if ($lowercase) {

            $password[] = $lowercase_symbols[rand(0, count($lowercase_symbols) - 1)];
            $symbols_for_password = array_merge($symbols_for_password, $lowercase_symbols);
        }
        if ($digits) {

            $password[] = $digit_symbols[rand(0, count($digit_symbols) - 1)];
            $symbols_for_password = array_merge($symbols_for_password, $digit_symbols);
        }
        if ($symbols) {

            $password[] = $spec_symbols[rand(0, count($spec_symbols) - 1)];
            $symbols_for_password = array_merge($symbols_for_password, $spec_symbols);
        }

        shuffle($symbols_for_password);

        for ($i = count($password); $i < $length; $i++) {
            $password[] = $symbols_for_password[rand(0, count($symbols_for_password) - 1)];
        }

        shuffle($password);

        return implode('', $password);
    }
}