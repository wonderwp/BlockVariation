<?php

namespace WonderWp\Component\BlockVariations\Service;

use WonderWp\Component\BlockVariations\BlockVariationInterface;

interface BlockVariationServiceInterface
{
    public function addBlockVariation(BlockVariationInterface $blockVariation): static;
    public function getBlockVariation(string $key): ?BlockVariationInterface;
    public function getBlockVariations(): array;
    public function registerBlockVariations(): void;
    public function setBlockVariations(array $blockVariations): static;
} 