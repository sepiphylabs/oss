<?php

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

        $content = strtr(file_get_contents($this->stubsDir.'/providers/composer.stub'), [
            '%name%' => $options['name'] ?? 'vendor_name/detail_name',
            '%description%' => $options['description'] ?? 'Describe your package.',
        ]);

        file_put_contents($directory.'/composer.json', $content);
    }
}
