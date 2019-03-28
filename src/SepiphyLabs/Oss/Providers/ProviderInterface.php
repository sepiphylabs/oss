<?php

namespace SepiphyLabs\Oss\Providers;

interface ProviderInterface
{
    /**
     * Get the provider name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Init a fresh package.
     *
     * @param string $directory
     * @param string[] $options
     * @return void
     */
    public function initPackage(string $directory, array $options = []): void;
}
