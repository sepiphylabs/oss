<?php

namespace SepiphyLabs\Oss\Providers;

abstract class Provider implements ProviderInterface
{
    /**
     * The stubs directory.
     *
     * @var string
     */
    protected $stubsDir;

    /**
     * Create a Provider instance.
     *
     * @param string $stubsDir
     * @return void
     */
    public function __construct(string $stubsDir)
    {
        $this->stubsDir = $stubsDir;
    }
}
