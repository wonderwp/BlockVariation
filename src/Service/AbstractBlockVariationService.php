<?php

namespace WonderWp\Component\BlockVariations\Service;

use WonderWp\Component\BlockVariations\Definition\BlockVariationInterface;
use WonderWp\Component\Service\AbstractService;
use WonderWp\Component\Service\Traits\HasAutoloadingCapabilities;
use WonderWp\Component\BlockVariations\Traits\HasBlockVariationAutoloader;

abstract class AbstractBlockVariationService extends AbstractService  implements BlockVariationServiceInterface
{
    use HasAutoloadingCapabilities, HasBlockVariationAutoloader {
        HasBlockVariationAutoloader::resolveDiscoveryPaths insteadof HasAutoloadingCapabilities;
        HasBlockVariationAutoloader::afterAutoload insteadof HasAutoloadingCapabilities;
    }
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
}
