<?php

namespace WonderWp\Component\BlockVariations\Service;

use WonderWp\Component\BlockVariations\Definition\BlockVariationInterface;

abstract class AbstractBlockVariationService implements BlockVariationServiceInterface
{
    /** @var BlockVariationInterface[] */
    protected array $blockVariations = [];

    public function addBlockVariation(BlockVariationInterface $blockVariation): static
    {
        $this->blockVariations[$blockVariation->getKey()] = $blockVariation;
        return $this;
    }

    public function getBlockVariation(string $key): ?BlockVariationInterface
    {
        return $this->blockVariations[$key] ?? null;
    }

    public function getBlockVariations(): array
    {
        return $this->blockVariations;
    }

    public function setBlockVariations(array $blockVariations): static
    {
        $this->blockVariations = $blockVariations;
        return $this;
    }

    public function registerBlockVariations(): void
    {
        foreach ($this->blockVariations as $blockVariation) {
            add_filter('block_type_metadata_settings', function ($settings, $metadata) use ($blockVariation) {
                if ($metadata['name'] === $blockVariation->getBlockTypeNameToVariate()) {
                    if (!isset($settings['variations'])) {
                        $settings['variations'] = [];
                    }
                    $settings['variations'][] = array_merge(
                        ['name' => $blockVariation->getKey()],
                        $blockVariation->getArgs()
                    );
                }
                return $settings;
            }, 10, 2);
        }
    }

    protected function autoloadFile(string $className, string $filePath): object
    {
        $instance = new $className();
        $this->addBlockVariation($instance);
        return $instance;
    }

    public function autoload(array $classNameFromFiles = [], array $discoveryPaths = [], callable $successCallback = null, array $excludedClasses = []): array
    {
        $autoLoaded = [];
        foreach ($classNameFromFiles as $className => $filePath) {
            if (!in_array($className, $excludedClasses)) {
                $instance = $this->autoloadFile($className, $filePath);
                $autoLoaded[] = $instance;
                if ($successCallback !== null) {
                    $successCallback($instance);
                }
            }
        }
        return $autoLoaded;
    }
} 