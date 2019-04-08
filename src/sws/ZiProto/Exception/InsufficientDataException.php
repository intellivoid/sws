<?php

    namespace ZiProto\Exception;

    use function strlen;

    class InsufficientDataException extends DecodingFailedException
    {
        public static function unexpectedLength(string $buffer, int $offset, int $expectedLength) : self
        {
            $actualLength = strlen($buffer) - $offset;
            $message = "Not enough data to unpack: expected $expectedLength, got $actualLength.";
            return new self($message);
        }
    }