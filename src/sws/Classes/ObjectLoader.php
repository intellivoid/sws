<?php

    namespace sws\Classes;
    use sws\Objects\Cookie;
    use ZiProto\ZiProto;

    /**
     * Class ObjectLoader
     * @package sws\Classes
     */
    class ObjectLoader
    {
        /**
         * Constructs a Cookie object from data
         *
         * @param array $Data
         * @return Cookie
         */
        public static function loadCookie(array $Data): Cookie
        {
            $CookieObject = new Cookie();

            if(isset($Data['disposed']))
            {
                $CookieObject->Disposed = $Data['disposed'];
            }

            if(isset($Data['name']))
            {
                $CookieObject->Name = $Data['name'];
            }

            if(isset($Data['token']))
            {
                $CookieObject->Token = $Data['token'];
            }

            if(isset($Data['expires']))
            {
                $CookieObject->Expires = $Data['expires'];
            }

            if(isset($Data['ip_tied']))
            {
                $CookieObject->IPTied = $Data['ip_tied'];
            }

            if(isset($Data['client_ip']))
            {
                $CookieObject->IP = $Data['client_ip'];
            }

            if(isset($Data['data']))
            {
                $CookieObject->Data = ZiProto::decode($Data['data']);
            }

            return($CookieObject);
        }
    }