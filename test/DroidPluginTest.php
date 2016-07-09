<?php

namespace Droid\Test\Plugin\Nginx;

use Droid\Plugin\Nginx\DroidPlugin;

class DroidPluginTest extends \PHPUnit_Framework_TestCase
{
    protected $plugin;

    protected function setUp()
    {
        $this->plugin = new DroidPlugin('droid');
    }

    public function testGetCommandsReturnsAllCommands()
    {
        $this->assertSame(
            array(
                'Droid\Plugin\Nginx\Command\NginxSiteDisableCommand',
                'Droid\Plugin\Nginx\Command\NginxSiteEnableCommand',
            ),
            array_map(
                function ($x) {
                    return get_class($x);
                },
                $this->plugin->getCommands()
            )
        );
    }
}
