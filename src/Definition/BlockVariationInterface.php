<?php

namespace WonderWp\Component\BlockVariations\Definition;

interface BlockVariationInterface
{
    /**
     * Get the block variation key.
     * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-variations/#defining-a-block-variation
     * @return string
     */
    public function getKey(): string;

    /**
     * Set the block variation key.
     * Must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores.
     * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-variations/#defining-a-block-variation
     * @see https://developer.wordpress.org/reference/functions/sanitize_key/
     * @param string $key
     * @return $this
     */
    public function setKey(string $key): static;

    /**
     * Get the block type name to variate
     * @return string
     */
    public function getBlockTypeNameToVariate(): string;

    /**
     * Set the block type name to variate
     * @param string $blockTypeNameToVariate
     * @return $this
     */
    public function setBlockTypeNameToVariate(string $blockTypeNameToVariate): static;

    /**
     * Return the block variation args
     * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-variations/#defining-a-block-variation
     * @return array
     */
    public function getArgs(): array;

    /**
     * Set the block variation args
     * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-variations/#defining-a-block-variation
     * @param array $args
     * @return $this
     */
    public function setArgs(array $args): static;

    /**
     * Return a specific arg
     * @param string $key
     * @return mixed
     */
    public function getArg(string $key): mixed;

    /**
     * Set a specific arg
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function setArg(string $key, mixed $value): static;
} 