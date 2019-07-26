<?php declare(strict_types=1);

/*
 * This file is part of the XuanQuynh package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Unit\XuanQuynh\PackageTemplate;

use PHPUnit\Framework\TestCase;
use XuanQuynh\PackageTemplate\Example;

/**
 * @author Quynh Xuan Nguyen <seriquynh@gmail.com>
 */
class ExampleTest extends TestCase
{
    public function testBasic()
    {
        $this->assertTrue(class_exists(Example::class));
    }
}
