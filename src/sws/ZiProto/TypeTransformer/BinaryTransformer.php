<?php

    namespace ZiProto\TypeTransformer;

    use ZiProto\Packet;
    use ZiProto\Type\Binary;

    abstract class BinaryTransformer
    {
        public function pack(Packet $packer, $value): string
        {
            if ($value instanceof Binary) {
                return $packer->encodeBin($value->data);
            } else {
                return null;
            }
        }
    }