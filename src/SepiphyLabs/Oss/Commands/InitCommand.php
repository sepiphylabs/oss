<?php declare(strict_types=1);

/*
 * This file is part of the Sepiphy package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SepiphyLabs\Oss\Commands;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InitCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('init')
            ->setDescription('Initialize an open-sourced software package.')
            ->addArgument('name', InputArgument::REQUIRED, 'The package name.')
            ->addOption('provider', 'p', InputOption::VALUE_OPTIONAL, 'The package provider.', 'composer')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function handle()
    {
        $this->io->output->success('Create an oss package named "'.$this->io->input->getArgument('name').'".');
    }
}
