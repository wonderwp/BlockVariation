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

    protected function autoloadFile(string $className, string $filePath): object
    {
        $instance = parent::autoloadFile($className, $filePath);

        if($instance instanceof BlockVariationInterface) {
            $this->addBlockVariation($instance);
        }

        return $instance;
    }
}
