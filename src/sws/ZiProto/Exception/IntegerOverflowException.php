<?php

    namespace ZiProto\Exception;

    use function sprintf;

    class IntegerOverflowException extends DecodingFailedException
    {
        private $value;
        public function __construct(int $value)
        {
            parent::__construct(sprintf('The value is too big: %u.', $value));
            $this->value = $value;
        }
        public function getValue() : int
        {
            return $this->value;
        }
    }