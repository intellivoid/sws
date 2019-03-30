<?php

    namespace ZiProto\Exception;

    class EncodingFailedException extends \RuntimeException
    {
        private $value;
        public function __construct($value, string $message = '', \Throwable $previous = null)
        {
            parent::__construct($message, 0, $previous);
            $this->value = $value;
        }
        public function getValue()
        {
            return $this->value;
        }
        public static function unsupportedType($value) : self
        {
            $message = \sprintf('Unsupported type: %s.',
                \is_object($value) ? \get_class($value) : \gettype($value)
            );
            return new self($value, $message);
        }
    }