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

use Psr\Container\ContainerInterface;
use SepiphyLabs\Oss\Commands\InitCommand;
use SepiphyLabs\Oss\Providers\ComposerProvider;
use SepiphyLabs\Oss\Providers\ProviderCollection;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
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
    }

    protected function bootstrap(): self
    {
        $this->container->set('stubs_dir', realpath(__DIR__.'/../../../resources/stubs'));

        $this->container->singleton('providers.composer', function (ContainerInterface $container) {
            return new ComposerProvider($container->get('stubs_dir'));
        });

        $this->container->singleton('providers', function (ContainerInterface $container) {
            return new ProviderCollection([
                $container->get('providers.composer'),
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

    /**
     * {@inheritdoc}
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        $this->bootstrap();

        return parent::run($input, $output);
    }
}
