<?php

    namespace ZiProto\Exception;


    use function array_pop;
    use function count;
    use function implode;
    use InvalidArgumentException;
    use function sprintf;

    class InvalidOptionException extends InvalidArgumentException
    {
        public static function outOfRange(string $invalidOption, array $validOptions) : self
        {
            $use = count($validOptions) > 2
                ? sprintf('one of %2$s or %1$s', array_pop($validOptions), implode(', ', $validOptions))
                : implode(' or ', $validOptions);
            return new self("Invalid option $invalidOption, use $use.");
        }
    }