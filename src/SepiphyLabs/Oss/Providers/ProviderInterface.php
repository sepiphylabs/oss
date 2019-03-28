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

interface ProviderInterface
{
    /**
     * Get the provider name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get the provider aliases.
     *
     * @return string[]
     */
    public function getAliases(): array;

    /**
     * Get the declaration file name.
     *
     * @return string
     */
    public function getFileName(): string;

    /**
     * Init a fresh package.
     *
     * @param string $directory
     * @param string[] $options
     * @return void
     */
    public function initPackage(string $directory, array $options = []): void;
}
