<?php
namespace IO\Text;

class Ltsv
{
    public static function encode(array $array)
    {
        $result = array();

        foreach ($array as $k => $v) {
            if (is_array($v) || is_resource($v) || is_object($v) || $k === '' || strpos($k, ':') !== false) {
                throw new \InvalidArgumentException();
            }
            $result[] = "{$k}:{$v}";
        }
        return implode("\t", $result);
    }

    public static function decode($ltsv)
    {
        $hash = array();
        $splited = explode("\t", $ltsv);
        foreach ($splited as $col) {
            $splited = explode(':', $col, 2);
            if (count($splited) < 2) {
                throw new \RuntimeException('parse error');
            }
            list($k, $v) = $splited;
            $hash[$k] = $v;
        }
        return $hash;
    }
}
