<?php

namespace WonderWp\Component\BlockVariations\Service;

use WonderWp\Component\BlockVariations\Definition\BlockVariationInterface;
use WonderWp\Component\PluginSkeleton\ManagerAwareTrait;

class BlockVariationService extends AbstractBlockVariationService
{
    use ManagerAwareTrait;

    public function register()
    {
        add_action('init', function() {
            $autoLoaded = $this->autoload();
        }, 9);
    }

    public function autoload(array $classNameFromFiles = [], array $discoveryPaths = [], callable $successCallback = null, array $excludedClasses = []): array
    {
        $discoveryPathsRoots = $this->manager->getConfig('discoveryPathsRoots', [
            'block-variations' => rtrim($this->manager->getConfig('path.root') ?? '', DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR
        ]);
        $discoverFolderSuffix = $this->manager->getConfig('blockVariationService.discoverFolderSuffix', 'BlockVariations');
        $defaultPaths = $this->deductDefaultDiscoveryPaths($discoveryPathsRoots, $discoverFolderSuffix);
        $discoveryPaths = array_merge($defaultPaths, $discoveryPaths);

        $autoLoaded = parent::autoload($classNameFromFiles, $discoveryPaths, $successCallback);

        if (!empty($this->blockVariations)) {
            $this->registerBlockVariations();
        }

        return $autoLoaded;
    }

    protected function autoloadFile(string $className, string $filePath): object
    {
        $instance = parent::autoloadFile($className, $filePath);

        if($instance instanceof BlockVariationInterface) {
            $this->addBlockVariation($instance);
        }

        return $instance;
    }
}
