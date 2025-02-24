<?php

namespace WonderWp\Component\BlockVariations\Traits;

interface HasBlockVariationDefinitionsInterface
{
    /**
     * Provide the block variation key
     * Must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores.
     * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-variations/#defining-a-block-variation
     * @see https://developer.wordpress.org/reference/functions/sanitize_key/
     * @return string
     */
    public static function provideKey(): string;

    /**
     * Provide the block type name to variate
     * @return string
     */
    public static function provideBlockTypeNameToVariate(): string;

    /**
     * Provide the block variation args
     * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-variations/#defining-a-block-variation
     * @return array
     */
    public static function provideArgs(): array;
} 