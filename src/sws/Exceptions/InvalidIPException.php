<?php

    namespace asas\Exceptions;
    use sws\Abstracts\ExceptionCodes;

    /**
     * Class InvalidIPException
     * @package sws\Exceptions
     */
    class InvalidIPException extends \RuntimeException
    {

        /**
         * InvalidIPException constructor.
         */
        public function __construct()
        {
            parent::__construct(
                \sprintf('The given IP address was invalid'),
                ExceptionCodes::InvalidIPException
            );
        }

    }