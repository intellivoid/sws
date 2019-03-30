<?php

    namespace ZiProto\Type;

    final class Binary
    {
        public $data;
        public function __construct(string $data)
        {
            $this->data = $data;
        }
    }