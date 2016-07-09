<?php

namespace Droid\Plugin\Nginx;

use Symfony\Component\Process\ProcessBuilder;

use Droid\Plugin\Nginx\Command\NginxSiteDisableCommand;
use Droid\Plugin\Nginx\Command\NginxSiteEnableCommand;
use Droid\Plugin\Nginx\Util\Normaliser;

class DroidPlugin
{
    public function __construct($droid)
    {
        $this->droid = $droid;
    }

    public function getCommands()
    {
        return array(
            new NginxSiteDisableCommand(
                new ProcessBuilder,
                new Normaliser
            ),
            new NginxSiteEnableCommand(
                new ProcessBuilder,
                new Normaliser
            ),
        );
    }
}
