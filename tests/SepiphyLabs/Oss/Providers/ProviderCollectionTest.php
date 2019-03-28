<?php declare(strict_types=1);

/*
 * This file is part of the SepiphyLabs package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\SepiphyLabs\Oss\Providers;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use SepiphyLabs\Oss\Providers\ProviderCollection;
use SepiphyLabs\Oss\Providers\ProviderInterface;
use SepiphyLabs\Oss\Providers\Exceptions\NotFoundException;

class ProviderCollectionTest extends TestCase
{
    protected function tearDown(): void
    {
        m::close();
    }

    public function testFindMethod()
    {
        $p1 = m::mock(ProviderInterface::class);
        $p1->shouldReceive('getName')->andReturn('p1');
        $p2 = m::mock(ProviderInterface::class);
        $p2->shouldReceive('getName')->andReturn('p2');

        $providers = new ProviderCollection([$p1, $p2]);

        $this->assertSame($p1, $providers->find('p1'));
        $this->assertSame($p2, $providers->find('p2'));
    }

    public function testFindThrowsNotFoundException()
    {
        $this->expectException(NotFoundException::class);

        $p1 = m::mock(ProviderInterface::class);
        $p1->shouldReceive('getName')->once()->andReturn('p1');
        $p2 = m::mock(ProviderInterface::class);
        $p2->shouldReceive('getName')->once()->andReturn('p2');

        $providers = new ProviderCollection([$p1, $p2]);

        $providers->find('p3');
    }
}
