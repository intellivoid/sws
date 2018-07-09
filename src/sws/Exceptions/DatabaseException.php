<?php

    namespace asas\Exceptions;
    use sws\Abstracts\ExceptionCodes;

    /**
     * Class DatabaseException
     * @package sws\Exceptions
     */
    class DatabaseException extends \RuntimeException
    {
        /**
         * @var string
         */
        private $DatabaseError;

        /**
         * DatabaseException constructor.
         * @param string $DatabaseError
         */
        public function __construct(string $DatabaseError)
        {
            parent::__construct(
                \sprintf('There was an internal Database error'),
                ExceptionCodes::DatabaseException
            );
            $this->DatabaseError = $DatabaseError;
        }

        /**
         * @return string
         */
        public function getError(): string
        {
            return($this->DatabaseError);
        }
    }