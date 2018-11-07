<?php

namespace UrlEncode;

/**
 * 模拟java的urlencode编码
 * @author Tinson Ho
 */
class Java
{

    /**
     * 模拟http_build_query
     * @param array $params
     * @return string
     */
    public static function httpBuildQuery($params)
    {
        $params = self::_buildParams($params);
        $str = "";
        foreach ($params as $key => $val) {
            $str .= self::urlEncode($key) . '=' . self::urlEncode($val) . '&';
        }
        return substr($str, 0, -1);
    }

    /**
     * 构造键值对数组
     * @param $params
     * @param array $args
     * @return array
     */
    private static function _buildParams($params, $args = [])
    {
        $newParams = [];
        foreach ($params as $key => $val) {
            $newArgs = $args;
            $newArgs[] = $key;
            if (is_array($val)) {
                $arr = self::_buildParams($val, $newArgs);
                $newParams = array_merge($newParams, $arr);
            } else {
                $newParams[self::getBuildKey($newArgs)] = $val;
            }
        }
        return $newParams;
    }

    /**
     * 构造key
     * @param $args
     * @return string
     */
    public static function getBuildKey($args)
    {
        $str = "";
        $i = 0;
        foreach ($args as $val) {
            if ($i == 0) {
                $str .= $val;
            } else {
                $str .= '[' . $val . ']';
            }
            $i++;
        }
        return $str;
    }

    /**
     * 模拟urlencode
     * @param string $str
     * @return string
     */
    public static function urlEncode($str)
    {
        $str = (string)$str;
        $len = strlen($str);
        $new = "";
        for ($i = 0; $i < $len; $i++) {
            $new .= self::urlEncodeChar($str{$i});
        }
        return $new;
    }

    /**
     * 单个字符转义规则
     * 不做转义：-._*0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz
     * 空格转义+
     * @param string $char
     * @return string
     */
    public static function urlEncodeChar($char)
    {
        $ord = ord($char);
        if ($ord >= ord('0') && $ord <= ord('9')) {
            return $char;
        }
        if ($ord >= ord('A') && $ord <= ord('Z')) {
            return $char;
        }
        if ($ord >= ord('a') && $ord <= ord('z')) {
            return $char;
        }
        if (in_array($char, ['-', '.', '_', '*'])) {
            return $char;
        }
        if ($char == " ") {
            return "+";
        }
        return '%' . strtoupper(dechex($ord));
    }

}