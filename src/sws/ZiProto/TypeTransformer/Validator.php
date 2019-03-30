<?php
    namespace ZiProto\TypeTransformer;

    use ZiProto\Packet;

    interface Validator
    {
        public function check(Packet $packer, $value) :string;
    }