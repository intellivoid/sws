<?php

    namespace sws\Abstracts;

    /**
     * Class ExceptionCodes
     * @package sws\Abstracts
     */
    abstract class ExceptionCodes
    {
        const DatabaseException = 100;

        const IPAutoDetectException = 101;

        const InvalidIPException = 102;

        const InvalidCookieException = 103;
    }