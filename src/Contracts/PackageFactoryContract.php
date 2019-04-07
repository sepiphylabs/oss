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

use Exception;

interface PackageFactoryContract
{
    /**
     * @return array
     */
    public function all(): array;

    /**
     * @param string $name
     * @return PackageContract
     *
     * @throws Exception
     */
    public function find(string $name): PackageContract;
}
