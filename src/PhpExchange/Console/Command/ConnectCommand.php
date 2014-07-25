<?php
/**
 * Created by PhpStorm.
 * User: fudev
 * Date: 25/07/14
 * Time: 16:01
 */

namespace PhpExchange\Console\Command;

use PhpExchange\AccountClient;
use PhpExchange\Connection;
use PhpExchange\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\Yaml\Yaml;

class ConnectCommand extends Command
{
    const NAME = 'connect';

    protected function configure()
    {
        $this
            ->setName(self::NAME)
            ->setDescription('Connect to an Exchange Web Services account')
        ;
    }

    protected function execute(InputInterface $input, StreamOutput $output)
    {
        $parameters = $this->getApplication()->getParameters();

        $output->writeln(sprintf('Connecting to %s as %s', $parameters['ews.server'], $parameters['ews.username']));

        $versionConstant = 'PhpEws\EwsConnection'.$parameters['ews.version'];

        $ews = new AccountClient(
            $parameters['ews.server'],
            $parameters['ews.username'],
            $parameters['ews.password'],
            defined($versionConstant) ? constant($versionConstant) : $parameters['ews.version']
        );

        $output->writeln(
            $ews->connect()
        );
    }
}
