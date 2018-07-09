<?php

    namespace asas\Exceptions;
    use sws\Abstracts\ExceptionCodes;

    /**
     * Class IPAutoDetectException
     * @package sws\Exceptions
     */
    class IPAutoDetectException extends \RuntimeException
    {

        /**
         * IPAutoDetectException constructor.
         */
        public function __construct()
        {
            parent::__construct(
                \sprintf('The given IP is invalid'),
                ExceptionCodes::IPAutoDetectException
            );
        }

    }