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

use Sepiphy\PHPTools\Console\Application as SepiphyApplication;

class Application extends SepiphyApplication
{
    public const NAME = 'OSS (Open-Sourced Software)';
    public const VERSION = '1.0-dev';

    /**
     * {@inheritdoc}
     */
    protected $providers = [
        \Sericode\Oss\Providers\PackageServiceProvider::class,
    ];
}
