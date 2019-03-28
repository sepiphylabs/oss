<?php declare(strict_types=1);

/*
 * This file is part of the Sepiphy package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SepiphyLabs\Oss\Providers;

use SepiphyLabs\Oss\Providers\Exceptions\ExceptionInterface;

interface ProviderCollectionInterface
{
    /**
     * Find a provider by name.
     *
     * @param string $name
     * @return ProviderInterface
     *
     * @throws ExceptionInterface
     */
    public function find(string $name): ProviderInterface;
}
