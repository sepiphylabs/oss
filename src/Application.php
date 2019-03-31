<?php declare(strict_types=1);

/*
 * This file is part of the Sericode package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sericode\Oss;

use Sericode\Oss\Commands\InitCommand;
use Sericode\Oss\Providers\ComposerProvider;
use Sericode\Oss\Providers\ProviderCollection;
use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * Create a new Application instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('Oss', 'v1.0-dev');

        $composer = new ComposerProvider;
        $composer->setStubsDir(realpath(__DIR__.'/../resources/stubs'));

        $providers = new ProviderCollection([$composer]);

        $this->add(new InitCommand($providers));

        return $this;
    }
}
