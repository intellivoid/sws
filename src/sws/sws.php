<?php

    namespace sws;

    use acm\acm;
    use asas\Exceptions\DatabaseException;
    use Exception;
    use mysqli;
    use sws\Classes\CookieManager;
    use sws\Classes\WebManager;

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

    if(class_exists('ZiProto\ZiProto') == false)
    {
        include_once(__DIR__ . DIRECTORY_SEPARATOR . 'ZiProto' . DIRECTORY_SEPARATOR . 'ZiProto.php');
    }


    if(class_exists('acm\acm') == false)
    {
        include_once(__DIR__ . DIRECTORY_SEPARATOR . 'acm' . DIRECTORY_SEPARATOR . 'acm.php');
    }

    include(__DIR__ . DIRECTORY_SEPARATOR . 'AutoConfig.php');


    /**
     * Class sws
     * @package sws
     */
    class sws
    {
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
         * @var acm
         */
        private $acm;

        /**
         * @var mixed
         */
        private $DatabaseConfiguration;

        /**
         * sws constructor.
         * @throws Exception
         */
        public function __construct()
        {
            $this->acm = new acm(__DIR__, 'Intellivoid Accounts');
            $this->DatabaseConfiguration = $this->acm->getConfiguration('Database');

            $this->Database = new mysqli(
                $this->DatabaseConfiguration['Host'],
                $this->DatabaseConfiguration['Username'],
                $this->DatabaseConfiguration['Password'],
                $this->DatabaseConfiguration['Database'],
                $this->DatabaseConfiguration['Port']
            );

            if($this->Database->connect_error)
            {
                throw new DatabaseException($this->Database->connect_error);
            }

            $this->CookieManager = new CookieManager($this);
            $this->WebManager = new WebManager($this);
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