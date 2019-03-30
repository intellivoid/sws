<?php
    namespace ZiProto\TypeTransformer;

    use ZiProto\Packet;
    use ZiProto\Type\Map;

    abstract class MapTransformer
    {
        public function encode(Packet $packer, $value): string
        {
            if ($value instanceof Map) {
                return $packer->encodeMap($value->map);
            } else {
                return null;
            }
        }
    }