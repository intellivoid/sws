<?php

    namespace ZiProto\TypeTransformer;

    use ZiProto\BufferStream;

    interface Extension
    {
        public function getType() : int;
        public function decode(BufferStream $stream, int $extLength);
    }