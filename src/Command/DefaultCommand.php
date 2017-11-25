<?php

namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DefaultCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('sms:send')
            ->addArgument('number', InputArgument::REQUIRED)
            ->addArgument('text', InputArgument::REQUIRED)
        ;
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $port = '/dev/ttyACM0';
        $resource = fopen($port, 'w');
        $text = sprintf("%s|%s\n", $input->getArgument('number'), $input->getArgument('text'));
        fwrite($resource, $text);
        fclose($resource);
    }
}
