<?php

namespace Tests\Unit;

use Amarj\Realfavicongenerators\Realfavicongenerator;
use PHPUnit\Framework\TestCase;

class RealfavicongeneratorTest extends TestCase
{
    /** @test */
    public function it_loads_a_image_file()
    {
        $file = Realfavicongenerator::load(__DIR__ .'/stubs/php.png');

        $expected = file_get_contents(__DIR__ .'/stubs/php.png');
        
        $this->assertEquals($expected, $file);
    }
}
