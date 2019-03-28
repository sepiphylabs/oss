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
use SepiphyLabs\Oss\Providers\ProviderCollectionInterface;

class InitCommand extends Command
{
    /**
     * @var ProviderCollectionInterface
     */
    protected $providers;

    /**
     * Create a new InitCommand instance.
     *
     * @param ProviderCollectionInterface $providers
     * @return void
     */
    public function __construct(ProviderCollectionInterface $providers)
    {
        parent::__construct();

        $this->providers = $providers;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('init')
            ->setDescription('Initialize an open-sourced software package.')
            ->addArgument('directory', InputArgument::REQUIRED, 'The package directory.')
            ->addOption('provider', 'p', InputOption::VALUE_OPTIONAL, 'The package provider.', 'composer')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function handle()
    {
        $provider = $this->providers->find(
            $providerName = $this->io->input->getOption('provider')
        );

        $options['package_name'] = $name = $this->io->output->ask('What is the package name?', 'foo/bar');
        $options['package_description'] = $this->io->output->ask(
            'What is the package description?', 'Enjoy coding everyday.'
        );
        $options['author_name'] = $this->io->output->ask('What is the author name?', 'Foo Bar');
        $options['author_email'] = $this->io->output->ask('What is the author email?', 'foo@bar.com');

        $directory = $this->io->input->getArgument('directory');

        $provider->initPackage($directory, $options);

        $this->io->output->success(
            sprintf('Create %s package "%s" at "%s".', $providerName, $name, $directory)
        );
    }
}
