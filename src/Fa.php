<?php

namespace Fa;

use Fa\Fa\Chars;

/**
 * Fa
 *
 */
class Fa
{
    protected $actual;
    private $allowChars = array();
    private $checkFormats = array();
    private $message = array();
    
    /**
     * __construct
     *
     */
    protected function __construct($value)
    {
        $this->actual = $value;
    }
    
    /**
     * set
     *
     */
    public static function set($value)
    {
        return new self($value);
    }

    /**
     * char
     *
     */
    public function char($patterns)
    {
        if (preg_match('/\+/', $patterns)) {
            $patterns = explode('+', $patterns);
        } else {
            $patterns = array($patterns);
        }
        $this->allowChars = array_merge($this->allowChars, $patterns);
        
        return $this;
    }

    /**
     * format
     *
     */
    public function format($patterns)
    {
        if (preg_match('/\+/', $patterns)) {
            $patterns = explode('+', $patterns);
        } else {
            $patterns = array($patterns);
        }
        foreach ($patterns as $pattern) {
            $this->{$pattern}();
        }
        return $this;
    }

    /**
     * assert
     *
     */
    public function assert()
    {
        $replaced = $this->actual;
        $checked = true;
        
        foreach($this->allowChars as $pattern) {
            $re = Chars::{$pattern}();
            $replaced = preg_replace($re, '', $replaced);
        }

        if (count($this->allowChars) > 0 && $replaced != '') {
            $checked = false;
            $this->message[] = 'chars';
        }

        foreach($this->checkFormats as $pattern) {
            $re = $pattern[1];
            if (!preg_match($re, $this->actual)) {
                $checked = false;
                $this->message[] = $pattern[0];
            }
        }

        return $checked;
    }

    /***** formats ****/
    
    public function notEmpty($value = null)
    {
        if (!is_null($value)) {
            $this->actual = $value;
        }
        $this->checkFormats[] = array('notEmpty', '/^.+$/');
        return $this;
    }
    
    public function int($value = null)
    {
        if (!is_null($value)) {
            $this->actual = $value;
        }
        $this->checkFormats[] = array('int', '/^-?[1-9]*[0-9]+$/');
        return $this;
    }
    
    public function range($value = null, $range = null)
    {
        if (is_null($range)) {
            $range = $value;
        } else {
            if (!is_null($value)) {
                $this->actual = $value;
            }
        }
        $regex = '/^.{' . (string)$range . '}$/';
        $this->checkFormats[] = array('range', $regex);
        return $this;
    }

    // simple email regexp
    public function email($value = null)
    {
        if (!is_null($value)) {
            $this->actual = $value;
        }
        $this->checkFormats[] = array('email', "/^[a-z0-9\.!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9\.!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[a-z]{2,4}|museum|travel)$/i");
        return $this;
    }
    
    public function zipcode($value = null)
    {
        if (!is_null($value)) {
            $this->actual = $value;
        }
        $this->checkFormats[] = array('zipcode', '/^[0-9]{3}-[0-9]{4}$/');
        return $this;
    }
    
    public function telNo($value = null)
    {
        if (!is_null($value)) {
            $this->actual = $value;
        }
        $this->checkFormats[] = array('telNo', '/^[0-9]{2}[0-9]*-[0-9]*-[0-9]{4}$/');
        return $this;
    }
}