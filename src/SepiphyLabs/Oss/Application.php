<?php declare(strict_types=1);

/*
 * This file is part of the Sepiphy package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SepiphyLabs\Oss;

use Illuminate\Container\Container;
use Psr\Container\ContainerInterface;
use SepiphyLabs\Oss\Commands\InitCommand;
use SepiphyLabs\Oss\Providers\ComposerProvider;
use SepiphyLabs\Oss\Providers\ProviderCollection;
use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * Create a new Application instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('Oss', 'v1.0-dev');

        $this->container = new Container;

        $this->container->singleton('providers', function () {
            return new ProviderCollection([
                new ComposerProvider,
            ]);
        });

        $this->container->singleton('commands.init', function (ContainerInterface $container) {
            return new InitCommand(
                $container->get('providers')
            );
        });

        $this->add($this->container->get('commands.init'));

        return $this;
    }
}
