<?php

    namespace sws\Objects;
    use sws\Abstracts\DefaultValues;

    /**
     * Class Cookie
     * @package sws\Objects
     */
    class Cookie
    {

        /**
         * If the cookie was disposed
         *
         * @var bool
         */
        public $Disposed = False;

        /**
         * The name of the cookie
         *
         * @var string
         */
        public $Name = DefaultValues::NoValue;

        /**
         * Public Token assigned to the cookie
         *
         * @var string
         */
        public $Token = DefaultValues::NoValue;

        /**
         * The expiry date for the cookie (Unix Timestamp)
         *
         * @var int
         */
        public $Expires = 0;

        /**
         * If the cookie is tied to an IP
         *
         * @var bool
         */
        public $IPTied = False;

        /**
         * @var string The client's IP Address
         */
        public $IP = DefaultValues::NoValue;

        /**
         * The data assigned to the cookie
         *
         * @var void
         */
        public $Data;

    }