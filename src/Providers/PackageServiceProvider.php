<?php declare(strict_types=1);

/*
 * This file is part of the Sericode package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sericode\Oss\Providers;

use Sericode\Oss\Packages\PhpPackage;
use Sericode\Oss\Commands\InitCommand;
use Sericode\Oss\Packages\PackageFactory;
use Sepiphy\PHPTools\Console\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->registerPackageFactory();

        $this->registerInitCommand();
    }

    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
        $this->app->add($this->container->get('command.init'));
    }

    protected function registerPackageFactory(): void
    {
        $stubsDir = realpath(__DIR__.'/../../stubs');

        $php = new PhpPackage;
        $php->setStubsDir($stubsDir);

        $packages = new PackageFactory([$php]);

        $this->container->set('package_factory', $packages);
    }

    /**
     * Requires "package_factory"
     */
    protected function registerInitCommand(): void
    {
        $command = new InitCommand($this->container->get('package_factory'));

        $this->container->set('command.init', $command);
    }
}
