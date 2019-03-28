<?php declare(strict_types=1);

/*
 * This file is part of the Sepiphy package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SepiphyLabs\Oss\Commands;

use SepiphyLabs\Oss\Oss;
use SepiphyLabs\Oss\CommandIO;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as BaseCommand;

abstract class Command extends BaseCommand
{
    /**
     * @var Oss
     */
    protected $oss;

    /**
     * @var CommandIO
     */
    protected $io;

    /**
     * @return Oss
     */
    public function getOss(): Oss
    {
        return $this->oss;
    }

    /**
     * @param Oss $oss
     * @return self
     */
    public function setOss(Oss $oss): self
    {
        $this->oss = $oss;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->io = new CommandIO($input, $output);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        return $this->handle();
    }

    /**
     *
     */
    abstract protected function handle();
}
