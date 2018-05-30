<?php

namespace App\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FixtureCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this->setName("app:fixtures:load")
            ->setDescription("Generate fixtures for application")
            ->addOption(
                'hard',
                null,
                InputOption::VALUE_NONE,
                'Drop, create database, create schema then execute fixtures load',
                null
            );
    }

    public static function getCommandNames(): array
    {
        return [
            'doctrine:fixtures:load',
            'hautelook:fixtures:load' => [
                '--append' => true
            ],
        ];
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return void
     * @throws \Exception
     */
    public function run(InputInterface $input, OutputInterface $output)
    {
        $commands = self::getCommandNames();

        if ($input->getOption('hard') === true) {
            $commands = array_merge(
                [
                    'doctrine:database:create',
                    'doctrine:schema:update' => [
                        '--force' => true,
                    ],
                ],
                $commands
            );
        }

        foreach ($commands as $name => $args) {
            $command = $this->getApplication()->get((is_int($name)) ? $args : $name);
            $args = (is_int($name)) ? [] : $args;

            $newInput = new ArrayInput($args, $command->getDefinition());
            $newInput->setInteractive(false);
            $command->run($newInput, $output);
        }

        return 0;
    }



}