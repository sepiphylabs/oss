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

abstract class Provider implements ProviderInterface
{
    /**
     * @var string
     */
    protected $stubsDir;

    public function __construct()
    {
        $this->stubsDir = realpath(__DIR__.'/../../../../resources/stubs');
    }

    /**
     * {@inheritdoc}
     */
    public function needs(): array
    {
        return [
            ['package_name', 'What is the package name?', 'foo/bar'],
            ['package_description', 'What is the package description?', 'Enjoy coding everyday.'],
            ['author_name', 'What is the author name?', 'Foo Bar'],
            ['author_email', 'What is the author email?', 'foo@bar.com'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function initPackage(string $directory, array $options = []): void
    {
        $this
            ->prepareDirectory($directory, $options)
            ->prepareBaseFiles($directory, $options)
            ->finalTasks($directory, $options)
        ;
    }

    /**
     * @param string $directory
     * @return self
     */
    protected function prepareDirectory(string $directory, array $options = []): self
    {
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        foreach (['.github', 'docs', 'src', 'tests'] as $dirname) {
            if (!file_exists($directory.'/'.$dirname)) {
                mkdir($directory.'/'.$dirname, 0755, true);
            }
        }

        return $this;
    }

    /**
     * @param string $directory
     * @return self
     */
    protected function prepareBaseFiles(string $directory, array $options = []): self
    {
        $replacements = $this->getReplacements($options);

        // README.md
        $content = strtr(file_get_contents($this->stubsDir.'/README.stub'), $replacements);
        file_put_contents($directory.'/README.md', $content);

        // CONTRIBUTING.md
        $content = strtr(file_get_contents($this->stubsDir.'/CONTRIBUTING.stub'), $replacements);
        file_put_contents($directory.'/CONTRIBUTING.md', $content);

        // CODE_OF_CONDUCT.md
        $content = strtr(file_get_contents($this->stubsDir.'/CODE_OF_CONDUCT.stub'), $replacements);
        file_put_contents($directory.'/CODE_OF_CONDUCT.md', $content);

        // git
        $content = file_get_contents($this->stubsDir.'/git/gitattributes.stub');
        file_put_contents($directory.'/.gitattributes', $content);
        $content = file_get_contents($this->stubsDir.'/git/gitignore.stub');
        file_put_contents($directory.'/.gitignore', $content);

        // github
        $content = file_get_contents($this->stubsDir.'/github/PULL_REQUEST_TEMPLATE.stub');
        file_put_contents($directory.'/.github/PULL_REQUEST_TEMPLATE.md', $content);

        // docs/docs.md
        $content = file_get_contents($this->stubsDir.'/docs/docs.stub');
        file_put_contents($directory.'/docs/docs.md', $content);

        // composer.json
        $content = strtr(file_get_contents($this->stubsDir.'/providers/'.$this->getFileName().'.stub'), $replacements);
        file_put_contents($directory.'/'.$this->getFileName().'.json', $content);

        return $this;
    }

    /**
     * Add final tasks to finis initializing package.
     *
     * @param string $directory
     * @param array $options
     * @return void
     */
    protected function finalTasks(string $directory, array $options = []): void
    {
        //
    }

    /**
     * @param array $options
     * @return array
     */
    protected function getReplacements(array $options): array
    {
        $replacements = [];

        foreach ($options as $search => $replace) {
            $replacements['%'.$search.'%'] = $replace;
        }

        return $replacements;
    }
}
