<?php

class AnswerLib
{
    public function verifyAnswer($answer, $guess)
    {
        $answer = self::sort($answer);
        $guess = self::sort($guess);

        return json_encode($answer) == json_encode($guess);
    }

    public function sort($obj)
    {
        if (is_array($obj)) {
            $objs = $obj;
            foreach ($objs as $index => $obj) {
                $objs[$index] = self::sort($obj);
            }

            usort($objs, function($a, $b) {
                $a = crc32(json_encode($a));
                $b = crc32(json_encode($b));
                if ($a == $b) {
                    return 0;
                }
                return ($a < $b) ? -1 : 1;
            });
            return $objs;
        } elseif (is_object($obj)) {
            $ret = array();
            foreach ($obj as $k => $v) {
                $ret[$k] = self::sort($v);
            }
            ksort($ret);
            return (object)$ret;
        } else {
            return $obj;
        }
    }
}
