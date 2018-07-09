<?php

    namespace sws\Classes;


    class Crypto
    {
        /**
         * Peppers a hash using whirlpool
         *
         * @param string $Data The hash to pepper
         * @param int $Min Minimal amounts of executions
         * @param int $Max Maximum amount of executions
         * @return string
         */
        public static function pepper(string $Data, int $Min = 100, int $Max = 1000): string
        {
            $n = rand($Min, $Max);
            $res = '';
            $Data = hash('whirlpool', $Data);
            for ($i=0,$l=strlen($Data) ; $l ; $l--)
            {
                $i = ($i+$n-1) % $l;
                $res = $res . $Data[$i];
                $Data = ($i ? substr($Data, 0, $i) : '') . ($i < $l-1 ? substr($Data, $i+1) : '');
            }
            return($res);
        }

        /**
         * Generates a cookie token identifier
         *
         * @param string $Name
         * @return string
         */
        public static function generateToken(string $Name): string
        {
            $Peppered_Name = self::pepper($Name, 100, 1256);
            $HashedResult = hash('haval192,5', $Peppered_Name);
            return($HashedResult);
        }
    }