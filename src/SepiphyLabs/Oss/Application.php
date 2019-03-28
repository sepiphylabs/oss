<?php declare(strict_types=1);

/*
 * This file is part of the Sepiphy package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SepiphyLabs\Oss;

use SepiphyLabs\Oss\Commands\InitCommand;
use SepiphyLabs\Oss\Commands\Command as OssCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class Application extends BaseApplication
{
    /**
     * @var Oss
     */
    protected $oss;

    /**
     * Create a new Application instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('Oss', 'v1.0-dev');

        $this->oss = new Oss;
    }

    /**
     * {@inheritdoc}
     */
    public function add(SymfonyCommand $command)
    {
        if ($command instanceof OssCommand) {
            $command->setOss($this->oss);
        }

        return parent::add($command);
    }

    protected function bootstrap(): self
    {
        $this->add(new InitCommand);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        $this->bootstrap();

        return parent::run($input, $output);
    }
}
