<?php

    namespace asas\Exceptions;
    use sws\Abstracts\ExceptionCodes;

    /**
     * Class InvalidCookieException
     * @package sws\Exceptions
     */
    class InvalidCookieException extends \RuntimeException
    {

        /**
         * InvalidCookieException constructor.
         */
        public function __construct()
        {
            parent::__construct(
                \sprintf('The cookie is invalid, and it cannot be found.'),
                ExceptionCodes::InvalidCookieException
            );
        }

    }