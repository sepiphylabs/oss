<?php

namespace Sericode\Oss\Providers;

use Sericode\Oss\Packages\PhpPackage;
use Sericode\Oss\Commands\InitCommand;
use Sericode\Oss\Packages\PackageFactory;
use Sepiphy\PHPTools\Container\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $php = new PhpPackage;
        $php->setStubsDir(realpath(__DIR__.'/../../stubs'));

        $packages = new PackageFactory([$php]);

        $this->container->set('packages', $packages);
        $this->container->set('command.init', new InitCommand($packages));
    }

    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
        $app = $this->container->get('app');

        $app->add($this->container->get('command.init'));
    }
}
