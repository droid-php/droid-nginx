<?php

namespace Droid\Test\Plugin\Nginx\Util;

use Droid\Plugin\Nginx\Util\Normaliser;

class NormaliserTest extends \PHPUnit_Framework_TestCase
{
    protected $norm;

    protected function setUp()
    {
        $this->norm = new Normaliser;
    }

    public function testNormaliseConfNameStripsExtension()
    {
        $this->assertSame(
            'foo_module',
            $this->norm->normaliseConfName('foo_module.conf')
        );
        $this->assertSame(
            'foo_module',
            $this->norm->normaliseConfName('foo_module')
        );
    }

    public function testNormaliseConfFilenameAddsExtension()
    {
        $this->assertSame(
            'foo_module.conf',
            $this->norm->normaliseConfFilename('foo_module')
        );
        $this->assertSame(
            'foo_module.conf',
            $this->norm->normaliseConfFilename('foo_module.conf')
        );
    }
}
