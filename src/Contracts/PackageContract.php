<?php declare(strict_types=1);

/*
 * This file is part of the Sericode package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sericode\Oss\Contracts;

interface PackageContract
{
    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string
     */
    public function getFileName(): string;

    /**
     * @return array
     */
    public function needs(): array;

    /**
     * @param string $directory
     * @param string[] $options
     * @return void
     */
    public function init(string $directory, array $options = []): void;
}
