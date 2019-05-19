<?php


    namespace sws\Classes;

    /**
     * Class Utilities
     * @package sws\Classes
     */
    class Utilities
    {
        /**
         * Detects the client IP
         *
         * @return string
         */
        public static function detectClientIp(): string
        {
            if(isset($_SERVER['HTTP_CLIENT_IP']))
            {
                return $_SERVER['HTTP_CLIENT_IP'];
            }

            if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }

            if(isset($_SERVER['HTTP_X_FORWARDED']))
            {
                return $_SERVER['HTTP_X_FORWARDED'];
            }

            if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            {
                return $_SERVER['HTTP_FORWARDED_FOR'];
            }

            if(isset($_SERVER['HTTP_FORWARDED']))
            {
                return $_SERVER['HTTP_FORWARDED'];
            }

            if(isset($_SERVER['REMOTE_ADDR']))
            {
                return $_SERVER['REMOTE_ADDR'];
            }

            if(getenv('HTTP_CLIENT_IP') !== False)
            {
                return getenv('HTTP_CLIENT_IP');
            }

            if(getenv('HTTP_X_FORWARDED_FOR'))
            {
                return getenv('HTTP_X_FORWARDED_FOR');
            }

            if(getenv('HTTP_X_FORWARDED'))
            {
                return getenv('HTTP_X_FORWARDED');
            }

            if(getenv('HTTP_FORWARDED_FOR'))
            {
                return getenv('HTTP_FORWARDED_FOR');
            }

            if(getenv('HTTP_FORWARDED'))
            {
                return getenv('HTTP_FORWARDED');
            }

            if(getenv('REMOTE_ADDR'))
            {
                return getenv('REMOTE_ADDR');
            }

            return '0.0.0.0';
        }
    }