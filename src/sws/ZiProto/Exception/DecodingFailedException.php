<?php

    namespace ZiProto\Exception;

    use RuntimeException;
    use function sprintf;

    class DecodingFailedException extends RuntimeException
    {
        public static function unknownCode(int $code) : self
        {
            return new self(sprintf('Unknown code: 0x%x.', $code));
        }
        public static function unexpectedCode(int $code, string $type) : self
        {
            return new self(sprintf('Unexpected %s code: 0x%x.', $type, $code));
        }
    }