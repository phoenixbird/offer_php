<?php
/**
 * 替换字符串中的空格
 * 将一个字符串中的每个空格替换成“%20”。
 * 例如，当字符串为We Are Happy.则经过替换之后的字符串为We%20Are%20Happy
 * RFC3986协议 rawurlencode()可以把空格转化为20%
 */
$str = "we   are happy";
function replaceSpace($str)
{
    return rawurlencode($str);
}

function replaceSpace1($str)
{
    return str_replace(' ', '%20', $str);
}

//C++或java 时间复杂度为O(N^2)的做法，不足以拿到offer,应该用到指针，PHP实现的思路，
function replaceSpace2($str)
{
    $newStr = '';
    for ($i = 0; $i < strlen($str); $i++) {
        if ($str[$i] === ' ') {
            $newStr .= '%20';
        } else {
            $newStr .= $str[$i];
        }
    }
    return $newStr;
}

//正则替换
function replaceSpace3($str){
    return preg_replace('/\s/','20%',$str);
}

var_dump(replaceSpace3($str));