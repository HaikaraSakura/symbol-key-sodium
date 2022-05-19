<?php

declare(strict_types=1);

namespace Haikara\SymbolKeySodium;

class SecretKey extends Key
{
    public function sign(string $message)
    {
        return sodium_crypto_sign($message, $this->key);
    }

    public static function createFromKeyPair(string $key_pair)
    {
        if (!self::is96byte($key_pair)) throw new \Exception();

        $pk_str = sodium_crypto_sign_secretkey($key_pair);
        return new static($pk_str);
    }
}
