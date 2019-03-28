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

    public function testFindName()
    {
        $p1 = m::mock(ProviderInterface::class);
        $p1->shouldReceive('getName')->andReturn('p1');
        $p1->shouldReceive('getAliases')->andReturn([]);
        $p2 = m::mock(ProviderInterface::class);
        $p2->shouldReceive('getName')->andReturn('p2');
        $p2->shouldReceive('getAliases')->andReturn([]);

        $providers = new ProviderCollection([$p1, $p2]);

        $this->assertSame($p1, $providers->find('p1'));
        $this->assertSame($p2, $providers->find('p2'));
    }

    public function testFindAliases()
    {
        $provider = m::mock(ProviderInterface::class);
        $provider->shouldReceive('getName')->andReturn('p');
        $provider->shouldReceive('getAliases')->andReturn($aliases = ['p1', 'p2', 'p3']);

        $providers = new ProviderCollection([$provider]);

        foreach ($aliases as $alias) {
            $this->assertSame($provider, $providers->find($alias));
        }
    }

    public function testFindThrowsNotFoundException()
    {
        $this->expectException(NotFoundException::class);

        $p1 = m::mock(ProviderInterface::class);
        $p1->shouldReceive('getName')->andReturn('p1');
        $p1->shouldReceive('getAliases')->andReturn([]);
        $p2 = m::mock(ProviderInterface::class);
        $p2->shouldReceive('getName')->andReturn('p2');
        $p2->shouldReceive('getAliases')->andReturn([]);

        $providers = new ProviderCollection([$p1, $p2]);

        $providers->find('p3');
    }
}
