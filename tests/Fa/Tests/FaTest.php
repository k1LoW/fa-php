<?php
namespace Fa\Tests;

use Symfony\Component\Yaml\Yaml;
use Fa\Fa;

class FaTest extends \PHPUnit_Framework_TestCase
{

    /**
     * setUp
     *
     */
    public function setUp(){
        $this->testsetDir = dirname(__FILE__) . '/../../../fa/testsets/';
    }
    
    /**
     * test_chars
     *
     * @dataProvider dataChars
     */
    public function test_chars($char) {        
        $testset = Yaml::parse($this->testsetDir . $char . '.yml');
        foreach($testset as $entry) {
            $actual = Fa::set($entry['input'])->char($char)->assert();
            $this->assertEquals($actual, $entry['expect']);
        }                    
    }
    
    /**
     * dataChars
     *
     */
    public function dataChars(){
        return array(
            array('alpha'),
            array('digit'),
            array('space'),
            array('symbol'),
            array('hyphen'),
            array('zenkaku'),
            array('hiragana'),
            array('katakana'),
            array('zenkaku_alpha'),
            array('zenkaku_digit'),
            array('zenkaku_space'),
            array('zenkaku_symbol'),
        );
    }

    /**
     * test_format
     * @dataProvider dataFormats
     *
     */
    public function test_format($format){
        $testset = Yaml::parse($this->testsetDir . $format . '.yml');
        foreach($testset as $entry) {
            $actual = Fa::set($entry['input'])->format($format)->assert();
            $this->assertEquals($actual, $entry['expect']);

            $actual = Fa::set($entry['input'])->{$format}()->assert();
            $this->assertEquals($actual, $entry['expect']);
        }
    }

    /**
     * dataFormats
     *
     */
    public function dataFormats(){
        return array(
            array('notEmpty'),
            array('int'),
            array('email'),
            array('zipcode'),
            array('telNo'),
        );
    }
    
    /**
     * test_range
     *
     */
    public function test_range(){
        $testset = Yaml::parse($this->testsetDir . 'range3.yml');
        foreach($testset as $entry) {
            $actual = Fa::set($entry['input'])->range(3)->assert();
            $this->assertEquals($actual, $entry['expect']);
        }
    }

}
