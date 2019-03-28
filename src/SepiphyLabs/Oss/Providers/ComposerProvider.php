<?php declare(strict_types=1);

/*
 * This file is part of the Sepiphy package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SepiphyLabs\Oss\Providers;

class ComposerProvider extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'composer';
    }

    /**
     * {@inheritdoc}
     */
    public function initPackage(string $directory, array $options = []): void
    {
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        if (!file_exists($directory.'/.github')) {
            mkdir($directory.'/.github', 0755, true);
        }

        if (!file_exists($directory.'/docs')) {
            mkdir($directory.'/docs', 0755, true);
        }

        $stubsPath = __DIR__.'/../../../../resources/stubs';

        $replacements = [];

        foreach ($options as $search => $replace) {
            $replacements['%'.$search.'%'] = $replace;
        }

        // composer.json
        $content = strtr(file_get_contents($stubsPath.'/providers/composer.stub'), $replacements);
        file_put_contents($directory.'/composer.json', $content);

        // README.md
        $content = strtr(file_get_contents($stubsPath.'/README.stub'), $replacements);
        file_put_contents($directory.'/README.md', $content);

        // CONTRIBUTING.md
        $content = strtr(file_get_contents($stubsPath.'/CONTRIBUTING.stub'), $replacements);
        file_put_contents($directory.'/CONTRIBUTING.md', $content);

        // CODE_OF_CONDUCT.md
        $content = strtr(file_get_contents($stubsPath.'/CODE_OF_CONDUCT.stub'), $replacements);
        file_put_contents($directory.'/CODE_OF_CONDUCT.md', $content);

        // .github
        $content = file_get_contents($stubsPath.'/github/PULL_REQUEST_TEMPLATE.stub');
        file_put_contents($directory.'/.github/PULL_REQUEST_TEMPLATE.md', $content);

        // docs/docs.md
        $content = file_get_contents($stubsPath.'/docs/docs.stub');
        file_put_contents($directory.'/docs/docs.md', $content);
    }
}
