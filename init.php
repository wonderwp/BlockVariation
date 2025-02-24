<?php

use WonderWp\Component\BlockVariations\Service\BlockVariationService;
use WonderWp\Component\BlockVariations\Service\BlockVariationServiceInterface;
use WonderWp\Component\PluginSkeleton\Exception\ServiceNotFoundException;
use WonderWp\Component\PluginSkeleton\ManagerAwareInterface;
use WonderWp\Component\Service\ServiceInterface;
use WonderWp\Component\PluginSkeleton\ManagerInterface;
use WonderWp\Component\DependencyInjection\Container;

add_action('wonderwp.loader.load', 'wwp_register_blockvariation_definitions_towards_container', 10, 2);
add_action('wwp.abstract_manager.run', 'wwp_register_blockvariation_service_towards_manager', 10, 2);

function wwp_register_blockvariation_definitions_towards_container(Container $container)
{
    /**
     * Block Variations
     */
    $container['wwp.blockVariation.defaultService'] = $container->factory(function () {
        return new BlockVariationService();
    });
}

function wwp_register_blockvariation_service_towards_manager(ManagerInterface $manager, Container $container)
{
    //Block Variations
    try {
        $blockVariationService = $manager->getService(ServiceInterface::BLOCK_VARIATION_SERVICE_NAME);
        if ($blockVariationService instanceof BlockVariationServiceInterface) {
            $blockVariationService->registerBlockVariations();
        }
    } catch (ServiceNotFoundException $e) {
        if ($e->getServiceType() === ServiceInterface::BLOCK_VARIATION_SERVICE_NAME) {
            //No block variation service found, use the default one instead
            $blockVariationService = $container['wwp.blockVariation.defaultService'];
            if ($blockVariationService instanceof BlockVariationServiceInterface) {
                if ($blockVariationService instanceof ManagerAwareInterface) {
                    $blockVariationService->setManager($manager);
                }
                $blockVariationService->registerBlockVariations();
            }
        } else {
            throw $e;
        }
    }
} 