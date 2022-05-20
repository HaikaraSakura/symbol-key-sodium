<?php

declare(strict_types=1);

namespace Haikara\SymbolKeySodium;

class SecretKey extends Key
{
    protected readonly string $key;

    private function __construct(string $key)
    {
        if (!static::is64Byte($key)) throw new \Exception();
        $this->key = $key;
    }

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

    /**
     * 文字列が64バイトであるか
     *
     * @param string $string
     * @return boolean
     */
    private static function is64byte(string $string): bool
    {
        return strlen($string) === 64;
    }
}
