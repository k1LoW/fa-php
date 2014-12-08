<?php

namespace Fa\Fa;

class Chars
{
    public static function alpha() {
        return '/[a-zA-Z]/';
    }
    public static function digit() {
        return '/[0-9]/';
    }
    public static function space() {
        return '/[ ]/';
    }
    public static function symbol() {
        return '/[!-\/:-@≠\[-`{-~]/';
    }
    public static function hyphen() {
        return '/[-]/';
    }
    public static function zenkaku() {
        return '/[^\x01-\x7E]/u';
    }
    public static function hiragana() {
        return '/[ぁ-んー]/u';
    }
    public static function katakana() {
        return '/[ァ-ンーヴヵヶ]/u';
    }
    public static function zenkaku_alpha() {
        return '/[ａ-ｚＡ-Ｚ]/u';
    }
    public static function zenkaku_digit() {
        return '/[０-９]/u';
    }
    public static function zenkaku_space() {
        return '/[　]/u';
    }
    public static function zenkaku_symbol() {
        return '/[！”＃＄％＆’（）＝～｜‘｛＋＊｝＜＞？＿－＾￥＠「；：」、。・]/u';
    }
    public static function zenkaku_hyphen() {
        return '/[‐]/u';
    }
    public static function zenkaku_hyphen_fuzzy() {
        return '/[－‐−‒—–―ー─━]/u';
    }
}