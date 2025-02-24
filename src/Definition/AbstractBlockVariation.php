<?php

namespace WonderWp\Component\BlockVariations\Definition;

abstract class AbstractBlockVariation implements BlockVariationInterface
{
    protected string $key = '';
    protected string $blockTypeNameToVariate = '';
    protected array $args = [];

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): static
    {
        $this->key = $key;
        return $this;
    }

    public function getBlockTypeNameToVariate(): string
    {
        return $this->blockTypeNameToVariate;
    }

    public function setBlockTypeNameToVariate(string $blockTypeNameToVariate): static
    {
        $this->blockTypeNameToVariate = $blockTypeNameToVariate;
        return $this;
    }

    public function getArgs(): array
    {
        return $this->args;
    }

    public function setArgs(array $args): static
    {
        $this->args = $args;
        return $this;
    }

    public function getArg(string $key): mixed
    {
        return $this->args[$key] ?? null;
    }

    public function setArg(string $key, mixed $value): static
    {
        $this->args[$key] = $value;
        return $this;
    }
} 