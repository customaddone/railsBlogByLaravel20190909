<?php

/**
 * 現在のページのurlがリンク先のurlと一致していればリンクが貼られなくなる
 */

/* publicが使えない　何故か */
if (!function_exists('menuLinkTo'))
{
    function menuLinkTo($text, $path)
    {
        /* 比較演算子より文字列演算子の方が優先順位が高いので括弧いらない */
        if ( $path == '/' . Request::path() )
        {
            echo '<p style="display: inline">' . $text . '</p>';
        } else {
            echo '<a href="' . $path . '">' . $text . '</a>';
        }
    }
}

if (!function_exists('str_limit'))
{
    function str_limit($value, $limit = 100, $end = '...')
    {
        if (mb_strlen($value, 'UTF-8') <= $limit)
        {
            return $value;
        }

        return rtrim(mb_substr($value, 0, $limit, 'UTF-8')).$end;
    }
}
