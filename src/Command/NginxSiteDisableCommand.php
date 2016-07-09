<?php

namespace Droid\Plugin\Nginx\Command;

use RuntimeException;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Droid\Lib\Plugin\Command\CheckableTrait;

class NginxSiteDisableCommand extends AbstractNginxCommand
{
    use CheckableTrait;

    protected $enabledDir = 'sites-enabled';
    protected $availableDir = 'sites-available';

    public function configure()
    {
        $this
            ->setName('nginx:dissite')
            ->setDescription('Disable Nginx sites.')
            ->addArgument(
                'site-name',
                InputArgument::REQUIRED,
                'Disable the named site.'
            )
        ;
        $this->configureCheckMode();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->activateCheckMode($input);

        $confname = $this->getConfName($input->getArgument('site-name'));
        $confFilename = $this->getConfFilename($input->getArgument('site-name'));

        if (! $this->available($confFilename)) {
            throw new RuntimeException(
                sprintf('I am not aware of a site named "%s".', $confname)
            );
        }

        if (! $this->enabled($confFilename)) {
            $output->writeLn(
                sprintf(
                    'The site "%s" is already disabled. Nothing to do.',
                    $confname
                )
            );
            $this->reportChange($output);
            return 0;
        }

        $this->markChange();

        if (! $this->checkMode() && ! $this->disable($confFilename)) {
            throw new RuntimeException(
                sprintf('I cannot disable site "%s".', $confname)
            );
        }

        $output->writeLn(
            sprintf(
                'I %s "%s".',
                $this->checkMode() ? 'would disable' : 'have disabled',
                $confname
            )
        );

        $this->reportChange($output);
        return 0;
    }

    protected function getAvailableDir()
    {
        return $this->availableDir;
    }

    protected function getEnabledDir()
    {
        return $this->enabledDir;
    }
}
