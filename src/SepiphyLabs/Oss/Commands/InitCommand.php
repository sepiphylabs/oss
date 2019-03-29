<?php declare(strict_types=1);

/*
 * This file is part of the SepiphyLabs package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SepiphyLabs\Oss\Commands;

use Sepiphy\PHPTools\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use SepiphyLabs\Oss\Providers\ProviderCollectionInterface;
use SepiphyLabs\Oss\Providers\ProviderInterface;

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
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function handle()
    {
        $providerNames = array_map(function (ProviderInterface $provider) {
            return $provider->getName();
        }, (array) $this->providers->all());

        $providerName = $this->io->choice('What provider do you want to create a package for?', $providerNames);

        $provider = $this->providers->find($providerName);

        $options = [];
        $listing = [];

        foreach ($provider->needs() as [$key, $question, $default]) {
            $options[$key] = $value = $this->io->ask($question, $default);
            $listing[] = sprintf('%s: %s', $key, $value);
        }

        $directory = $this->io->argument('directory');

        $provider->initPackage($directory, $options);

        $this->io->success('Created package successully.');

        $this->io->note('Check your package information here:');

        $this->io->listing($listing);
    }
}
