<?php declare(strict_types=1);

/*
 * This file is part of the SepiphyLabs package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SepiphyLabs\Oss;

use SepiphyLabs\Oss\Commands\InitCommand;
use SepiphyLabs\Oss\Providers\ComposerProvider;
use SepiphyLabs\Oss\Providers\ProviderCollection;
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

        $providers = new ProviderCollection([
            new ComposerProvider,
        ]);

        $this->add(new InitCommand($providers));

        return $this;
    }
}
