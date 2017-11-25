<?php

namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendNowCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('send:now')
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
