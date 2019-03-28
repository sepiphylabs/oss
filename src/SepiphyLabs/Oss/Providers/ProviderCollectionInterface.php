<?php

namespace SepiphyLabs\Oss\Providers;

interface ProviderCollectionInterface
{
    /**
     * Find a provider by name.
     *
     * @param string $name
     */
    public function find(string $name): ProviderInterface;
}
