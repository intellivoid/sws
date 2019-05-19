<?php

    namespace sws;
    use asas\Exceptions\DatabaseException;
    use mysqli;
    use sws\Classes\CookieManager;
    use sws\Classes\WebManager;

    /**
     * Class sws
     * @package sws
     */
    class sws
    {
        /**
         * @var array|bool
         */
        private $Configuration;

        /**
         * @var mysqli
         */
        private $Database;

        /**
         * @var CookieManager
         */
        private $CookieManager;

        /**
         * @var WebManager
         */
        private $WebManager;

        /**
         * sws constructor.
         */
        public function __construct()
        {
            $this->Configuration = parse_ini_file(__DIR__ . DIRECTORY_SEPARATOR . 'configuration.ini');

            if(class_exists('ZiProto\ZiProto') == false)
            {
                include_once(__DIR__ . DIRECTORY_SEPARATOR . 'ZiProto' . DIRECTORY_SEPARATOR . 'ZiProto.php');
            }

            include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Abstracts' . DIRECTORY_SEPARATOR . 'DefaultValues.php');
            include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Abstracts' . DIRECTORY_SEPARATOR . 'ExceptionCodes.php');

            include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Classes' . DIRECTORY_SEPARATOR . 'CookieManager.php');
            include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Classes' . DIRECTORY_SEPARATOR . 'Crypto.php');
            include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Classes' . DIRECTORY_SEPARATOR . 'ObjectLoader.php');
            include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Classes' . DIRECTORY_SEPARATOR . 'Utilities.php');
            include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Classes' . DIRECTORY_SEPARATOR . 'WebManager.php');

            include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Exceptions' . DIRECTORY_SEPARATOR . 'DatabaseException.php');
            include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Exceptions' . DIRECTORY_SEPARATOR . 'InvalidCookieException.php');
            include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Exceptions' . DIRECTORY_SEPARATOR . 'InvalidIPException.php');
            include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Exceptions' . DIRECTORY_SEPARATOR . 'IPAutoDetectException.php');

            include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Objects' . DIRECTORY_SEPARATOR . 'Cookie.php');

            $this->Database = new mysqli(
                $this->Configuration['Host'],
                $this->Configuration['Username'],
                $this->Configuration['Password'],
                $this->Configuration['Database'],
                $this->Configuration['Port']
            );

            if($this->Database->connect_error)
            {
                throw new DatabaseException($this->Database->connect_error);
            }

            $this->CookieManager = new CookieManager($this);
            $this->WebManager = new WebManager($this);
        }

        /**
         * @return array|bool
         */
        public function Configuration()
        {
            return $this->Configuration;
        }

        /**
         * @return mysqli
         */
        public function Database(): mysqli
        {
            return $this->Database;
        }

        /**
         * @return CookieManager
         */
        public function CookieManager(): CookieManager
        {
            return $this->CookieManager;
        }

        /**
         * @return WebManager
         */
        public function WebManager(): WebManager
        {
            return $this->WebManager;
        }

    }