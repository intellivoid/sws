<?php

    namespace ZiProto\Exception;

    use function get_class;
    use function gettype;
    use function is_object;
    use RuntimeException;
    use function sprintf;
    use Throwable;

    class EncodingFailedException extends RuntimeException
    {
        private $value;

        /**
         * EncodingFailedException constructor.
         * @param $value
         * @param string $message
         * @param Throwable|null $previous
         */
        public function __construct($value, string $message = '', Throwable $previous = null)
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
            $message = sprintf('Unsupported type: %s.',
                is_object($value) ? get_class($value) : gettype($value)
            );
            return new self($value, $message);
        }
    }