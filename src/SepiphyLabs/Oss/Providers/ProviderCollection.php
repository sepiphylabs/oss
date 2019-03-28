<?php declare(strict_types=1);

/*
 * This file is part of the SepiphyLabs package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SepiphyLabs\Oss\Providers;

use SepiphyLabs\Oss\Providers\Exceptions\NotFoundException;

class ProviderCollection implements ProviderCollectionInterface
{
    /**
     * @var ProviderInterface[]
     */
    protected $providers = [];

    /**
     * @param ProviderInterface[] $providers
     * @return void
     */
    public function __construct(array $providers)
    {
        $this->providers = $providers;
    }

    /**
     * {@inheritdoc}
     */
    public function find(string $name): ProviderInterface
    {
        foreach ($this->providers as $provider) {
            if ($provider->getName() === $name) {
                return $provider;
            }
        }

        throw new NotFoundException(
            sprintf('The "%s" provider was not found.', $name)
        );
    }
}
