<?php
use WOSPM\Checker;
class ArgumentsTest extends PHPUnit_Framework_TestCase
{
    private $metric;
    public function __construct()
    {
        $this->arguments = new Checker\Arguments();
    }

    public function testArguments()
    {
        // Upper case 1
        $inputs = array(
            "./wospm-checker", "--output", "JSON" , "--no-colors", "--verbose", "1"
        );

        $arguments = Checker\Arguments::parseArguments($inputs);

        $this->assertEquals("JSON", $arguments->output);
        $this->assertEquals("1", $arguments->verbose);
        $this->assertFalse($arguments->colors);
    }


    public function testStrictMode()
    {
        // Strict mode = false
        $inputs = array(
            "./wospm-checker"
        );

        $arguments = Checker\Arguments::parseArguments($inputs);

        $this->assertFalse($arguments->strict);

        // Strict mode = true
        $inputs = array(
            "./wospm-checker", "--strict"
        );

        $arguments = Checker\Arguments::parseArguments($inputs);

        $this->assertTrue($arguments->strict);
    }

    public function testParserArgumentsInvalidArgumentFormat()
    {
        $inputs = array(
            'wospm-checker', 'invalidformat'
        );

        $this->setExpectedException(\Exception::class);
        
        Checker\Arguments::parseArguments($inputs);
    }

    public function testParserArgumentsInvalidArgument()
    {
        $inputs = array(
            'wospm-checker', '--invalid'
        );

        $this->setExpectedException(\Exception::class);
        
        Checker\Arguments::parseArguments($inputs);
    }
}
