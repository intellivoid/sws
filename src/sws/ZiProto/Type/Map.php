<?php

    namespace ZiProto\Type;

    final class Map
    {
        public $map;
        public function __construct(array $map)
        {
            $this->map = $map;
        }
    }