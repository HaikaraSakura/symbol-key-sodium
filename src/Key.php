<?php

declare(strict_types=1);

namespace Haikara\SymbolKeySodium;

abstract class Key
{
    protected function __construct(protected string $key)
    {
    }

    public function getBin(): string
    {
        return $this->key;
    }

    public function getHex(): string
    {
        return sodium_bin2hex($this->key);
    }
}
