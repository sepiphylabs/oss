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

class ComposerProvider extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'composer';
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases(): array
    {
        return ['php'];
    }

    /**
     * {@inheritdoc}
     */
    public function getFileName(): string
    {
        return 'composer.json';
    }

    /**
     * {@inheritdoc}
     */
    public function needs(): array
    {
        return array_merge(parent::needs(), [
            //
        ]);
    }
}
