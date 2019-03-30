<?php

    namespace ZiProto;

    use ZiProto\Exception\InvalidOptionException;
    use ZiProto\Abstracts\Options;

    final class EncodingOptions
    {

        private $strBinMode;
        private $arrMapMode;
        private $floatMode;

        private function __construct()
        {
        }

        public static function fromDefaults() : self
        {
            $self = new self();
            $self->strBinMode = Options::DETECT_STR_BIN;
            $self->arrMapMode = Options::DETECT_ARR_MAP;
            $self->floatMode = Options::FORCE_FLOAT64;

            return $self;
        }

        public static function fromBitmask(int $bitmask) : self
        {
            $self = new self();

            if (self::getSingleOption('str/bin', $bitmask,
                Options::FORCE_STR |
                Options::FORCE_BIN |
                Options::DETECT_STR_BIN
            )) {
                $self->strBinMode = self::getSingleOption('str/bin', $bitmask,
                    Options::FORCE_STR |
                    Options::FORCE_BIN |
                    Options::DETECT_STR_BIN
                );
            } else {
                $self->strBinMode = Options::DETECT_STR_BIN;
            }

            if (self::getSingleOption('arr/map', $bitmask,
                Options::FORCE_ARR |
                Options::FORCE_MAP |
                Options::DETECT_ARR_MAP
            )) {
                $self->arrMapMode = self::getSingleOption('arr/map', $bitmask,
                    Options::FORCE_ARR |
                    Options::FORCE_MAP |
                    Options::DETECT_ARR_MAP
                );
            } else {
                $self->arrMapMode = Options::DETECT_ARR_MAP;
            }

            if (self::getSingleOption('float', $bitmask,
                Options::FORCE_FLOAT32 |
                Options::FORCE_FLOAT64
            )) {
                $self->floatMode = self::getSingleOption('float', $bitmask,
                    Options::FORCE_FLOAT32 |
                    Options::FORCE_FLOAT64
                );
            } else {
                $self->floatMode = Options::FORCE_FLOAT64;
            }

            return $self;
        }

        public function isDetectStrBinMode() : bool
        {
            return Options::DETECT_STR_BIN === $this->strBinMode;
        }

        public function isForceStrMode() : bool
        {
            return Options::FORCE_STR === $this->strBinMode;
        }

        public function isDetectArrMapMode() : bool
        {
            return Options::DETECT_ARR_MAP === $this->arrMapMode;
        }

        public function isForceArrMode() : bool
        {
            return Options::FORCE_ARR === $this->arrMapMode;
        }

        public function isForceFloat32Mode() : bool
        {
            return Options::FORCE_FLOAT32 === $this->floatMode;
        }

        private static function getSingleOption(string $name, int $bitmask, int $validBitmask) : int
        {
            $option = $bitmask & $validBitmask;
            if ($option === ($option & -$option)) {
                return $option;
            }

            static $map = [
                Options::FORCE_STR => 'FORCE_STR',
                Options::FORCE_BIN => 'FORCE_BIN',
                Options::DETECT_STR_BIN => 'DETECT_STR_BIN',
                Options::FORCE_ARR => 'FORCE_ARR',
                Options::FORCE_MAP => 'FORCE_MAP',
                Options::DETECT_ARR_MAP => 'DETECT_ARR_MAP',
                Options::FORCE_FLOAT32 => 'FORCE_FLOAT32',
                Options::FORCE_FLOAT64 => 'FORCE_FLOAT64',
            ];

            $validOptions = [];
            for ($i = $validBitmask & -$validBitmask; $i <= $validBitmask; $i <<= 1) {
                $validOptions[] = __CLASS__.'::'.$map[$i];
            }

            throw InvalidOptionException::outOfRange($name, $validOptions);
        }
    }
