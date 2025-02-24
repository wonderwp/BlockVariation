<?php

namespace WonderWp\Component\BlockVariations\Traits;

trait HasBlockVariationDefinitions
{

    public function __construct()
    {
        $this->setKey(static::provideKey());
        $this->setBlockTypeNameToVariate(static::provideBlockTypeNameToVariate());
        $this->setArgs(static::provideArgs());
    }
} 