<?php declare(strict_types=1);

/*
 * This file is part of the Sericode package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sericode\Oss\Commands;

use Sepiphy\PHPTools\Console\Command;
use Sericode\Oss\Contracts\PackageContract;
use Sericode\Oss\Contracts\PackageFactoryContract;
use Symfony\Component\Console\Input\InputArgument;
use Sericode\Oss\Packages\Exceptions\NotFoundException;

class InitCommand extends Command
{
    /**
     * @var PackageFactoryContract
     */
    protected $packages;

    /**
     * @param PackageFactoryContract $packages
     */
    public function __construct(PackageFactoryContract $packages)
    {
        parent::__construct();

        $this->packages = $packages;
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
    protected function fire()
    {
        $package = $this->getPackage();

        $options = $listing = [];

        foreach ($package->needs() as [$key, $question, $default]) {
            $options[$key] = $value = $this->output->ask($question, $default);
            $listing[] = sprintf('%s: %s', $key, $value);
        }

        $directory = $this->input->getArgument('directory');

        $package->init($directory, $options);

        $this->output->success(sprintf('Created package successully at %s.', $directory));

        $this->output->note('Check your package information here:');

        $this->output->listing($listing);
    }

    /**
     * @return PackageContract
     * @throws NotFoundException
     */
    protected function getPackage(): PackageContract
    {
        $types = [];

        foreach ($this->packages->all() as $package) {
            $types[] = $package->getType();
        }

        $name = $this->output->choice('What type of package do you want to create?', $types);

        return $this->packages->find($name);
    }
}
